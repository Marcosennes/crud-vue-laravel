<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $user = "Teste";

        // return view('welcome', compact('user'));
        return response()->json(['status' => true]);
    }

    public function about(){
    }
}
