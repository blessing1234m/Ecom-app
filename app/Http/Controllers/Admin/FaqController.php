<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class FaqController extends Controller
{
    public function index(): View
    {
        $faqs = Faq::ordered()->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create(): View
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        Faq::create($validated);

        return redirect()->route('admin.faqs.index')
                         ->with('success', 'FAQ créée avec succès!');
    }

    public function edit(Faq $faq): View
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $faq->question = $request->input('question');
        $faq->answer = $request->input('answer');
        $faq->is_active = $request->has('is_active');
        $faq->save();

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ mise à jour.');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index')
                         ->with('success', 'FAQ supprimée avec succès!');
    }
}
