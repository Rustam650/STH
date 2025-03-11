@extends('layouts.app')

@section('title', 'Контакты')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/contacts.css') }}">
@endsection

@section('content')
<div id="app">
<div class="contacts-container">
    <h1 class="page-title">Контакты</h1>
    
    <div class="contacts-grid">
        @forelse($contacts as $contact)
        <div class="contact-card">
            <h3 class="contact-card__title">{{ $contact->title }}</h3>
            <div class="contact-card__content">{{ $contact->content }}</div>
        </div>
        @empty
        <div class="col-span-4 text-center py-8 text-gray-500">
            Контактная информация скоро появится
        </div>
        @endforelse
    </div>
</div>
@endsection 