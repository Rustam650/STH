@extends('layouts.app')

@section('title', 'Наши работы')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
@endsection

@section('content')
<div class="min-h-screen bg-gray-100 py-12">
    <div class="container mx-auto px-4">
        <h1 class="page-title">Наши работы</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($portfolios as $portfolio)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden portfolio-item">
                    <div class="relative aspect-w-4 aspect-h-3">
                        @if($portfolio->images->isNotEmpty())
                            <img src="{{ Storage::url($portfolio->images->first()->image) }}" 
                                 alt="{{ $portfolio->title }}" 
                                 class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">{{ $portfolio->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($portfolio->description, 100) }}</p>
                        <button class="view-portfolio text-blue-600 hover:text-blue-800" 
                                data-id="{{ $portfolio->id }}">
                            Подробнее
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">
                    Проекты пока не добавлены
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Модальное окно -->
<div id="portfolioModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="modal-container bg-white w-full max-w-4xl mx-auto my-8 rounded-lg shadow-xl overflow-hidden">
        <div class="relative">
            <!-- Слайдер изображений -->
            <div class="slider-container relative h-96">
                <div id="portfolioSlider" class="h-full"></div>
                <button id="prevSlide" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 p-2 text-white">
                    ←
                </button>
                <button id="nextSlide" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 p-2 text-white">
                    →
                </button>
            </div>
            
            <!-- Информация о проекте -->
            <div class="p-6">
                <h2 id="modalTitle" class="text-2xl font-bold mb-4"></h2>
                <p id="modalDescription" class="text-gray-600"></p>
                
                <div class="flex justify-end mt-4">
                    <button id="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Закрыть
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('portfolioModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');
    const slider = document.getElementById('portfolioSlider');
    let currentSlide = 0;
    let slides = [];

    // Открытие модального окна
    document.querySelectorAll('.view-portfolio').forEach(button => {
        button.addEventListener('click', async () => {
            const id = button.dataset.id;
            try {
                const response = await fetch(`/api/portfolio/${id}`);
                const data = await response.json();
                
                modalTitle.textContent = data.title;
                modalDescription.textContent = data.description;
                
                // Настройка слайдера
                slides = data.images;
                currentSlide = 0;
                updateSlider();
                
                modal.classList.remove('hidden');
            } catch (error) {
                console.error('Error:', error);
            }
        });
    });

    // Закрытие модального окна
    document.getElementById('closeModal').addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    // Управление слайдером
    document.getElementById('prevSlide').addEventListener('click', () => {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        updateSlider();
    });

    document.getElementById('nextSlide').addEventListener('click', () => {
        currentSlide = (currentSlide + 1) % slides.length;
        updateSlider();
    });

    function updateSlider() {
        if (slides.length > 0) {
            slider.innerHTML = `
                <img src="${slides[currentSlide]}" 
                     class="w-full h-full object-contain" 
                     alt="Portfolio image">
            `;
        }
    }
});
</script>
@endpush
@endsection
