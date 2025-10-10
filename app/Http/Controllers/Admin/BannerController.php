<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index(): View
    {
        $banners = Banner::ordered()->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create(): View
    {
        return view('admin.banners.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Upload de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('banners', 'public');
            $validated['image'] = $imagePath;
        }

        // Définir l'ordre par défaut
        if (empty($validated['order'])) {
            $validated['order'] = Banner::max('order') + 1;
        }

        Banner::create($validated);

        return redirect()->route('admin.banners.index')
                         ->with('success', 'Bannière créée avec succès!');
    }

    public function edit(Banner $banner): View
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Upload de la nouvelle image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }

            $imagePath = $request->file('image')->store('banners', 'public');
            $validated['image'] = $imagePath;
        } else {
            $validated['image'] = $banner->image;
        }

        $banner->update($validated);

        return redirect()->route('admin.banners.index')
                         ->with('success', 'Bannière mise à jour avec succès!');
    }

    public function destroy(Banner $banner): RedirectResponse
    {
        // Supprimer l'image
        if ($banner->image) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return redirect()->route('admin.banners.index')
                         ->with('success', 'Bannière supprimée avec succès!');
    }

    public function updateStatus(Request $request, Banner $banner): RedirectResponse
    {
        $banner->update([
            'is_active' => !$banner->is_active
        ]);

        return back()->with('success', 'Statut de la bannière mis à jour avec succès!');
    }

    public function reorder(Request $request): RedirectResponse
    {
        $request->validate([
            'order' => 'required|array',
        ]);

        foreach ($request->order as $order => $id) {
            Banner::where('id', $id)->update(['order' => $order + 1]);
        }

        return back()->with('success', 'Ordre des bannières mis à jour avec succès!');
    }
}
