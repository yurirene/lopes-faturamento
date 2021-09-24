<?php

use App\Models\Frete;
use Illuminate\Database\Seeder;

class FreteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fretes = [
            [
                'nome' => 'Manaus',
                'fator' => '0.4',
                'codigo' => '1302603'
            ],
            [
                'nome' => 'Boa Vista',
                'fator' => '1.3',
                'codigo' => '1400100'
            ],
            [
                'nome' => 'Humaitá',
                'fator' => '0.4',
                'codigo' => '1301704'
            ],
            [
                'nome' => 'Itacoatiara',
                'fator' => '0.75',
                'codigo' => '1301902'
            ]
        ];

        foreach ($fretes as $frete) {
            Frete::create($frete);
        }
        return true;
    }
}
