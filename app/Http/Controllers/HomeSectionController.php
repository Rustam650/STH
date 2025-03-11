public function index()
{
    $sections = HomeSection::where('active', true)
        ->orderByRaw('CASE WHEN is_hero = 1 THEN 0 ELSE 1 END')
        ->orderBy('position', 'asc')
        ->get()
        ->map(function ($section) {
            // Преобразуем путь изображения в полный URL
            $section->background_image = $this->getImageUrl($section->background_image);
            return $section;
        });

    return view('home', compact('sections'));
}

private function getImageUrl($path)
{
    if (filter_var($path, FILTER_VALIDATE_URL)) {
        return $path; // Если это уже URL, возвращаем как есть
    }
    
    if ($path && Storage::disk('public')->exists($path)) {
        return Storage::disk('public')->url($path);
    }
    
    return asset('images/fallback.jpg'); // Путь к изображению по умолчанию
}
