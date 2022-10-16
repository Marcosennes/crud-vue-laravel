<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstadoCreateRequest;
use App\Http\Requests\EstadoUpdateRequest;
use App\Models\Estado;

class EstadoController extends Controller
{

    public function index(){
        $estados = Estado::all();
        
        return response()->json(['estados' => $estados]);
    }

    public function inserir(EstadoCreateRequest $request){

        $estado = Estado::create($request->all());

        return response()->json([
            'success'   => true,
            'message'   => 'Estado inserido com sucesso.',
            'estado'    => $estado->getAttributes()
        ]);
    }

    public function alterar(EstadoUpdateRequest $request){
        $estado = Estado::find($request->id);
        $estado->nome       = $request->get('nome');
        $estado->abreviacao = $request->get('abreviacao');
        $estado->save();
        
        return response()->json([
            'success'   => true,
            'message'   => 'Estado  ' . $estado->nome . '  alterado com sucesso.',
            'estado'    => $estado->getAttributes()
        ]);       
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
