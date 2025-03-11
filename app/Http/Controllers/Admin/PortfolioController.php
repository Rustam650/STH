<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioImage;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::latest()->paginate(10);
        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function create()
    {
        return view('admin.portfolio.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'year' => 'nullable|integer|min:2000|max:' . date('Y'),
            'images' => 'required|array',
            'images.*' => 'required|url'
        ]);

        $portfolio = Portfolio::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? '',
            'year' => $validated['year'] ?? date('Y'),
            'category' => $validated['category'] ?? null
        ]);

        foreach ($validated['images'] as $index => $image) {
            PortfolioImage::create([
                'portfolio_id' => $portfolio->id,
                'image' => $image,
                'order' => $index
            ]);
        }

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Работа успешно добавлена');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('admin.portfolio.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'year' => 'nullable|integer|min:2000|max:' . date('Y'),
            'images' => 'nullable|array',
            'images.*' => 'nullable|url'
        ]);

        $portfolio->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? '',
            'year' => $validated['year'] ?? date('Y'),
            'category' => $validated['category'] ?? null
        ]);

        if (isset($validated['images'])) {
            // Удаляем старые изображения
            $portfolio->images()->delete();
            
            // Добавляем новые изображения
            foreach ($validated['images'] as $index => $image) {
                if ($image) {
                    PortfolioImage::create([
                        'portfolio_id' => $portfolio->id,
                        'image' => $image,
                        'order' => $index
                    ]);
                }
            }
        }

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Работа успешно обновлена');
    }

    public function destroy(Portfolio $portfolio)
    {
        try {
            $portfolio->images()->delete();
            $portfolio->delete();
            return redirect()
                ->route('admin.portfolio.index')
                ->with('success', 'Работа успешно удалена');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Произошла ошибка при удалении']);
        }
    }
}