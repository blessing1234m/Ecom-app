@extends('layouts.admin')

@section('title', 'FAQ - Admin Ecom-App')
@section('page_title', 'Détail de la FAQ')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-8 rounded shadow">
        <h2 class="text-xl font-bold mb-4">{{ $faq->question }}</h2>
        <div class="mb-4 text-gray-700">{{ $faq->answer }}</div>
        <div>
            <span class="font-semibold">Statut :</span>
            @if($faq->is_active)
                <span class="text-green-600 font-semibold">Active</span>
            @else
                <span class="text-gray-400">Inactive</span>
            @endif
        </div>
    </div>
@endsection
