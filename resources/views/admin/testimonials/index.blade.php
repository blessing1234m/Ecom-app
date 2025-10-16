@extends('layouts.admin')

@section('title', 'Témoignages')
@section('page_title', 'Gestion des Témoignages')

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
                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">témoignages</span>
            </div>
        </li>
    </ol>
</nav>
@endsection
@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Témoignages</h1>
        <a href="{{ route('admin.testimonials.create') }}" class="bg-primary-500 text-white px-4 py-2 rounded">Ajouter</a>
    </div>
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="px-4 py-2">Nom</th>
                <th class="px-4 py-2">Message</th>
                <th class="px-4 py-2">Note</th>
                <th class="px-4 py-2">Photo</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($testimonials as $testimonial)
            <tr>
                <td class="border px-4 py-2">{{ $testimonial->name }}</td>
                <td class="border px-4 py-2">{{ Str::limit($testimonial->message, 50) }}</td>
                <td class="border px-4 py-2">
                    @for($i=1; $i<=5; $i++)
                        <span class="{{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}">&#9733;</span>
                    @endfor
                </td>
                <td class="border px-4 py-2">
                    @if($testimonial->photo)
                        <img src="{{ asset('storage/'.$testimonial->photo) }}" alt="photo" class="h-10 w-10 rounded-full object-cover">
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                </td>
                <td class="border px-4 py-2">
                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="text-blue-500">Modifier</a>
                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 ml-2" onclick="return confirm('Supprimer ce témoignage ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
