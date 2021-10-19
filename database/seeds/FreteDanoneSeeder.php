<?php

use App\FreteDanone;
use Illuminate\Database\Seeder;

class FreteDanoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            FreteDanone::create([
                'fator' => 0.2268
            ]);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
