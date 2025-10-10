@extends('layouts.app')

@section('title', $blog->title . ' - Blog - Ecom-App')

@section('content')
<div class="container mx-auto px-4 py-12 max-w-3xl">
    @if($blog->image)
        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}"
            class="mx-auto mb-6 rounded-lg"
            style="width:600px;height:500px;object-fit:cover;display:block;">
    @endif
    <h1 class="text-3xl font-bold mb-6">{{ $blog->title }}</h1>
                    <p class="text-gray-500 text-sm mb-1">
                    {{-- <span>{{ $blog->author ?? 'Admin' }}</span>
                    <span class="mx-2">•</span> --}}
                    <span>{{ $blog->created_at->format('F d, Y') }}</span>
                </p>
    <pre class="prose prose-lg text-gray-800" style="background:none;border:none;padding:0;font-family:inherit;white-space:pre-wrap;word-break:break-word;">
{{ $blog->content }}
    </pre>
    <a href="{{ route('blogs.index') }}" class="inline-block mt-8 text-orange-600 hover:underline">← Retour au blog</a>
</div>
@endsection
