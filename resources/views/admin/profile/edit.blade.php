@extends('layouts.admin')

@section('title', 'Modifier le profil - Admin Ecom-App')
@section('page_title', 'Modifier le profil')

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
                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Profil</span>
            </div>
        </li>
    </ol>
</nav>
@endsection

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-6">
                Changer le mot de passe administrateur
            </h3>

            <form action="{{ route('admin.profile.update-password') }}" method="POST">
                @csrf

                <!-- Mot de passe actuel -->
                <div class="mb-6">
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                        Mot de passe actuel *
                    </label>
                    <input type="password"
                           name="current_password"
                           id="current_password"
                           required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('current_password') border-red-500 @enderror">
                    @error('current_password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nouveau mot de passe -->
                <div class="mb-6">
                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">
                        Nouveau mot de passe *
                    </label>
                    <input type="password"
                           name="new_password"
                           id="new_password"
                           required
                           minlength="6"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('new_password') border-red-500 @enderror">
                    @error('new_password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">Le mot de passe doit contenir au moins 6 caractères.</p>
                </div>

                <!-- Confirmation du nouveau mot de passe -->
                <div class="mb-6">
                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        Confirmer le nouveau mot de passe *
                    </label>
                    <input type="password"
                           name="new_password_confirmation"
                           id="new_password_confirmation"
                           required
                           minlength="6"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>

                <!-- Informations importantes -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-medium text-blue-800">Sécurité</h4>
                            <div class="mt-2 text-sm text-blue-700">
                                <ul class="list-disc list-inside space-y-1">
                                    <li>Choisissez un mot de passe fort et unique</li>
                                    <li>Ne partagez jamais votre mot de passe</li>
                                    <li>Le mot de passe sera requis pour toutes les connexions futures</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.dashboard') }}"
                       class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition">
                        Annuler
                    </a>
                    <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition">
                        Mettre à jour le mot de passe
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Section informations du compte -->
    <div class="mt-8 bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">
                Informations du compte
            </h3>

            <dl class="grid grid-cols-1 gap-4">
                <div class="flex justify-between items-center py-2 border-b border-gray-200">
                    <dt class="text-sm font-medium text-gray-500">Rôle</dt>
                    <dd class="text-sm text-gray-900">Administrateur</dd>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-200">
                    <dt class="text-sm font-medium text-gray-500">Dernière connexion</dt>
                    <dd class="text-sm text-gray-900">{{ now()->format('d/m/Y à H:i') }}</dd>
                </div>
                <div class="flex justify-between items-center py-2">
                    <dt class="text-sm font-medium text-gray-500">Statut</dt>
                    <dd class="text-sm">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Connecté
                        </span>
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</div>
@endsection
