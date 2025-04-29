<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileActivityStoreRequest;
use App\Http\Requests\FileActivityUpdateRequest;
use App\Models\FileActivity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FileActivityController extends Controller
{
    public function index(Request $request): View
    {
        $fileActivities = FileActivity::all();

        return view('fileActivity.index', [
            'fileActivities' => $fileActivities,
        ]);
    }

    public function create(Request $request): View
    {
        return view('fileActivity.create');
    }

    public function store(FileActivityStoreRequest $request): RedirectResponse
    {
        $fileActivity = FileActivity::create($request->validated());

        $request->session()->flash('fileActivity.id', $fileActivity->id);

        return redirect()->route('fileActivities.index');
    }

    public function show(Request $request, FileActivity $fileActivity): View
    {
        return view('fileActivity.show', [
            'fileActivity' => $fileActivity,
        ]);
    }

    public function edit(Request $request, FileActivity $fileActivity): View
    {
        return view('fileActivity.edit', [
            'fileActivity' => $fileActivity,
        ]);
    }

    public function update(FileActivityUpdateRequest $request, FileActivity $fileActivity): RedirectResponse
    {
        $fileActivity->update($request->validated());

        $request->session()->flash('fileActivity.id', $fileActivity->id);

        return redirect()->route('fileActivities.index');
    }

    public function destroy(Request $request, FileActivity $fileActivity): RedirectResponse
    {
        $fileActivity->delete();

        return redirect()->route('fileActivities.index');
    }
}
