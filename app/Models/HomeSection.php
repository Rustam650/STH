<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'background_image',
        'position',
        'is_hero',
        'active'
    ];

    protected $casts = [
        'is_hero' => 'boolean',
        'active' => 'boolean',
    ];

    // Получить все активные секции, отсортированные по позиции
    public static function getActiveSections()
    {
        return self::where('active', true)
                   ->orderBy('position')
                   ->get();
    }

    // Определяет тип фонового изображения: файл или URL
    public function getBackgroundImageTypeAttribute()
    {
        // Если путь начинается с http или https, то это URL
        if (str_starts_with($this->background_image, 'http')) {
            return 'url';
        }
        return 'file';
    }

    // Получить полный URL к изображению
    public function getBackgroundImageUrlAttribute()
    {
        if (str_starts_with($this->background_image, 'http')) {
            return $this->background_image;
        }
        
        return asset('storage/' . $this->background_image);
    }
}
