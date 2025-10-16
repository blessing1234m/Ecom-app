@extends('layouts.admincopy')

@section('title', 'Ajouter un témoignage')
@section('content')
<div class="container mx-auto p-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Ajouter un témoignage</h1>
    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-medium">Nom</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" required value="{{ old('name') }}">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-medium">Message</label>
            <textarea name="message" class="w-full border rounded px-3 py-2" required>{{ old('message') }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-medium">Note</label>
            <select name="rating" class="w-full border rounded px-3 py-2" required>
                <option value="">Choisir une note</option>
                @for($i=5; $i>=1; $i--)
                    <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>{{ $i }} étoile{{ $i>1?'s':'' }}</option>
                @endfor
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-medium">Photo (optionnel)</label>
            <input type="file" name="photo" accept="image/*" class="w-full">
        </div>
        <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded">Enregistrer</button>
        <a href="{{ route('admin.testimonials.index') }}" class="ml-4 text-gray-600">Annuler</a>
    </form>
</div>
@endsection
