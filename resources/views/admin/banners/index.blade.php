@extends('layouts.admin')

@section('title', 'Gestion des Bannières - Admin Ecom-App')
@section('page_title', 'Gestion des Bannières')

@section('breadcrumb')
<nav class="flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600">
                Tableau de bord
            </a>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
                <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Bannières</span>
            </div>
        </li>
    </ol>
</nav>
@endsection

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h2 class="text-lg font-semibold text-gray-900">Bannières de la page d'accueil</h2>
        <p class="text-sm text-gray-600">{{ $banners->count() }} bannière(s) au total</p>
    </div>

    <a href="{{ route('admin.banners.create') }}"
       class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none transition">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nouvelle bannière
    </a>
</div>

<!-- Grille des bannières -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($banners as $banner)
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- Image -->
        <div class="h-48 bg-gray-200 relative">
            @if($banner->image)
            <img src="{{ Storage::url($banner->image) }}"
                 alt="{{ $banner->title }}"
                 class="h-full w-full object-cover">
            @else
            <div class="h-full w-full flex items-center justify-center">
                <span class="text-gray-400">Aucune image</span>
            </div>
            @endif

            <!-- Badge d'ordre -->
            <div class="absolute top-2 left-2 bg-black bg-opacity-50 text-white px-2 py-1 rounded text-xs">
                Ordre: {{ $banner->order }}
            </div>

            <!-- Badge de statut -->
            <div class="absolute top-2 right-2">
                <form action="{{ route('admin.banners.update-status', $banner) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                   {{ $banner->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200' }} transition">
                        {{ $banner->is_active ? 'Active' : 'Inactive' }}
                    </button>
                </form>
            </div>
        </div>

        <!-- Contenu -->
        <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $banner->title }}</h3>

            @if($banner->description)
            <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $banner->description }}</p>
            @endif

            @if($banner->button_text && $banner->button_link)
            <div class="mb-3">
                <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">
                    Bouton: {{ $banner->button_text }}
                </span>
                <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded ml-1">
                    Lien: {{ $banner->button_link }}
                </span>
            </div>
            @endif

            <!-- Actions -->
            <div class="flex justify-between items-center">
                <span class="text-xs text-gray-500">
                    Créé le {{ $banner->created_at->format('d/m/Y') }}
                </span>

                <div class="flex space-x-2">
                    <a href="{{ route('admin.banners.edit', $banner) }}"
                       class="text-primary-600 hover:text-primary-900 transition"
                       title="Modifier">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </a>
                    <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="text-red-600 hover:text-red-900 transition"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette bannière ?')"
                                title="Supprimer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-12">
        <div class="text-gray-400 mb-4">
            <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune bannière</h3>
        <p class="text-gray-500 mb-4">Commencez par créer votre première bannière.</p>
        <a href="{{ route('admin.banners.create') }}" class="inline-block bg-primary-500 text-white px-6 py-2 rounded hover:bg-primary-600 transition">
            Créer une bannière
        </a>
    </div>
    @endforelse
</div>

<!-- Instructions -->
@if($banners->count() > 0)
<div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-4">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div class="ml-3">
            <h3 class="text-sm font-medium text-blue-800">Information</h3>
            <div class="mt-2 text-sm text-blue-700">
                <p>Les bannières sont affichées sur la page d'accueil dans l'ordre défini par le champ "Ordre".</p>
                <p class="mt-1">Seules les bannières actives sont affichées aux visiteurs.</p>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
