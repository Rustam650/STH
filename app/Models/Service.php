<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image'
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