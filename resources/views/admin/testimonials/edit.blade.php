@extends('layouts.admin')

@section('title', 'Modifier le témoignage')
@section('content')
<div class="container mx-auto p-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Modifier le témoignage</h1>
    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1 font-medium">Nom</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" required value="{{ old('name', $testimonial->name) }}">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-medium">Message</label>
            <textarea name="message" class="w-full border rounded px-3 py-2" required>{{ old('message', $testimonial->message) }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-medium">Note</label>
            <select name="rating" class="w-full border rounded px-3 py-2" required>
                @for($i=5; $i>=1; $i--)
                    <option value="{{ $i }}" {{ (old('rating', $testimonial->rating) == $i) ? 'selected' : '' }}>{{ $i }} étoile{{ $i>1?'s':'' }}</option>
                @endfor
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-medium">Photo (optionnel)</label>
            <input type="file" name="photo" accept="image/*" class="w-full">
            @if($testimonial->photo)
                <img src="{{ asset('storage/'.$testimonial->photo) }}" alt="photo" class="h-16 w-16 rounded-full mt-2 object-cover">
            @endif
        </div>
        <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded">Mettre à jour</button>
        <a href="{{ route('admin.testimonials.index') }}" class="ml-4 text-gray-600">Annuler</a>
    </form>
</div>
@endsection
