@extends('admin.layouts.app')

@section('title', 'Добавление работы в портфолио')

@section('content')
    <div class="d-flex flex-column align-items-center">
        <div class="mb-4 text-center">
            <h1 class="h3 mb-0">Добавление работы в портфолио</h1>
        </div>
        
        @include('admin.portfolio.form')
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endpush