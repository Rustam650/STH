@extends('admin.layouts.app')

@section('title', 'Услуги')

@section('header', 'Управление услугами')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/services.css') }}" type="text/css">
@endsection

@section('content')
<div class="header-container">
    <h1>Управление услугами</h1>
    <a href="{{ route('admin.services.create') }}" class="add-service-btn">
        + Добавить услугу
    </a>
</div>

<div class="services-container">
    <div class="services-list">
        @forelse ($services as $service)
            <div class="service-card" data-expanded="false">
                <div class="service-card__image">
                    <img src="{{ $service->image }}" alt="{{ $service->title }}">
                </div>
                <div class="service-card__content">
                    <h3 class="service-card__title">{{ $service->title }}</h3>
                    <div class="service-card__description">
                        <p>{{ $service->description }}</p>
                    </div>
                    <button class="service-card__expand-btn" onclick="toggleCard(this)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="service-actions">
                <a href="{{ route('admin.services.edit', $service) }}" class="action-btn edit-btn">
                    Редактировать
                </a>
                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action-btn delete-btn" onclick="return confirm('Вы уверены?')">
                        Удалить
                    </button>
                </form>
            </div>
        @empty
            <div class="empty-message">Услуги не найдены</div>
        @endforelse
    </div>

    <div class="pagination-container">
        {{ $services->links() }}
    </div>
</div>

@push('scripts')
<script>
function toggleCard(button) {
    const card = button.closest('.service-card');
    const description = card.querySelector('.service-card__description');
    const isExpanded = card.getAttribute('data-expanded') === 'true';
    
    card.setAttribute('data-expanded', !isExpanded);
    button.classList.toggle('expanded');
    
    if (isExpanded) {
        description.style.maxHeight = '4.5em';
    } else {
        description.style.maxHeight = description.scrollHeight + 'px';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.service-card');
    cards.forEach(card => {
        const description = card.querySelector('.service-card__description');
        const expandBtn = card.querySelector('.service-card__expand-btn');
        
        if (description.scrollHeight > description.offsetHeight) {
            expandBtn.style.display = 'flex';
        } else {
            expandBtn.style.display = 'none';
        }
    });
});
</script>
@endpush
@endsection