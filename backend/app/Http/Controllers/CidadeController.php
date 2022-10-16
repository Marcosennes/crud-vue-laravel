<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CidadeCreateRequest;
use App\Http\Requests\CidadeUpdateRequest;
use App\Models\Cidade;
use App\Models\Estado;

class CidadeController extends Controller
{
    public function index()
    {
        $cidades = Cidade::all();

        foreach ($cidades as $cidade) {
            $cidade->estadoNome = Estado::find($cidade->estadoId)->nome;
        }

        return response()->json(['cidades' => $cidades]);
    }

    public function inserir(CidadeCreateRequest $request)
    {
        $cidade = Cidade::create($request->all());
        $cidade->estadoNome = Estado::find($cidade->estadoId)->nome;

        return response()->json([
            'success'   => true,
            'message'   => 'Cidade inserida com sucesso.',
            'cidade'    => $cidade->getAttributes()
        ]);
    }

    public function detalhar($id)
    {
        $cidade = Cidade::find($id);
        $cidade->estadoNome = Estado::find($cidade->estadoId)->nome;

        return response()->json(['cidade' => $cidade]);
    }

    public function alterar(CidadeUpdateRequest $request)
    {
        $cidade = Cidade::find($request->id);
        $cidade->nome       = $request->get('nome');
        $cidade->estadoId   = $request->get('estadoId');
        $cidade->save();
        $cidade->estadoNome = Estado::find($cidade->estadoId)->nome;

        return response()->json([
            'success'   => true,
            'message'   => 'Cidade  ' . $cidade->nome . '  alterada com sucesso.',
            'cidade'    => $cidade->getAttributes()
        ]);
    }

    public function filtrar($filter){
        $cidades = Cidade::where('nome', 'like', '%' . $filter . '%')->get();
        
        foreach ($cidades as $cidade) {
            $cidade->estadoNome = Estado::find($cidade->estadoId)->nome;
        }

        return response()->json(['cidades' => $cidades]);
    }

    public function excluir($id)
    {
        $cidade = Cidade::find(intval($id));
        $exclusao_confirmacao = $cidade->delete();

        if ($exclusao_confirmacao) {
            return response()->json([
                'success'   => true,
                'message'   => 'A cidade ' . $cidade->nome . ' foi excluída com sucesso.'
            ]);
        } else {
            return response()->json([
                'success'   => false,
                'message'   => 'A cidade ' . $cidade->nome . ' não pode ser excluída.'
            ]);
        }
    }
}
