<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileStoreRequest;
use App\Http\Requests\FileUpdateRequest;
use App\Models\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FileController extends Controller
{
    public function index(Request $request): View
    {
        $files = File::all();

        return view('file.index', [
            'files' => $files,
        ]);
    }

    public function create(Request $request): View
    {
        return view('file.create');
    }

    public function store(FileStoreRequest $request): RedirectResponse
    {
        $file = File::create($request->validated());

        $request->session()->flash('file.id', $file->id);

        return redirect()->route('files.index');
    }

    public function show(Request $request, File $file): View
    {
        return view('file.show', [
            'file' => $file,
        ]);
    }

    public function edit(Request $request, File $file): View
    {
        return view('file.edit', [
            'file' => $file,
        ]);
    }

    public function update(FileUpdateRequest $request, File $file): RedirectResponse
    {
        $file->update($request->validated());

        $request->session()->flash('file.id', $file->id);

        return redirect()->route('files.index');
    }

    public function destroy(Request $request, File $file): RedirectResponse
    {
        $file->delete();

        return redirect()->route('dashboard');
    }
}
