@extends('layouts.admin')

@section('title', 'Témoignages')
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
