<?php

namespace App\Http\Controllers;

use App\Models\HomeSection;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $sections = HomeSection::where('active', true)
            ->orderBy('position')
            ->orderByDesc('is_hero')
            ->get()
            ->map(function ($section) {
                $section->background_image = $this->getImageUrl($section->background_image);
                return $section;
            });
            
        return view('home', compact('sections'));
    }

    private function getImageUrl($path)
    {
        if (empty($path)) {
            return asset('images/fallback.jpg');
        }

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }
        
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->url($path);
        }
        
        return asset('images/fallback.jpg');
    }
}