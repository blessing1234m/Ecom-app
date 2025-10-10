@extends('layouts.app')

@section('title', 'Blog - Ecom-App')

@section('content')
<div class="container mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-8">Blog</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
        @foreach($blogs as $blog)
            <div class="bg-white rounded-lg shadow p-6 flex flex-col">
                @if($blog->image)
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}"
                        class="mx-auto mb-4 rounded-t-lg"
                        style="width:600px;max-width:100%;height:200px;object-fit:cover;display:block;">
                @endif
                <pre class="text-xl font-semibold mb-2" style="background:none;border:none;padding:0;font-family:inherit;white-space:pre-wrap;word-break:break-word;">
{{ $blog->title }}
                </pre>
                <p class="text-gray-500 text-sm mb-1">
                    {{-- <span>{{ $blog->author ?? 'Admin' }}</span>
                    <span class="mx-2">•</span> --}}
                    <span>{{ $blog->created_at->format('F d, Y') }}</span>
                </p>
                <p class="text-gray-600 mb-4" style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis; display:block;">
                    {{ Str::limit(strip_tags($blog->content), 120) }}
                </p>
                <a href="{{ route('blogs.show', $blog) }}"
                   class="mt-auto inline-block text-orange-600 hover:underline font-semibold">Lire l'article</a>
            </div>
        @endforeach
    </div>
    <div class="mt-8">
        {{ $blogs->links() }}
    </div>
</div>
@endsection
