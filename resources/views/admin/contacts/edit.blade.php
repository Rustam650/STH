@extends('admin.layouts.app')

@section('title', 'Редактирование контакта')

@section('content')
<div class="container-fluid">
    <div class="d-flex">
        <h1 class="text-2xl font-bold text-gray-900">Редактирование контакта</h1>
    </div>

    <div class="contacts-form-card">
        {{-- Проверяем, что переменная $contact определена --}}
        @if(isset($contact))
            <form action="{{ route('admin.contacts.update', $contact) }}" method="POST" class="contact-form">
                @csrf
                @method('PUT')
                <div class="contact-form-group">
                    <div class="input-group">
                        <div class="input-field">
                            <label>Заголовок</label>
                            <input type="text" name="title" value="{{ $contact->title }}" required>
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-field">
                            <label>Информация</label>
                            <input type="text" name="content" value="{{ $contact->content }}" required>
                            @error('content')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="save-button">
                        Сохранить
                    </button>
                </div>
            </form>
        @else
            <div class="alert alert-danger">
                Контакт не найден. <a href="{{ route('admin.contacts.index') }}">Вернуться к списку</a>
            </div>
        @endif
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/contacts-edit.css') }}">
@endsection