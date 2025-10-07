@extends('layouts.admin')

@section('title', 'Ajouter une FAQ - Admin Ecom-App')
@section('page_title', 'Ajouter une FAQ')

@section('content')
    <form action="{{ route('admin.faqs.store') }}" method="POST" class="max-w-xl mx-auto bg-white p-8 rounded shadow">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-2">Question</label>
            <input type="text" name="question" value="{{ old('question') }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Réponse</label>
            <textarea name="answer" rows="5" class="w-full border rounded px-3 py-2" required>{{ old('answer') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_active" value="1" checked>
                <span class="ml-2">Active</span>
            </label>
        </div>

        <button type="submit" class="bg-primary-600 text-white px-6 py-2 rounded hover:bg-primary-700 transition">
            Enregistrer
        </button>
    </form>
@endsection
