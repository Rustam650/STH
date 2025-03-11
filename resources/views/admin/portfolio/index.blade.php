@extends('admin.layouts.app')

@section('title', 'Управление портфолио')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/portfolio.css') }}">
@endsection

@section('content')
<div class="container" style="max-width: 1024px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Управление портфолио</h1>
        <a href="{{ route('admin.portfolio.create') }}" class="btn btn-add-portfolio">
            <i class="bi bi-plus-lg me-1"></i> + Добавить работу
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px">ID</th>
                            <th>Название</th>
                            <th style="width: 300px">Изображения</th>
                            <th style="width: 200px">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($portfolios as $portfolio)
                            <tr>
                                <td class="text-center">{{ $portfolio->id }}</td>
                                <td>
                                    <div class="portfolio-title">{{ $portfolio->title }}</div>
                                    <div class="portfolio-description">{{ Str::limit($portfolio->description, 100) }}</div>
                                </td>
                                <td>
                                    @if($portfolio->images->isNotEmpty())
                                        <div class="portfolio-images">
                                            @foreach($portfolio->images as $image)
                                                <div class="portfolio-image">
                                                    <img src="{{ $image->image }}" alt="{{ $portfolio->title }}">
                                                    <span class="badge">{{ $loop->iteration }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="badge bg-secondary">Нет изображений</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.portfolio.edit', $portfolio) }}" 
                                           class="btn btn-primary btn-action">
                                            <i class="bi bi-pencil-square me-1"></i>
                                            <span>Редактировать</span>
                                        </a>
                                        <form action="{{ route('admin.portfolio.destroy', $portfolio) }}" 
                                              method="POST" 
                                              class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-action">
                                                <i class="bi bi-trash me-1"></i>
                                                <span>Удалить</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <i class="bi bi-folder text-muted"></i>
                                        <p>Нет работ в портфолио</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $portfolios->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (confirm('Вы уверены, что хотите удалить эту работу?')) {
                this.submit();
            }
        });
    });
});
</script>
@endpush