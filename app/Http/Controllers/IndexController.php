<?php

namespace App\Http\Controllers;

use App\Models\RadkyModel;

class IndexController extends Controller
{
    public function index()
    {
        $radky = RadkyModel::count();
        return view('index', ['radky' => $radky]);
    }
}
