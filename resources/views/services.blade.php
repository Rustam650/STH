@extends('layouts.app')

@section('title', 'Услуги - Stone Hill')

@section('content')
<div class="section-container">
    <div class="container py-5">
        <h1 class="services-title">Наши услуги</h1>
        
        <div class="page-content">
            <!-- Существующее содержимое страницы -->
            @if(isset($services) && $services->count() > 0)
                <div class="services-grid">
                    @foreach($services as $service)
                        <!-- Карточка услуги -->
                    @endforeach
                </div>
            @else
                <div class="empty-page-content">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        Информация об услугах скоро появится
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
