{{-- filepath: resources/views/admin/blogs/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Modifier l\'article - Admin Ecom-App')
@section('page_title', 'Modifier l\'article')

@section('content')
    <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto bg-white p-8 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-2">Titre</label>
            <input type="text" name="title" value="{{ old('title', $blog->title) }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Contenu</label>
            <textarea name="content" rows="8" class="w-full border rounded px-3 py-2" required>{{ old('content', $blog->content) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_published" value="1" {{ $blog->is_published ? 'checked' : '' }}>
                <span class="ml-2">Publié</span>
            </label>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Image</label>
            <input type="file" name="image" class="w-full border rounded px-3 py-2">
        </div>

        <button type="submit" class="bg-primary-600 text-white px-6 py-2 rounded hover:bg-primary-700 transition">
            Mettre à jour
        </button>
    </form>
@endsection
