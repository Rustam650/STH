<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSection;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $sectionsCount = HomeSection::count();
        $activeSectionsCount = HomeSection::where('active', true)->count();
        $recentSections = HomeSection::latest()
            ->take(5)
            ->get()
            ->map(function ($section) {
                $section->background_image = $this->getImageUrl($section->background_image);
                return $section;
            });

        return view('admin.home', compact('sectionsCount', 'activeSectionsCount', 'recentSections'));
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
