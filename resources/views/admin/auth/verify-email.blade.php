@extends('layout.admin')

@section('title', 'Admin - Vérifier l\'email')

@section('content')
    <div class="max-w-md mx-auto bg-white p-8 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Vérifiez votre adresse e-mail</h2>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-green-600">Un nouveau lien de vérification a été envoyé à votre adresse e-mail.</div>
        @endif

        <p class="mb-4">Avant de continuer, veuillez vérifier votre e-mail pour obtenir un lien de vérification.</p>

        <form method="POST" action="{{ route('admin.verification.send') }}">
            @csrf
            <button type="submit" class="px-4 py-2 bg-orange-600 text-white rounded">Renvoyer le lien</button>
        </form>

        <form method="POST" action="{{ route('admin.logout') }}" class="mt-4">
            @csrf
            <button type="submit" class="px-4 py-2 bg-gray-200 text-gray-800 rounded">Se déconnecter</button>
        </form>
    </div>
@endsection
