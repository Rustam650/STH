@extends('layouts.app')

@section('title', 'Портфолио')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
@endsection

@section('content')
<div id="app">
    <div class="portfolio-container">
        <h1 class="page-title">Наши работы</h1>
        
        <div class="portfolio-grid">
            @if($portfolios->isEmpty())
                <p>Нет работ в портфолио</p>
            @else
                @foreach($portfolios as $portfolio)
                    <div class="portfolio-card" onclick="openModal('{{ $portfolio->id }}')">
                        @if($portfolio->images->isNotEmpty())
                            <img src="{{ $portfolio->images->first()->image }}" alt="{{ $portfolio->title }}" class="portfolio-card__image">
                        @else
                            <div class="portfolio-card__image bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-400">Нет изображения</span>
                            </div>
                        @endif
                        <div class="portfolio-card__overlay">
                            <h3 class="portfolio-card__title">{{ $portfolio->title }}</h3>
                            <span class="portfolio-card__button">Смотреть работу</span>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Модальное окно -->
    <div class="modal-backdrop" id="portfolioModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <button type="button" class="modal-close" onclick="closeModal()">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="relative">
                        <div class="modal-slider" id="modalSlider">
                            <!-- Изображения будут добавляться здесь -->
                        </div>
                        <button class="modal-nav modal-nav-prev" onclick="prevSlide()">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M15 18l-6-6 6-6"/>
                            </svg>
                        </button>
                        <button class="modal-nav modal-nav-next" onclick="nextSlide()">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 18l6-6-6-6"/>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-thumbnails" id="modalThumbnails">
                        <!-- Миниатюры будут добавляться здесь -->
                    </div>
                    <h2 class="modal-title" id="modalTitle"></h2>
                    <p class="modal-description" id="modalDescription"></p>
                    <div class="modal-category">
                        Категория: <span id="modalCategory"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    let currentSlide = 0;
    let slides = [];

    function openModal(id) {
        fetch(`/api/portfolio/${id}`)
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                slides = data.images;
                currentSlide = 0;
                
                const slider = document.getElementById('modalSlider');
                const thumbnails = document.getElementById('modalThumbnails');
                
                slider.innerHTML = '';
                thumbnails.innerHTML = '';
                
                slides.forEach((image, index) => {
                    slider.innerHTML += `
                        <div class="modal-slide ${index === 0 ? 'active' : ''}" data-index="${index}">
                            <img src="${image}" alt="" class="modal-image">
                        </div>
                    `;
                    
                    thumbnails.innerHTML += `
                        <div class="modal-thumbnail ${index === 0 ? 'active' : ''}" onclick="showSlide(${index})">
                            <img src="${image}" alt="">
                        </div>
                    `;
                });

                document.getElementById('modalTitle').textContent = data.title;
                document.getElementById('modalDescription').textContent = data.description;
                document.getElementById('modalCategory').textContent = data.category;
                
                const modal = document.getElementById('portfolioModal');
                modal.classList.add('show');
                document.body.style.overflow = 'hidden';
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Произошла ошибка при загрузке данных');
            });
    }

    function showSlide(index) {
        if (index < 0) index = slides.length - 1;
        if (index >= slides.length) index = 0;
        
        currentSlide = index;
        
        document.querySelectorAll('.modal-slide').forEach(slide => {
            slide.classList.remove('active');
        });
        document.querySelectorAll('.modal-thumbnail').forEach(thumb => {
            thumb.classList.remove('active');
        });
        
        document.querySelector(`.modal-slide[data-index="${index}"]`).classList.add('active');
        document.querySelectorAll('.modal-thumbnail')[index].classList.add('active');
    }

    function nextSlide() {
        showSlide(currentSlide + 1);
    }

    function prevSlide() {
        showSlide(currentSlide - 1);
    }

    function closeModal() {
        const modal = document.getElementById('portfolioModal');
        modal.classList.remove('show');
        document.body.style.overflow = 'auto';
    }

    // Закрытие по клику вне модального окна
    document.getElementById('portfolioModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Закрытие по Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
    </script>
    @endpush
@endsection