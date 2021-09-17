<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CidadeController extends Controller
{
    public function index()
    {
        return view('cidades.index');
    }
}
