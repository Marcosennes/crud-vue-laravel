<?php

namespace App\Http\Controllers;

use App\Http\Requests\CidadeRequest;
use App\Models\Cidade;
use App\Models\Estado;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    public function index(){
        $cidades = Cidade::all();

        foreach($cidades as $cidade){
            $cidade->estadoNome = Estado::find($cidade->estadoId)->nome;
        }
        
        return response()->json(['cidades' => $cidades]);
    }

    public function inserir(CidadeRequest $request){
        $cidade = Cidade::create($request->all());
        $cidade->estadoNome = Estado::find($cidade->estadoId)->nome;
        
        return response()->json([
            'success'   => true,
            'message'   => 'Cidade inserida com sucesso.',
            'cidade'    => $cidade->getAttributes()
        ]);
    }
}
