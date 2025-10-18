@extends('layouts.admin')

@section('title', 'Mon Profil - Admin')

@section('page_title', 'Mon Profil')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Informations du compte</h2>

    <div class="space-y-4">
        <div class="border-b pb-4">
            <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
            <div class="text-gray-900">{{ auth()->guard('admin')->user()->email }}</div>
        </div>

        <div class="border-b pb-4">
            <label class="block text-sm font-medium text-gray-600 mb-1">Mot de passe</label>
            <div class="text-gray-900">Ne peut être afficher pour des raisons de sécurité</div>
        </div>

    </div>

    <div class="mt-6 flex space-x-4">
        <a href="{{ route('admin.profile.edit') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
            Modifier le profil
        </a>
    </div>
</div>
@endsection
