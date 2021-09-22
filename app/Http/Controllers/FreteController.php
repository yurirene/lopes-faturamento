<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FreteController extends Controller
{
    public function index()
    {
        return view('fretes.index');
    }
}
