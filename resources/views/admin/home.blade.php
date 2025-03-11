@extends('admin.layouts.app')

@section('title', 'Панель управления')

@section('content')
<div class="min-h-screen bg-gray-50 py-6">
    <!-- Заголовок и приветствие -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Панель управления</h1>
        <p class="mt-2 text-gray-600">Добро пожаловать в панель управления сайтом</p>
    </div>

    <!-- Карточки с основной статистикой -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Секции -->
        <div class="bg-white overflow-hidden rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Всего секций</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $sectionsCount ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-blue-50 rounded-lg">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.home_sections.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                        Управлять секциями →
                    </a>
                </div>
            </div>
        </div>

        <!-- Активные секции -->
        <div class="bg-white overflow-hidden rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Активные секции</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $activeSectionsCount ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-green-50 rounded-lg">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-sm text-green-600 font-medium">Отображаются на сайте</span>
                </div>
            </div>
        </div>

        <!-- Быстрые действия -->
        <div class="md:col-span-2 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-sm hover:shadow-md transition-shadow">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-white mb-4">Быстрые действия</h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('admin.home_sections.create') }}" 
                       class="flex items-center justify-center px-4 py-3 bg-white bg-opacity-10 rounded-lg text-white hover:bg-opacity-20 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Добавить секцию
                    </a>
                    <a href="{{ route('admin.home_sections.index') }}" 
                       class="flex items-center justify-center px-4 py-3 bg-white bg-opacity-10 rounded-lg text-white hover:bg-opacity-20 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>
                        Управление секциями
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Последние добавленные секции -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Последние добавленные секции</h3>
            <div class="grid gap-4">
                @forelse($recentSections ?? [] as $section)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0 w-12 h-12">
                            <img src="{{ $section->background_image }}" 
                                 alt="{{ $section->title }}" 
                                 class="w-full h-full object-cover rounded-lg">
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-900">{{ $section->title }}</h4>
                            <p class="text-sm text-gray-500">{{ Str::limit($section->description, 50) }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="px-2 py-1 text-xs rounded-full {{ $section->active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $section->active ? 'Активна' : 'Неактивна' }}
                        </span>
                        <a href="{{ route('admin.home_sections.edit', $section) }}" 
                           class="p-2 text-gray-400 hover:text-blue-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                @empty
                <div class="text-center py-4 text-gray-500">
                    Секции еще не созданы
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<style>
.shadow-sm { transition: all 0.2s; }
.shadow-sm:hover { transform: translateY(-1px); }
</style>
@endsection
