@extends('admin.layouts.app')

@section('title', 'Управление секциями')

@section('content')
<div class="sections-container">
    <div class="page-header">
        <h1 class="text-2xl font-bold text-gray-900">Секции главной страницы</h1>
        <a href="{{ route('admin.home_sections.create') }}" class="add-button">
            Добавить секцию
        </a>
    </div>

    <div class="grid grid-cols-1 gap-6">
        @foreach($sections->sortByDesc('is_hero') as $section)
        <div class="section-card">
            <div class="section-card__content">
                <div class="section-card__image-container">
                    <img src="{{ $section->background_image }}" 
                         alt="{{ $section->title }}" 
                         class="section-card__image">
                    @if($section->is_hero)
                        <div class="section-card__hero-badge">
                            Главная секция
                        </div>
                    @endif
                </div>
                
                <div class="section-card__info">
                    <div>
                        <h3 class="section-card__title">{{ $section->title }}</h3>
                        <p class="section-card__description">{{ Str::limit($section->description, 200) }}</p>
                    </div>
                    
                    <div class="section-card__footer">
                        <span class="status-badge {{ $section->active ? 'status-badge--active' : 'status-badge--inactive' }}">
                            {{ $section->active ? 'Активна' : 'Неактивна' }}
                        </span>
                        
                        <div class="section-card__actions">
                            <a href="{{ route('admin.home_sections.edit', $section) }}" 
                               class="action-button action-button--edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            
                            <form action="{{ route('admin.home_sections.destroy', $section) }}" 
                                  method="POST" 
                                  class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="action-button action-button--delete"
                                        onclick="return confirm('Вы уверены?')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($sections->isEmpty())
        <div class="text-center py-12">
            <p class="text-gray-500">Секции еще не созданы</p>
        </div>
    @endif
</div>
@endsection