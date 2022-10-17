<?php

namespace Database\Seeders;

use App\Models\Cidade;
use Illuminate\Database\Seeder;

class CidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cidades = [
            ['nome' =>"Rio Branco", 'estadoId' =>1],
            ['nome' =>"Cruzeiro do Sul", 'estadoId' =>1],
            ['nome' =>"Arapiraca", 'estadoId' =>2],
            ['nome' =>"Maceió", 'estadoId' =>2],
            ['nome' =>"Macapá", 'estadoId' =>3],
            ['nome' =>"Santana", 'estadoId' =>3],
            ['nome' =>"Fortaleza", 'estadoId' =>6],
            ['nome' =>"Sobral", 'estadoId' =>6],
            ['nome' =>"Brasília", 'estadoId' =>7],
            ['nome' =>"Gama", 'estadoId' =>7],
            ['nome' =>"Vitória", 'estadoId' =>8],
            ['nome' =>"Cariacica", 'estadoId' =>8],
            ['nome' =>"Goiânia", 'estadoId' =>9],
            ['nome' =>"Anápolis", 'estadoId' =>9],
            ['nome' =>"São Luís", 'estadoId' =>10],
            ['nome' =>"Imperatriz", 'estadoId' =>10],
            ['nome' =>"Cuiabá", 'estadoId' =>11],
            ['nome' =>"Várzea Grande", 'estadoId' =>11],
            ['nome' =>"Campo Grande", 'estadoId' =>12],
            ['nome' =>"Dourados", 'estadoId' =>12],
            ['nome' =>"Belo Horizonte", 'estadoId' =>13],
            ['nome' =>"Contagem", 'estadoId' =>13],
            ['nome' =>"Recife", 'estadoId' =>14],
            ['nome' =>"Olinda", 'estadoId' =>14],
            ['nome' =>"Teresina", 'estadoId' =>15],
            ['nome' =>"Parnaíba", 'estadoId' =>15],
        ];

        foreach ($cidades as $cidade) {
            Cidade::create($cidade);
        }
    }
}
