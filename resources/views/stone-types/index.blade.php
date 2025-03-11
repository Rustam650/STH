@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/stone-cards.css') }}">
@endsection

@section('content')
<div id="app">
<div class="stone-types-container">
    <h2 class="stone-cards-title">Виды камня</h2>
    
    <div class="stone-types-grid">
        @foreach($stoneTypes as $stone)
        <div class="stone-card">
            <div class="stone-card-image">
                <img src="{{ $stone->image }}" alt="{{ $stone->name }}">
            </div>
            <div class="stone-card-content">
                <h3>{{ $stone->name }}</h3>
                <p>{{ Str::limit($stone->description, 100) }}</p>
                <div class="stone-card-actions">
                    <button onclick="openModal('{{ $stone->id }}')" class="details-btn">
                        Подробнее
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Модальные окна -->
    @foreach($stoneTypes as $stone)
    <div id="modal-{{ $stone->id }}" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ $stone->name }}</h2>
                <button onclick="closeModal('{{ $stone->id }}')" class="modal-close">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ $stone->image }}" alt="{{ $stone->name }}">
                <div class="modal-description">
                    {{ $stone->full_description ?? $stone->description }}
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@push('scripts')
<script>
function openModal(id) {
    const modal = document.getElementById(`modal-${id}`);
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeModal(id) {
    const modal = document.getElementById(`modal-${id}`);
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
}
</script>
@endpush

@endsection