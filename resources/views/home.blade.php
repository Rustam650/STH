<?php
Route::get('/', [HomeController::class, 'index'])->name('home');
?>

@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    :root {
        --navbar-height: 80px;
    }
    
    html, body {
        height: 100%;
        overflow-x: hidden;
    }
</style>
@endsection

@section('content')
<div class="page-content">
    <!-- Hero Section -->
    @if(isset($sections) && count($sections) > 0)
        @php
            // Находим героическую секцию
            $heroSection = $sections->first(function($section) {
                return isset($section->is_hero) && $section->is_hero;
            });
            
            // Если героической секции нет, берем первую
            if (!$heroSection && count($sections) > 0) {
                $heroSection = $sections[0];
            }
        @endphp
        
        <div class="section hero-section active" data-section="0">
            <div class="section-background">
                <div class="animated-gradient"></div>
                @if($heroSection && $heroSection->background_image)
                    <img src="{{ $heroSection->background_image }}" alt="{{ $heroSection->title }}" class="background-image">
                @else
                    <img src="{{ asset('images/hero-bg.jpg') }}" alt="Главная" class="background-image">
                @endif
                <div class="gradient-overlay"></div>
            </div>
            
            <div class="section-content">
                <div class="content-wrapper">
                    <h1 class="section-title">
                        @if($heroSection && $heroSection->title)
                            {{ $heroSection->title }}
                        @else
                            Натуральный камень для вашего интерьера
                        @endif
                    </h1>
                    <div class="section-description">
                        @if($heroSection && $heroSection->description)
                            {!! nl2br(e($heroSection->description)) !!}
                        @else
                            Создайте уникальное пространство с нашей коллекцией премиального натурального камня
                        @endif
                    </div>
                    
                    <div class="buttons">
                        <a href="{{ route('stone-types') }}" class="btn">
                            Каталог
                        </a>
                        <a href="{{ route('contacts') }}" class="btn btn-outline">
                            Контакты
                        </a>
                    </div>
                    
                    <!-- Feature Cards -->
                    <div class="feature-cards">
                        <div class="feature-card fade-up">
                            <div class="feature-icon">
                                <i class="fas fa-gem"></i>
                            </div>
                            <h3 class="feature-title">Премиум качество</h3>
                            <p class="feature-description">Лучшие сорта натурального камня со всего мира</p>
                        </div>
                        
                        <div class="feature-card fade-up">
                            <div class="feature-icon">
                                <i class="fas fa-tools"></i>
                            </div>
                            <h3 class="feature-title">Точная обработка</h3>
                            <p class="feature-description">Современное оборудование и опытные мастера</p>
                        </div>
                        
                        <div class="feature-card fade-up">
                            <div class="feature-icon">
                                <i class="fas fa-truck-fast"></i>
                            </div>
                            <h3 class="feature-title">Быстрая доставка</h3>
                            <p class="feature-description">Доставка по всей России в кратчайшие сроки</p>
                        </div>
                    </div>
                </div>
                
                <div class="scroll-hint">
                    <div class="mouse">
                        <div class="wheel"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Остальные секции -->
        @php $sectionIndex = 1; @endphp
        @foreach($sections as $section)
            @if(!isset($section->is_hero) || !$section->is_hero)
                <div class="section" data-section="{{ $sectionIndex }}">
                    @if($section->background_image)
                        <div class="section-background">
                            <img src="{{ $section->background_image }}" 
                                alt="{{ $section->title }}" 
                                class="background-image">
                            <div class="gradient-overlay"></div>
                        </div>
                    @endif
                    
                    <div class="section-content">
                        <div class="content-wrapper">
                            <h2 class="section-title">{{ $section->title }}</h2>
                            <div class="section-description">
                                {!! nl2br(e($section->description)) !!}
                            </div>
                            
                            @if(isset($section->buttons) && $section->buttons)
                                <div class="buttons">
                                    @foreach($section->buttons as $button)
                                        <a href="{{ $button['url'] }}" class="btn {{ $button['style'] ?? '' }}">
                                            {{ $button['text'] }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    @if(!$loop->last)
                        <div class="scroll-hint">
                            <div class="arrow-down">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/>
                                </svg>
                            </div>
                        </div>
                    @endif
                </div>
                @php $sectionIndex++; @endphp
            @endif
        @endforeach
        
        <!-- Индикаторы секций -->
        <div class="section-indicators">
            <div class="indicator active" data-index="0"></div>
            @php $indicatorIndex = 1; @endphp
            @foreach($sections as $section)
                @if(!isset($section->is_hero) || !$section->is_hero)
                    <div class="indicator" data-index="{{ $indicatorIndex }}"></div>
                    @php $indicatorIndex++; @endphp
                @endif
            @endforeach
        </div>
    @else
        <!-- Запасной вариант, если секции не найдены -->
        <div class="section hero-section active" data-section="0">
            <div class="section-background">
                <div class="animated-gradient"></div>
                <img src="{{ asset('images/hero-bg.jpg') }}" alt="Главная" class="background-image">
                <div class="gradient-overlay"></div>
            </div>
            
            <div class="section-content">
                <div class="content-wrapper">
                    <h1 class="section-title">Натуральный камень для вашего интерьера</h1>
                    <div class="section-description">
                        Создайте уникальное пространство с нашей коллекцией премиального натурального камня
                    </div>
                    
                    <div class="buttons">
                        <a href="{{ route('stone-types') }}" class="btn">
                            Каталог
                        </a>
                        <a href="{{ route('contacts') }}" class="btn btn-outline">
                            Контакты
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('.section');
    const indicators = document.querySelectorAll('.indicator');
    const fadeElements = document.querySelectorAll('.fade-up');
    const pageContent = document.querySelector('.page-content');
    const footer = document.querySelector('.footer');
    
    // Добавляем класс для последней секции
    if (sections.length > 0) {
        sections[sections.length - 1].classList.add('last-section');
    }
    
    // Настройки для Intersection Observer
    const observerOptions = {
        root: null,
        threshold: 0.5,
        rootMargin: '0px'
    };

    // Observer для секций
    const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Активируем текущую секцию
                entry.target.classList.add('active');
                
                // Обновляем индикатор
                const sectionIndex = entry.target.dataset.section;
                indicators.forEach(indicator => {
                    indicator.classList.remove('active');
                    if (indicator.dataset.index === sectionIndex) {
                        indicator.classList.add('active');
                    }
                });
            } else {
                entry.target.classList.remove('active');
            }
        });
    }, observerOptions);

    // Observer для анимации элементов
    const fadeObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });

    // Наблюдаем за секциями
    sections.forEach(section => {
        sectionObserver.observe(section);
    });
    
    // Наблюдаем за элементами с анимацией
    fadeElements.forEach(element => {
        fadeObserver.observe(element);
    });

    // Обработчик клика по индикаторам
    indicators.forEach(indicator => {
        indicator.addEventListener('click', () => {
            const targetIndex = indicator.dataset.index;
            const targetSection = document.querySelector(`.section[data-section="${targetIndex}"]`);
            
            if (targetSection) {
                // Плавная прокрутка к секции
                targetSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
    
    // Обработчик клика по стрелке вниз
    const scrollHints = document.querySelectorAll('.scroll-hint');
    scrollHints.forEach(hint => {
        hint.addEventListener('click', () => {
            const currentSection = hint.closest('.section');
            const nextSection = currentSection.nextElementSibling;
            
            if (nextSection && nextSection.classList.contains('section')) {
                // Плавная прокрутка к следующей секции
                nextSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
    
    // Обработка колесика мыши для плавной прокрутки
    let isScrolling = false;
    let currentSectionIndex = 0;
    let isFooterVisible = false;
    
    // Функция для определения текущей активной секции
    function updateCurrentSection() {
        sections.forEach((section, index) => {
            const rect = section.getBoundingClientRect();
            if (rect.top <= window.innerHeight / 2 && rect.bottom >= window.innerHeight / 2) {
                currentSectionIndex = index;
            }
        });
        
        // Проверяем видимость футера
        if (footer) {
            const footerRect = footer.getBoundingClientRect();
            isFooterVisible = footerRect.top < window.innerHeight;
            
            // Добавляем или удаляем класс в зависимости от видимости футера
            if (isFooterVisible) {
                pageContent.classList.add('footer-visible');
            } else {
                pageContent.classList.remove('footer-visible');
            }
        }
    }
    
    // Инициализация текущей секции
    updateCurrentSection();
    
    // Обработчик события прокрутки
    pageContent.addEventListener('scroll', function() {
        if (!isScrolling) {
            updateCurrentSection();
        }
    });
    
    // Обработчик события колесика мыши
    window.addEventListener('wheel', function(e) {
        if (isScrolling) return;
        
        // Обновляем информацию о видимости футера
        updateCurrentSection();
        
        // Если футер видим и прокрутка вниз, не делаем ничего
        if (isFooterVisible && e.deltaY > 0) {
            return;
        }
        
        // Если последняя секция активна и прокрутка вниз, не перехватываем событие
        if (currentSectionIndex === sections.length - 1 && e.deltaY > 0) {
            return;
        }
        
        isScrolling = true;
        
        if (e.deltaY > 0 && currentSectionIndex < sections.length - 1) {
            // Прокрутка вниз
            currentSectionIndex++;
        } else if (e.deltaY < 0 && currentSectionIndex > 0) {
            // Прокрутка вверх
            currentSectionIndex--;
        }
        
        // Прокрутка к выбранной секции
        sections[currentSectionIndex].scrollIntoView({ behavior: 'smooth' });
        
        // Обновляем индикаторы
        indicators.forEach(indicator => {
            indicator.classList.remove('active');
            if (indicator.dataset.index == sections[currentSectionIndex].dataset.section) {
                indicator.classList.add('active');
            }
        });
        
        // Сбрасываем флаг прокрутки после завершения анимации
        setTimeout(() => {
            isScrolling = false;
        }, 800);
    }, { passive: true });
});
</script>
@endpush