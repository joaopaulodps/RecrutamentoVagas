<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Professional;

class ProfessionalSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professional = new Professional;
        $professional->user_id = 2;
        $professional->nome = "João Paulo";
        $professional->profissao = 'Dev';
        $professional->experiencia = '1';
        $professional->localizacao = 'a';
        $professional->endereco = 'Rua';
        $professional->save();
    }
}
