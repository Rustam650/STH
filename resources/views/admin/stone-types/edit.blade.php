@extends('admin.layouts.app')

@section('title', 'Редактирование типа камня')

@section('header', 'Редактирование вида камня')

@section('content')
<div class="admin-container py-6">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <form action="{{ route('admin.stone-types.update', $stoneType) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Название</label>
                <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('title', $stoneType->title) }}" required>
                @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Описание</label>
                <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('description', $stoneType->description) }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="full_description" class="block text-sm font-medium text-gray-700">Полное описание</label>
                <textarea name="full_description" id="full_description" rows="6" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('full_description', $stoneType->full_description) }}</textarea>
                @error('full_description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">URL изображения</label>
                <input type="url" name="image" id="image" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('image', $stoneType->image) }}" required>
                @error('image')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.stone-types.index') }}" class="bg-black hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">
                    Отмена
                </a>
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-4 rounded">
                    Сохранить изменения
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 