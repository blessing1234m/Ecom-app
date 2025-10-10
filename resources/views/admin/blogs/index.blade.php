{{-- filepath: resources/views/admin/blogs/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Blog - Admin Ecom-App')
@section('page_title', 'Gestion du Blog')

@section('content')
    <div class="mb-6 flex justify-end">
        <a href="{{ route('admin.blogs.create') }}"
           class="bg-primary-600 text-white px-4 py-2 rounded hover:bg-primary-700 transition">Nouvel Article</a>
    </div>
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Titre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Statut</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Créé le</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($blogs as $blog)
                    <tr>
                        <td class="px-6 py-4">
                            {{ $blog->title }}
                        </td>
                        <td class="px-6 py-4">
                            @if($blog->is_published)
                                <span class="text-green-600 font-semibold">Publié</span>
                            @else
                                <span class="text-gray-400">Brouillon</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $blog->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 flex space-x-2">
                            <a href="{{ route('admin.blogs.edit', $blog) }}"
                               class="text-blue-600 hover:underline">Modifier</a>
                            <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" onsubmit="return confirm('Supprimer cet article ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
