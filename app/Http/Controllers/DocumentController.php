<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('documents.index', [
            'documents' => Document::with('user')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:250',
            'description' => 'required|string|max:255',
        ]);

        $request->user()->documents()->create($validated);

        return redirect(route('documents.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document): View
    {
        Gate::authorize('update', $document);
 
        return view('documents.edit', [
            'document' => $document,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document): RedirectResponse
    {
        Gate::authorize('update', $document);
 
        $validated = $request->validate([
            'title' => 'required|string|max:250',
            'description' => 'required|string|max:255',
        ]);
 
        $document->update($validated);
 
        return redirect(route('documents.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document): RedirectResponse
    {
        Gate::authorize('delete', $document);

        $document->delete();

        return redirect(route('documents.index'));
    }
}
