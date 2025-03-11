@extends('layouts.app')

@section('title', 'Услуги')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/services.css') }}">
@endsection

@section('content')
    <div class="services-container">
        <h1 class="services-title">Наши услуги</h1>
        
        <div class="services-list">
            @foreach($services as $service)
                <div class="service-card" data-expanded="false">
                    <div class="service-card__image">
                        <img src="{{ $service->image }}" alt="{{ $service->name }}">
                    </div>
                    <div class="service-card__content">
                        <h3 class="service-card__title">{{ $service->name }}</h3>
                        <div class="service-card__description">
                            <p class="description-text">{{ $service->description }}</p>
                        </div>
                        <button class="service-card__expand-btn" onclick="toggleCard(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                    </div>
                </div>
            @endforeach
            
            @if(count($services) == 0)
                <div class="empty-message">
                    <p>Услуги не найдены</p>
                </div>
            @endif
        </div>
    </div>

@push('scripts')
<script>
function truncateText(element, maxLength = 200) {
    const text = element.textContent;
    if (text.length <= maxLength) return false;
    
    const truncated = text.substr(0, maxLength).trim() + '...';
    element.textContent = truncated;
    element.dataset.fullText = text;
    return true;
}

function toggleCard(button) {
    const card = button.closest('.service-card');
    const description = card.querySelector('.description-text');
    const isExpanded = card.getAttribute('data-expanded') === 'true';
    
    if (!isExpanded) {
        if (description.dataset.fullText) {
            description.textContent = description.dataset.fullText;
        }
        card.setAttribute('data-expanded', 'true');
        button.classList.add('expanded');
    } else {
        if (description.dataset.fullText) {
            truncateText(description);
        }
        card.setAttribute('data-expanded', 'false');
        button.classList.remove('expanded');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const descriptions = document.querySelectorAll('.description-text');
    
    descriptions.forEach(description => {
        const needsTruncation = truncateText(description);
        const card = description.closest('.service-card');
        const expandBtn = card.querySelector('.service-card__expand-btn');
        
        if (needsTruncation) {
            expandBtn.style.display = 'flex';
        } else {
            expandBtn.style.display = 'none';
        }
    });
});
</script>
@endpush
@endsection