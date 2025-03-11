<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioImage extends Model
{
    protected $fillable = [
        'portfolio_id',
        'image',
        'position'
    ];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}