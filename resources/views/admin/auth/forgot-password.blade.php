@extends('layout.admin')

@section('title', 'Admin - Mot de passe oublié')

@section('content')
    <div class="max-w-md mx-auto bg-white p-8 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Mot de passe oublié</h2>

        <p class="mb-4 text-sm text-gray-600">Entrez votre email, nous vous enverrons un lien pour réinitialiser le mot de passe.</p>

        @if(session('status'))
            <div class="mb-4 text-green-600">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.password.email') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" required class="mt-1 block w-full rounded border-gray-300" value="{{ old('email') }}">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-orange-600 text-white rounded">Envoyer le lien</button>
            </div>
        </form>
    </div>
@endsection
