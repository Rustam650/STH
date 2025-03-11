<?php

namespace App\Http\Controllers;

use App\Models\StoneType;
use Illuminate\Http\Request;

class StoneTypesController extends Controller
{
    public function index()
    {
        $stoneTypes = StoneType::all();
        return view('pages.stone-types', compact('stoneTypes'));
    }
} 