{{-- filepath: resources/views/admin/blogs/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Nouvel Article - Admin Ecom-App')
@section('page_title', 'Créer un article')

@section('content')
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto bg-white p-8 rounded shadow">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-2">Titre</label>
            <input type="text" name="title" value="{{ old('title') }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Contenu</label>
            <textarea name="content" rows="8" class="w-full border rounded px-3 py-2" required>{{ old('content') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
                <span class="ml-2">Publié</span>
            </label>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Image</label>
            <input type="file" name="image" class="w-full border rounded px-3 py-2">
        </div>

        <button type="submit" class="bg-primary-600 text-white px-6 py-2 rounded hover:bg-primary-700 transition">
            Enregistrer
        </button>
    </form>
@endsection
