@extends('admin.layouts.app')

@section('title', 'Создание новой секции')

@section('content')
<div class="admin-container py-6">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <form action="{{ route('admin.home_sections.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Название секции</label>
                <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" 
                       value="{{ old('title') }}" required>
                @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Описание</label>
                <textarea name="description" id="description" rows="4" 
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Фоновое изображение</label>
                <div class="mt-2">
                    <div class="flex items-center">
                        <input type="radio" name="bg_type" value="file" id="bg_file" class="mr-2" checked>
                        <label for="bg_file" class="mr-4">Загрузить файл</label>
                        
                        <input type="radio" name="bg_type" value="url" id="bg_url" class="mr-2">
                        <label for="bg_url">Указать URL</label>
                    </div>
                </div>

                <div id="file_upload" class="mt-2">
                    <input type="file" name="background_image" id="background_image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>

                <div id="url_input" class="mt-2 hidden">
                    <input type="url" name="background_url" id="background_url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" 
                           placeholder="https://example.com/image.jpg">
                </div>

                <div id="image_preview" class="mt-4 hidden">
                    <img src="" alt="Preview" class="h-24 w-24 object-cover rounded-lg border-2 border-gray-200">
                </div>
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="is_hero" value="1" 
                           {{ old('is_hero') ? 'checked' : '' }} 
                           class="rounded border-gray-300 text-indigo-600 shadow-sm">
                    <span class="ml-2 text-sm text-gray-600">Главная секция</span>
                </label>
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="active" value="1" 
                           {{ old('active', true) ? 'checked' : '' }} 
                           class="rounded border-gray-300 text-indigo-600 shadow-sm">
                    <span class="ml-2 text-sm text-gray-600">Активная секция</span>
                </label>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.home_sections.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Отмена
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Создать секцию
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const bgTypeRadios = document.querySelectorAll('input[name="bg_type"]');
    const fileUpload = document.getElementById('file_upload');
    const urlInput = document.getElementById('url_input');
    const imagePreview = document.getElementById('image_preview');
    const previewImage = imagePreview.querySelector('img');
    const fileInput = document.getElementById('background_image');
    const urlField = document.getElementById('background_url');

    function updateVisibility() {
        const selectedType = document.querySelector('input[name="bg_type"]:checked').value;
        fileUpload.classList.toggle('hidden', selectedType !== 'file');
        urlInput.classList.toggle('hidden', selectedType !== 'url');
        imagePreview.classList.add('hidden');
        previewImage.src = '';
    }

    // Предпросмотр загруженного файла
    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                imagePreview.classList.remove('hidden');
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Предпросмотр URL изображения
    let urlDebounceTimer;
    urlField.addEventListener('input', function() {
        clearTimeout(urlDebounceTimer);
        urlDebounceTimer = setTimeout(() => {
            const url = this.value;
            if (url && url.match(/\.(jpeg|jpg|gif|png)$/) != null) {
                previewImage.src = url;
                imagePreview.classList.remove('hidden');
            } else {
                imagePreview.classList.add('hidden');
            }
        }, 300);
    });

    bgTypeRadios.forEach(radio => {
        radio.addEventListener('change', updateVisibility);
    });

    updateVisibility();
});
</script>
@endpush
@endsection