@extends('layout.admin')

@section('title', 'Admin - Inscription')

@section('content')
    <div class="max-w-md mx-auto bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">Créer un compte Admin</h2>

        <form method="POST" action="{{ route('admin.register') }}">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                <input id="name" name="name" type="text" required class="mt-1 block w-full rounded border-gray-300" value="{{ old('name') }}" autofocus>
            </div>

            <div class="mt-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" required class="mt-1 block w-full rounded border-gray-300" value="{{ old('email') }}">
            </div>

            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input id="password" name="password" type="password" required class="mt-1 block w-full rounded border-gray-300">
            </div>

            <div class="mt-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required class="mt-1 block w-full rounded border-gray-300">
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md" href="{{ route('admin.login') }}">Déjà inscrit ?</a>

                <button class="ms-4 px-4 py-2 bg-orange-600 text-white rounded">Créer</button>
            </div>
        </form>
    </div>
@endsection
