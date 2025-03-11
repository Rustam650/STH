<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class HomeSectionController extends Controller
{
    public function index()
    {
        $sections = HomeSection::query()
            ->orderByRaw('CASE WHEN is_hero = 1 THEN 0 ELSE 1 END')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($section) {
                $section->background_image = $this->getImageUrl($section->background_image);
                return $section;
            });
        
        return view('admin.home_sections.index', compact('sections'));
    }

    public function create()
    {
        // Определяем следующую позицию
        $nextPosition = HomeSection::max('position') + 1;
        return view('admin.home_sections.create', compact('nextPosition'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'background_image' => 'required_if:bg_type,file|image|mimes:jpeg,png,jpg,gif|max:2048',
            'background_url' => 'required_if:bg_type,url|url',
            'is_hero' => 'boolean',
            'active' => 'boolean',
        ]);

        try {
            $homeSection = new HomeSection();
            $homeSection->title = $validated['title'];
            $homeSection->description = $validated['description'];
            $homeSection->is_hero = $request->boolean('is_hero');
            $homeSection->active = $request->boolean('active');

            if ($request->bg_type === 'file' && $request->hasFile('background_image')) {
                $path = $request->file('background_image')->store('home-sections', 'public');
                if (!$path) {
                    throw new \Exception('Ошибка при сохранении изображения');
                }
                $homeSection->background_image = $path;
            } elseif ($request->bg_type === 'url') {
                $homeSection->background_image = $request->background_url;
            }

            $homeSection->save();

            return redirect()
                ->route('admin.home_sections.index')
                ->with('success', 'Секция успешно создана');

        } catch (\Exception $e) {
            \Log::error('Ошибка создания секции: ' . $e->getMessage());
            return back()
                ->withInput()
                ->withErrors(['error' => 'Ошибка при сохранении секции: ' . $e->getMessage()]);
        }
    }

    public function edit(HomeSection $homeSection)
    {
        return view('admin.home_sections.edit', compact('homeSection'));
    }

    public function update(Request $request, HomeSection $homeSection)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'bg_type' => 'required|in:file,url,keep',
                'background_image' => 'nullable|file|image|max:5120',
                'background_url' => 'nullable|url',
                'position' => 'nullable|integer',
                'is_hero' => 'nullable|boolean',
                'active' => 'nullable|boolean',
            ]);

            // Обработка изображения
            if ($request->bg_type === 'file' && $request->hasFile('background_image')) {
                // Удаляем старое изображение, если оно существует
                if ($homeSection->background_image && !filter_var($homeSection->background_image, FILTER_VALIDATE_URL)) {
                    Storage::disk('public')->delete($homeSection->background_image);
                }
                $homeSection->background_image = $request->file('background_image')->store('home_sections', 'public');
            } elseif ($request->bg_type === 'url' && $request->filled('background_url')) {
                $homeSection->background_image = $request->background_url;
            }

            // Обновление остальных полей
            $homeSection->title = $validated['title'];
            $homeSection->description = $validated['description'];
            $homeSection->position = $request->position ?? $homeSection->position;
            $homeSection->is_hero = $request->boolean('is_hero');
            $homeSection->active = $request->boolean('active');

            $homeSection->save();

            return redirect()->route('admin.home_sections.index')
                ->with('success', 'Секция успешно обновлена');

        } catch (\Exception $e) {
            Log::error('Ошибка обновления секции: ' . $e->getMessage());
            return back()
                ->withInput()
                ->withErrors(['error' => 'Произошла ошибка при обновлении секции']);
        }
    }

    public function destroy(HomeSection $homeSection)
    {
        // Если путь к изображению не является URL, удаляем его
        if (!filter_var($homeSection->background_image, FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete($homeSection->background_image);
        }
        
        // Удаляем секцию
        $homeSection->delete();

        return redirect()->route('admin.home_sections.index')
            ->with('success', 'Секция успешно удалена');
    }

    // Изменение порядка секций
    public function reorder(Request $request)
    {
        $positions = $request->positions;
        
        foreach ($positions as $id => $position) {
            HomeSection::where('id', $id)->update(['position' => $position]);
        }
        
        return response()->json(['success' => true]);
    }

    private function getImageUrl($path)
    {
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }
        
        if ($path && Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->url($path);
        }
        
        return asset('images/fallback.jpg');
    }

    protected function handleImageUpload(Request $request, HomeSection $section)
    {
        if ($request->hasFile('background_image')) {
            // Удаляем старое изображение если оно существует
            if ($section->background_image) {
                Storage::delete($section->background_image);
            }

            // Сохраняем новое изображение
            $path = $request->file('background_image')->store('sections', 'public');
            return $path;
        }

        return $section->background_image;
    }
}
