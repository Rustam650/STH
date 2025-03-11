@extends('admin.layouts.app')

@section('title', 'Управление видами камня')

@section('header', 'Виды камня')

@section('content')
<div class="stone-types-container">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-900">Виды камня</h2>
        <a href="{{ route('admin.stone-types.create') }}" class="bg-[#FFC145] text-[#1D1D1D] px-4 py-2 rounded hover:bg-[#FFD175]">
            + Добавить вид камня
        </a>
    </div>

    <div class="stone-types-grid">
        @foreach($stoneTypes as $stoneType)
        <div class="stone-card">
            <div class="stone-card-image">
                <img src="{{ $stoneType->image }}" alt="{{ $stoneType->title }}">
            </div>
            <div class="stone-card-content">
                <h3>{{ $stoneType->title }}</h3>
                <p>{{ Str::limit($stoneType->description, 100) }}</p>
                <div class="stone-card-actions">
                    <a href="{{ route('admin.stone-types.edit', $stoneType) }}" class="edit-btn">
                        Редактировать
                    </a>
                    <form action="{{ route('admin.stone-types.destroy', $stoneType) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn" onclick="return confirm('Вы уверены?')">
                            Удалить
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
/* Только специфичные стили для админ-панели */
.edit-btn {
    background-color: #FFC145;
    color: #1D1D1D;
    padding: 8px 16px;
    border-radius: 5px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
}

.delete-btn {
    background-color: red;
    color: white;
    padding: 8px 16px;
    border-radius: 5px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    cursor: pointer;
}

.edit-btn:hover {
    background-color: #FFD175;
}

.delete-btn:hover {
    background-color: #B11919;
}
</style>

@if(session('success'))
<div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
    {{ session('success') }}
</div>
@endif
@endsection 