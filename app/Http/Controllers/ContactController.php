<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Social;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        $socials = Social::all();
        return view('contacts', compact('contacts', 'socials'));
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string'
        ]);
        
        // Здесь можно добавить логику отправки сообщения
        // Например, отправка на email или сохранение в базу данных
        
        // Для примера просто запишем в лог
        \Log::info('Получено сообщение от: ' . $validated['name'] . ' (' . $validated['email'] . ')');
        \Log::info('Текст сообщения: ' . $validated['message']);
        
        return redirect()->route('contacts')
            ->with('success', 'Ваше сообщение успешно отправлено! Мы свяжемся с вами в ближайшее время.');
    }
}