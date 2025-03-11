@extends('admin.layouts.app')

@section('title', isset($portfolio) ? 'Редактировать работу' : 'Добавить работу')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/portfolio-form.css') }}">
@endsection

@section('content')
<div class="container mx-auto" style="max-width: 1024px;">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 pt-4">
            <h1 class="card-title fs-2 mb-0 text-center">{{ isset($portfolio) ? 'Редактирование работы' : 'Добавление новой работы' }}</h1>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <strong>Ошибка!</strong> Пожалуйста, проверьте введенные данные.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <ul class="mt-2 mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ isset($portfolio) ? route('admin.portfolio.update', $portfolio) : route('admin.portfolio.store') }}" 
                  method="POST" 
                  id="portfolioForm" 
                  class="needs-validation" 
                  enctype="multipart/form-data" 
                  novalidate>
                @csrf
                @if(isset($portfolio))
                    @method('PUT')
                @endif

                <div class="row justify-content-center">
                    <!-- Основная информация -->
                    <div class="col-lg-8">
                        <div class="mb-4">
                            <label for="title" class="form-label">Название работы <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title', $portfolio->title ?? '') }}"
                                   placeholder="Введите название работы" 
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label">Описание <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="6"
                                      placeholder="Подробно опишите проект, его цели и результаты"
                                      required>{{ old('description', $portfolio->description ?? '') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text text-end"><span id="charCount">0</span>/1000</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="year" class="form-label">Год выполнения</label>
                                    <input type="number" 
                                           class="form-control @error('year') is-invalid @enderror" 
                                           id="year" 
                                           name="year" 
                                           value="{{ old('year', $portfolio->year ?? date('Y')) }}"
                                           min="2000"
                                           max="{{ date('Y') }}">
                                    @error('year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="card border-0 bg-light mb-4">
                            <div class="card-body">
                                <h2 class="fs-5 mb-3">Изображения проекта</h2>
                                
                                <div class="image-upload-container mb-3">
                                    <div class="image-upload-dropzone" id="image-dropzone">
                                        <i class="bi bi-cloud-arrow-up fs-1"></i>
                                        <p>Перетащите изображения сюда или нажмите для выбора</p>
                                        <p class="text-muted small">PNG, JPG или WEBP (макс. 5 файлов)</p>
                                    </div>
                                    
                                    <div class="image-url-input mt-3">
                                        <div class="input-group">
                                            <input type="url" class="form-control" id="image-url-input" placeholder="Или вставьте URL изображения">
                                            <button class="btn btn-primary" type="button" id="add-image-url">
                                                <i class="bi bi-plus-lg"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="image-preview-container" id="image-preview-container">
                                    @if(isset($portfolio) && $portfolio->images->isNotEmpty())
                                        @foreach($portfolio->images as $image)
                                            <div class="image-preview-item" data-url="{{ $image->image }}">
                                                <img src="{{ $image->image }}" alt="Превью изображения">
                                                <div class="image-preview-actions">
                                                    <button type="button" class="btn btn-sm btn-danger image-preview-remove">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                                <input type="hidden" name="images[]" value="{{ $image->image }}">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                
                                <div class="text-center mt-2">
                                    <span class="badge bg-primary" id="image-counter">
                                        Добавлено: <span id="image-count">{{ isset($portfolio) ? $portfolio->images->count() : '0' }}</span>/5
                                    </span>
                                </div>
                                
                                <div class="alert alert-danger mt-3" id="image-error" style="display:none;"></div>
                            </div>
                        </div>

                        <hr class="my-4">
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.portfolio.index') }}" class="btn btn-light">
                                <i class="bi bi-arrow-left me-1"></i> Вернуться к списку
                            </a>
                            <div>
                                <button type="submit" class="btn btn-primary btn-lg px-4">
                                    <i class="bi bi-save me-1"></i> {{ isset($portfolio) ? 'Сохранить изменения' : 'Создать работу' }}
                                </button>
                            </div>
                            <div style="width: 140px;"><!-- Пустой элемент для баланса макета --></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection



@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const MAX_IMAGES = 5;
    const imagePreviewContainer = document.getElementById('image-preview-container');
    const imageUrlInput = document.getElementById('image-url-input');
    const addImageUrlButton = document.getElementById('add-image-url');
    const imageDropzone = document.getElementById('image-dropzone');
    const imageCountElement = document.getElementById('image-count');
    const imageCounter = document.getElementById('image-counter');
    const imageError = document.getElementById('image-error');
    const descriptionField = document.getElementById('description');
    const charCount = document.getElementById('charCount');
    
    // Счетчик символов
    if (descriptionField && charCount) {
        function updateCharCount() {
            const currentLength = descriptionField.value.length;
            charCount.textContent = currentLength;
            if (currentLength > 1000) {
                charCount.classList.add('text-danger');
            } else {
                charCount.classList.remove('text-danger');
            }
        }
        
        descriptionField.addEventListener('input', updateCharCount);
        updateCharCount(); // При загрузке страницы
    }
    
    // Функция обновления счетчика изображений
    function updateImageCount() {
        const currentCount = imagePreviewContainer.querySelectorAll('.image-preview-item').length;
        if (imageCountElement) {
            imageCountElement.textContent = currentCount;
        }
        
        if (currentCount >= MAX_IMAGES) {
            imageDropzone.classList.add('disabled');
            imageUrlInput.disabled = true;
            addImageUrlButton.disabled = true;
            imageCounter.classList.remove('bg-primary');
            imageCounter.classList.add('bg-danger');
        } else {
            imageDropzone.classList.remove('disabled');
            imageUrlInput.disabled = false;
            addImageUrlButton.disabled = false;
            imageCounter.classList.remove('bg-danger');
            imageCounter.classList.add('bg-primary');
        }
        
        return currentCount;
    }
    
    // Создание элемента превью изображения
    function createImagePreview(url) {
        const div = document.createElement('div');
        div.className = 'image-preview-item';
        div.dataset.url = url;
        div.innerHTML = `
            <img src="${url}" alt="Превью изображения">
            <div class="image-preview-actions">
                <button type="button" class="btn btn-sm btn-danger image-preview-remove">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
            <input type="hidden" name="images[]" value="${url}">
        `;
        return div;
    }
    
    // Проверка URL изображения
    function isValidImageUrl(url) {
        return /\.(jpeg|jpg|png|gif|webp|svg)$/i.test(url);
    }
    
    // Валидация формы
    function validateForm() {
        const currentCount = updateImageCount();
        
        if (currentCount === 0) {
            showError('Добавьте хотя бы одно изображение работы');
            return false;
        }
        
        return true;
    }
    
    function showError(message) {
        imageError.textContent = message;
        imageError.style.display = 'block';
        setTimeout(() => {
            imageError.style.display = 'none';
        }, 5000);
    }

    // Добавление изображения по URL
    addImageUrlButton.addEventListener('click', function() {
        const url = imageUrlInput.value.trim();
        if (!url) {
            showError('Пожалуйста, введите URL изображения');
            return;
        }
        
        if (!isValidImageUrl(url)) {
            showError('Пожалуйста, укажите корректный URL изображения (JPG, PNG, WEBP, GIF, SVG)');
            return;
        }
        
        const currentCount = updateImageCount();
        if (currentCount >= MAX_IMAGES) {
            showError(`Максимальное количество изображений: ${MAX_IMAGES}`);
            return;
        }
        
        // Проверка на дубликаты
        const isDuplicate = Array.from(imagePreviewContainer.querySelectorAll('.image-preview-item'))
            .some(item => item.dataset.url === url);
            
        if (isDuplicate) {
            showError('Это изображение уже добавлено');
            return;
        }
        
        // Создание и добавление превью
        const img = new Image();
        img.onload = function() {
            const preview = createImagePreview(url);
            imagePreviewContainer.appendChild(preview);
            imageUrlInput.value = '';
            updateImageCount();
        };
        
        img.onerror = function() {
            showError('Невозможно загрузить изображение по указанному URL');
        };
        
        img.src = url;
    });
    
    // Обработка нажатия Enter в поле URL
    imageUrlInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            addImageUrlButton.click();
        }
    });
    
    // Удаление изображения
    imagePreviewContainer.addEventListener('click', function(e) {
        const removeButton = e.target.closest('.image-preview-remove');
        if (removeButton) {
            const imageItem = removeButton.closest('.image-preview-item');
            if (imageItem) {
                imageItem.remove();
                updateImageCount();
            }
        }
    });
    
    // Drag and Drop функциональность
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        imageDropzone.addEventListener(eventName, function(e) {
            e.preventDefault();
            e.stopPropagation();
        }, false);
    });
    
    ['dragenter', 'dragover'].forEach(eventName => {
        imageDropzone.addEventListener(eventName, function() {
            this.classList.add('dragover');
        }, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        imageDropzone.addEventListener(eventName, function() {
            this.classList.remove('dragover');
        }, false);
    });
    
    // Обработка файлов при Drop и при клике
    imageDropzone.addEventListener('drop', function(e) {
        const files = e.dataTransfer.files;
        handleFiles(files);
    }, false);
    
    imageDropzone.addEventListener('click', function() {
        const input = document.createElement('input');
        input.type = 'file';
        input.multiple = true;
        input.accept = 'image/*';
        
        input.onchange = function() {
            handleFiles(this.files);
        };
        
        input.click();
    });
    
    function handleFiles(files) {
        const currentCount = updateImageCount();
        const remainingSlots = MAX_IMAGES - currentCount;
        
        if (remainingSlots <= 0) {
            showError(`Максимальное количество изображений: ${MAX_IMAGES}`);
            return;
        }
        
        // Проверка количества файлов
        if (files.length > remainingSlots) {
            showError(`Вы можете добавить ещё только ${remainingSlots} изображений`);
        }
        
        // Обработка только доступного количества файлов
        const filesToProcess = Array.from(files).slice(0, remainingSlots);
        
        filesToProcess.forEach(file => {
            if (!file.type.match('image.*')) {
                showError('Один из файлов не является изображением');
                return;
            }
            
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const preview = createImagePreview(e.target.result);
                imagePreviewContainer.appendChild(preview);
                updateImageCount();
            };
            
            reader.readAsDataURL(file);
        });
    }
    
    // Валидация формы перед отправкой
    const form = document.getElementById('portfolioForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            if (!validateForm()) {
                e.preventDefault();
            }
        });
    }
    
    // Инициализация счетчика
    updateImageCount();
});
</script>
@endpush