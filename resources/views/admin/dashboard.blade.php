@extends('admin.layouts.app')

@section('title', 'Панель управления')

@section('header', 'Панель управления')

@section('content')
<div class="admin-container py-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-2">Виды камня</h3>
                <p class="text-3xl font-bold">{{ \App\Models\StoneType::count() }}</p>
                <a href="{{ route('admin.stone-types.index') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800">
                    Управлять →
                </a>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-2">Услуги</h3>
                <p class="text-3xl font-bold">{{ \App\Models\Service::count() }}</p>
                <a href="{{ route('admin.services.index') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800">
                    Управлять →
                </a>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-2">Портфолио</h3>
                <p class="text-3xl font-bold">{{ \App\Models\Portfolio::count() }}</p>
                <a href="{{ route('admin.portfolio.index') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800">
                    Управлять →
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 