<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Seeder;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados = [
            ['nome' => 'Acre', 'abreviacao' => 'AC'],
            ['nome' => 'Alagoas', 'abreviacao' => 'AL'],
            ['nome' => 'Amapá', 'abreviacao' => 'AP'],
            ['nome' => 'Amazonas', 'abreviacao' => 'AM'],
            ['nome' => 'Bahia', 'abreviacao' => 'BA'],
            ['nome' => 'Ceará', 'abreviacao' => 'CE'],
            ['nome' => 'Distrito Federal', 'abreviacao' => 'DF'],
            ['nome' => 'Espírito Santo', 'abreviacao' => 'ES'],
            ['nome' => 'Goiás', 'abreviacao' => 'GO'],
            ['nome' => 'Maranhão', 'abreviacao' => 'MA'],
            ['nome' => 'Mato Grosso', 'abreviacao' => 'MT'],
            ['nome' => 'Mato Grosso do Sul', 'abreviacao' => 'MS'],
            ['nome' => 'Minas Gerais', 'abreviacao' => 'MG'],
            ['nome' => 'Pernambuco', 'abreviacao' => 'PE'],
            ['nome' => 'Piauí', 'abreviacao' => 'PI'],
        ];

        foreach ($estados as $estado) {
            Estado::create($estado);
        }
    }
}
