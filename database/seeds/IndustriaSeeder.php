<?php

use App\Models\Industria;
use Illuminate\Database\Seeder;

class IndustriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $industrias = [
            [
                'cnpj' => '03375150000178',
                'razao_social' => 'CIA. MINEIRA DE LATICINIOS LTDA',
                'cidade' => 'Tupaciguara',
            ],

            [
                'cnpj' => '61087367000693',
                'razao_social' => 'LATICINIOS CATUPIRY LTDA',
                'cidade' => 'STA. FE DO SUL',
            ],

            [
                'cnpj' => '23643315003097',
                'razao_social' => 'DANONE LTDA',
                'cidade' => 'Poços de Caldas',
            ]

        ];

        foreach ($industrias as $industria) {
            Industria::create($industria);
        }
        return true;
    }
}
