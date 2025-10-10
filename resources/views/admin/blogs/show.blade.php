{{-- filepath: resources/views/admin/blogs/show.blade.php --}}
@extends('layouts.admin')

@section('title', $blog->title . ' - Admin Ecom-App')
@section('page_title', $blog->title)

@section('content')
    <div class="max-w-xl mx-auto bg-white p-8 rounded shadow">
        <h2 class="text-xl font-bold mb-4">{{ $blog->title }}</h2>
        @if($blog->image)
            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full rounded-t-lg mb-4" style="height:auto;max-width:100%;object-fit:contain;">
        @endif
        <div class="mb-4 text-gray-700">{{ $blog->content }}</div>
        <div>
            <span class="font-semibold">Statut :</span>
            @if($blog->is_published)
                <span class="text-green-600 font-semibold">Publié</span>
            @else
                <span class="text-gray-400">Brouillon</span>
            @endif
        </div>
    </div>
@endsection
