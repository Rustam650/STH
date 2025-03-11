@extends('admin.layouts.app')

@section('title', 'Добавление контакта')

@section('content')
<div class="container-fluid">
    <div class="d-flex">
        <h1 class="text-2xl font-bold text-gray-900">Добавление контакта</h1>
    </div>

    <div class="contacts-form-card">
        <form action="{{ route('admin.contacts.store') }}" method="POST" class="contact-form">
            @csrf
            <div class="contact-form-group">
                <div class="input-group">
                    <div class="input-field">
                        <label>Заголовок</label>
                        <input type="text" name="title" required>
                    </div>
                    <div class="input-field">
                        <label>Информация</label>
                        <input type="text" name="content" required>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="save-button">
                    Добавить
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/contacts-edit.css') }}">
@endsection 