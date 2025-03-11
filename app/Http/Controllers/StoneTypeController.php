<?php

namespace App\Http\Controllers;

use App\Models\StoneType;
use Illuminate\Http\Request;

class StoneTypeController extends Controller
{
    public function index()
    {
        $stoneTypes = StoneType::all();
        return view('stone-types.index', compact('stoneTypes'));
    }
}
