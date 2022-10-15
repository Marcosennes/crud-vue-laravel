<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstadoRequest;
use App\Models\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EstadoController extends Controller
{
    public function __construct()
    {
        
    }

    public function index(){
        $estados = Estado::all();
        
        return response()->json(['estados' => $estados]);
    }

    public function inserir(EstadoRequest $request){

        Estado::create($request->all());

        return response()->json([
            'success'   => true,
            'message'   => 'Estado inserido com sucesso.'
        ]);
    }

    public function alterar($id, Request $request){

    }

    public function detalhar($id){
        $estado = Estado::find($id);

        return response()->json(['estado' => $estado]);
    }
    
    public function excluir($id){
        $estado = Estado::find(intval($id));
        $exclusao_confirmacao = $estado->delete();

        if($exclusao_confirmacao){
            return response()->json([
                'success'   => true,
                'message'   => 'O Estado ' . $estado->nome . ' foi excluído com sucesso.'
            ]);
        } else{
            return response()->json([
                'success'   => false,
                'message'   => 'O Estado ' . $estado->nome . ' não pode ser excluído.'
            ]);
        }

    }
}
