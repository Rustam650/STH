<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('admin.contacts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        Contact::create($validated);

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Контакт успешно добавлен');
    }

    public function edit(Contact $contact)
    {
        // Передаем переменную $contact в представление
        return view('admin.contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        $contact->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Контакт успешно обновлен');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Контакт успешно удален');
    }
}