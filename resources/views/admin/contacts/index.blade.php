@extends('admin.layouts.app')

@section('title', 'Управление контактами')

@section('content')
<div class="d-flex">
    <h1 class="text-2xl font-bold text-gray-900">Управление контактами</h1>
    <a href="{{ route('admin.contacts.create') }}" class="add-contact-btn">+ Добавить контакт</a>
</div>

<div class="contact-cards-grid">
    @foreach($contacts as $contact)
        <div class="contact-card">
            <h3 class="contact-card__title">{{ $contact->title }}</h3>
            <p class="contact-card__info">{{ $contact->content }}</p>
            <div class="contact-card__actions">
                <a href="{{ route('admin.contacts.edit', $contact) }}" class="edit-btn">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn" onclick="return confirm('Удалить этот контакт?')">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/contacts-edit.css') }}">
@endsection 