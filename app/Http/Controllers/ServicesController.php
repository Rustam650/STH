<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServicesController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }
} 