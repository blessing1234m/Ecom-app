@extends('layouts.admincopy')

@section('title', 'Admin - Connexion')

@section('content')
    <div class="max-w-md mx-auto bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">Connexion Admin</h2>

        @if ($errors->any())
            <div class="mb-4 text-red-600">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.authenticate') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" required autofocus class="mt-1 block w-full rounded border-gray-300" value="{{ old('email') }}">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input id="password" name="password" type="password" required class="mt-1 block w-full rounded border-gray-300">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-orange-600 text-white rounded">Se connecter</button>
            </div>
        </form>
    </div>
@endsection

{{-- <!DOCTYPE html>
<html lang="fr">
{{-- <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin - Ecom-App</title>

    <!-- Vite CSS -->
    @vite(['resources/css/app.css'])
</head>
{{-- <body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-sm w-full space-y-4">
        <div>
            <div class="flex justify-center">
                <img src="{{ asset('images/logo.png') }}" alt="Ecom-App Logo" class="h-16 w-auto">
            </div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Ecom-App Admin
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Interface d'administration
            </p>
        </div>

        <form class="mt-8 space-y-6 bg-white p-8 rounded-lg shadow-md" action="{{ route('admin.authenticate') }}" method="POST">
            @csrf

            @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Mot de passe administrateur
                </label>
                <div class="mt-1">
                    <input id="password" name="password" type="password" required
                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                </div>
            </div>

            <div>
                <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    Se connecter
                </button>
            </div>

             <div class="text-center text-sm text-gray-500">
                <p>Mot de passe temporaire: <code>admin1234</code></p>
            </div>
        </form>
    </div>
</body>
</html> --}}
