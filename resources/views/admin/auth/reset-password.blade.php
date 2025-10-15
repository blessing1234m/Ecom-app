@extends('layout.admin')

@section('title', 'Admin - Réinitialiser le mot de passe')

@section('content')
    <div class="max-w-md mx-auto bg-white p-8 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Réinitialiser le mot de passe</h2>

        <form method="POST" action="{{ route('admin.password.update') }}">
            @csrf

            <!-- Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" required class="mt-1 block w-full rounded border-gray-300" value="{{ old('email', $request->email) }}">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                <input id="password" name="password" type="password" required class="mt-1 block w-full rounded border-gray-300">
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required class="mt-1 block w-full rounded border-gray-300">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-orange-600 text-white rounded">Réinitialiser</button>
            </div>
        </form>
    </div>
@endsection
