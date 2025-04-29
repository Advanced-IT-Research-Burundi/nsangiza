<?php

namespace App\Http\Controllers;

use App\Http\Requests\SharedFileStoreRequest;
use App\Http\Requests\SharedFileUpdateRequest;
use App\Models\SharedFile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SharedFileController extends Controller
{
    public function index(Request $request): View
    {
        $sharedFiles = SharedFile::all();

        return view('sharedFile.index', [
            'sharedFiles' => $sharedFiles,
        ]);
    }

    public function create(Request $request): View
    {
        return view('sharedFile.create');
    }

    public function store(SharedFileStoreRequest $request): RedirectResponse
    {
        $sharedFile = SharedFile::create($request->validated());

        $request->session()->flash('sharedFile.id', $sharedFile->id);

        return redirect()->route('sharedFiles.index');
    }

    public function show(Request $request, SharedFile $sharedFile): View
    {
        return view('sharedFile.show', [
            'sharedFile' => $sharedFile,
        ]);
    }

    public function edit(Request $request, SharedFile $sharedFile): View
    {
        return view('sharedFile.edit', [
            'sharedFile' => $sharedFile,
        ]);
    }

    public function update(SharedFileUpdateRequest $request, SharedFile $sharedFile): RedirectResponse
    {
        $sharedFile->update($request->validated());

        $request->session()->flash('sharedFile.id', $sharedFile->id);

        return redirect()->route('sharedFiles.index');
    }

    public function destroy(Request $request, SharedFile $sharedFile): RedirectResponse
    {
        $sharedFile->delete();

        return redirect()->route('sharedFiles.index');
    }
}
