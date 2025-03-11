<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoneType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoneTypeController extends Controller
{
    public function index()
    {
        $stoneTypes = StoneType::latest()->paginate(10);
        return view('admin.stone-types.index', compact('stoneTypes'));
    }

    public function create()
    {
        return view('admin.stone-types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'full_description' => 'nullable',
            'image' => 'required|url'
        ]);

        StoneType::create($validated);

        return redirect()->route('admin.stone-types.index')
            ->with('success', 'Вид камня успешно добавлен');
    }

    public function edit(StoneType $stoneType)
    {
        return view('admin.stone-types.edit', compact('stoneType'));
    }

    public function update(Request $request, StoneType $stoneType)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'full_description' => 'nullable',
            'image' => 'required|url'
        ]);

        $stoneType->update($validated);

        return redirect()->route('admin.stone-types.index')
            ->with('success', 'Вид камня успешно обновлен');
    }

    public function destroy(StoneType $stoneType)
    {
        $stoneType->delete();
        return redirect()->route('admin.stone-types.index')
            ->with('success', 'Вид камня успешно удален');
    }
} 