<?php

use App\Models\Industria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class XMLIndustriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes = [
            1 => 'XMLTourinhoService',
            2 => 'XMLCatupiryService',
            3 => 'XMLDanoneService',
        ];

        DB::beginTransaction();
        try {
            foreach ($classes as $id => $classe) {
                $industria = Industria::find($id);
                if (is_null($industria)) {
                    continue;
                }
                $industria->update([
                    'classe' => $classe
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
            dd($th->getMessage());
        }

    }
}
