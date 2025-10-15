@extends('layout.admin')

@section('title', 'Admin - Confirmer le mot de passe')

@section('content')
    <div class="max-w-md mx-auto bg-white p-8 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Confirmez votre mot de passe</h2>

        <form method="POST" action="{{ route('admin.password.confirm') }}">
            @csrf

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input id="password" name="password" type="password" required class="mt-1 block w-full rounded border-gray-300">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-orange-600 text-white rounded">Confirmer</button>
            </div>
        </form>
    </div>
@endsection
