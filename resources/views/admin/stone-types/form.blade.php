@extends('admin.layouts.app')

@section('title', isset($stoneType) ? 'Редактировать вид камня' : 'Добавить вид камня')

@section('content')
<div class="container-fluid">
    <h1>{{ isset($stoneType) ? 'Редактировать вид камня' : 'Добавить вид камня' }}</h1>

    <form action="{{ isset($stoneType) ? route('admin.stone-types.update', $stoneType) : route('admin.stone-types.store') }}" 
          method="POST" class="mt-4">
        @csrf
        @if(isset($stoneType))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Название</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                   id="name" name="name" value="{{ old('name', $stoneType->name ?? '') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control @error('description') is-invalid @enderror" 
                      id="description" name="description" rows="3">{{ old('description', $stoneType->description ?? '') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">URL изображения</label>
            <input type="url" class="form-control @error('image') is-invalid @enderror" 
                   id="image" name="image" value="{{ old('image', $stoneType->image ?? '') }}">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Цена</label>
            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                   id="price" name="price" value="{{ old('price', $stoneType->price ?? '') }}">
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_available" name="is_available" 
                   value="1" {{ old('is_available', $stoneType->is_available ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_available">Доступен</label>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="full_description">
                Полное описание
            </label>
            <textarea name="full_description" id="full_description" rows="6" 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('full_description', $stoneType->full_description ?? '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="{{ route('admin.stone-types.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
</div>
@endsection 