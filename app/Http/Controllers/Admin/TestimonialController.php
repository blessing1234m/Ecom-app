<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(20);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'photo' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('testimonials', 'public');
        }
        Testimonial::create($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Témoignage ajouté !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        return view('admin.testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'photo' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('testimonials', 'public');
        }
        $testimonial->update($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Témoignage modifié !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->photo) {
            \Storage::disk('public')->delete($testimonial->photo);
        }
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Témoignage supprimé !');
    }
}
