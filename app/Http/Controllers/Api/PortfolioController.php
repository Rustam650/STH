<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PortfolioController extends Controller
{
    /**
     * Получить данные конкретного проекта портфолио
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        try {
            $portfolio = Portfolio::with(['images', 'category'])->findOrFail($id);
            
            // Преобразуем изображения для удобного использования в JS
            $images = $portfolio->images->pluck('image')->toArray();
            
            $result = [
                'id' => $portfolio->id,
                'title' => $portfolio->title,
                'description' => $portfolio->description,
                'year' => $portfolio->year,
                'images' => $images,
            ];
            
            // Добавляем категорию, если она есть
            if ($portfolio->category) {
                $result['category'] = [
                    'id' => $portfolio->category->id,
                    'name' => $portfolio->category->name
                ];
            }
            
            return response()->json($result);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Проект не найден',
                'message' => $e->getMessage()
            ], 404);
        }
    }
}
