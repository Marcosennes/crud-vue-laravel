<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return response()->json(['mensagem' => "Bem vindo ao backend do projeto!"]);
    }

    public function about(){
    }
}
