<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\File;
use App\Models\SharedFile;
use App\Models\FileActivity;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with files.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $recentFiles = $this->getRecentFiles();
        $recentActivities = $this->getRecentActivities();

        return view('dashboard', compact('user', 'recentFiles', 'recentActivities'));
    }

    /**
     * Display recent files.
     *
     * @return \Illuminate\Http\Response
     */
    public function recentFiles()
    {
        $user = Auth::user();
        $recentFiles = $this->getRecentFiles();
        $recentActivities = $this->getRecentActivities();

        return view('dashboard', [
            'user' => $user,
            'recentFiles' => $recentFiles,
            'recentActivities' => $recentActivities,
            'activeTab' => 'recent'
        ]);
    }

    /**
     * Display shared files.
     *
     * @return \Illuminate\Http\Response
     */
    public function sharedFiles()
    {
        $user = Auth::user();
        $sharedFiles = $this->getSharedFiles();
        $recentActivities = $this->getRecentActivities();

        return view('dashboard', [
            'user' => $user,
            'sharedFiles' => $sharedFiles,
            'recentActivities' => $recentActivities,
            'activeTab' => 'shared'
        ]);
    }

    /**
     * Display all files.
     *
     * @return \Illuminate\Http\Response
     */
    public function allFiles()
    {
        $user = Auth::user();
        $allFiles = $this->getAllFiles();
        $recentActivities = $this->getRecentActivities();

        return view('dashboard', [
            'user' => $user,
            'allFiles' => $allFiles,
            'recentActivities' => $recentActivities,
            'activeTab' => 'all'
        ]);
    }

    /**
     * Handle file upload.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $request->validate([
            'files.*' => 'required|file|max:102400', // 100MB max file size
        ]);

        $uploadedFiles = [];

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $uploadedFile) {
                $path = $uploadedFile->store('files/' . Auth::id());

                $file = new File();
                $file->user_id = Auth::id();
                $file->name = $uploadedFile->getClientOriginalName();
                $file->path = $path;
                $file->type = $uploadedFile->getClientOriginalExtension();
                $file->size = $uploadedFile->getSize();
                $file->save();

                // Record activity
                $this->recordActivity($file->id, 'upload', 'Uploaded file');

                $uploadedFiles[] = $file;
            }
        }

        return redirect()->back()->with('success', count($uploadedFiles) . ' file(s) uploaded successfully.');
    }

    /**
     * Download a file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $file = File::findOrFail($id);

        // Check if user has access to this file
        if ($file->user_id == Auth::id() || $this->hasFileAccess($file->id)) {
            // Record activity
            $this->recordActivity($file->id, 'download', 'Downloaded file');

            return Storage::download($file->path, $file->name);
        }

        return abort(403, 'Unauthorized action.');
    }

    /**
     * Share a file with another user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function shareFile(Request $request, $id)
    {
        $request->validate([
            'user_email' => 'required|email|exists:users,email',
            'access_level' => 'required|in:view,edit,full'
        ]);

        $file = File::findOrFail($id);

        // Check if file belongs to the user
        if ($file->user_id != Auth::id()) {
            return abort(403, 'Unauthorized action.');
        }

        // Get the user to share with
        $shareWithUser = User::where('email', $request->user_email)->first();

        // Check if already shared
        $existingShare = SharedFile::where('file_id', $id)
            ->where('shared_by', Auth::id())
            ->where('user_id', $shareWithUser->id)
            ->first();

        if ($existingShare) {
            $existingShare->access_level = $request->access_level;
            $existingShare->save();
            $message = 'File share updated successfully.';
        } else {
            // Create new share
            $sharedFile = new SharedFile();
            $sharedFile->file_id = $id;
            $sharedFile->shared_by = Auth::id();
            $sharedFile->user_id = $shareWithUser->id;
            $sharedFile->access_level = $request->access_level;
            $sharedFile->save();

            $message = 'File shared successfully.';
        }

        // Record activity
        $this->recordActivity($id, 'share', 'Shared with ' . $shareWithUser->name);

        return redirect()->back()->with('success', $message);
    }

    /**
     * Get recent files for the current user.
     *
     * @param  int  $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getRecentFiles($limit = 6)
    {
        return File::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get();
    }

    /**
     * Get shared files for the current user.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getSharedFiles()
    {
        return File::whereHas('sharedFiles', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();
    }

    /**
     * Get all files for the current user.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getAllFiles()
    {
        return File::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get recent activities for the current user.
     *
     * @param  int  $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getRecentActivities($limit = 4)
    {
        return FileActivity::where(function ($query) {
            $query->where('user_id', Auth::id()) // User's own activities
                ->orWhereHas('file', function ($fileQuery) {
                    $fileQuery->where('user_id', Auth::id()); // Activities on user's files
                });
        })
        ->with(['user', 'file'])
        ->orderBy('created_at', 'desc')
        ->take($limit)
        ->get();
    }

    /**
     * Check if the current user has access to a file.
     *
     * @param  int  $fileId
     * @return bool
     */
    private function hasFileAccess($fileId)
    {
        return SharedFile::where('file_id', $fileId)
            ->where('user_id', Auth::id())
            ->exists();
    }

    /**
     * Record a file activity.
     *
     * @param  int  $fileId
     * @param  string  $action
     * @param  string  $details
     * @return void
     */
    private function recordActivity($fileId, $action, $details)
    {
        $activity = new FileActivity();
        $activity->file_id = $fileId;
        $activity->user_id = Auth::id();
        $activity->action = $action;
        $activity->details = $details;
        $activity->save();
    }
}
