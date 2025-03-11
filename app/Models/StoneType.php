<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoneType extends Model
{
    protected $fillable = [
        'name',
        'title',
        'description',
        'full_description',
        'image',
        'is_available'
    ];

    public function getNameAttribute($value)
    {
        return $this->title ?? $value;
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        if (!isset($this->attributes['title'])) {
            $this->attributes['title'] = $value;
        }
    }
} 