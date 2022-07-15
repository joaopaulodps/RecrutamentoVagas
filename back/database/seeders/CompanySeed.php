<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = new Company;
        $company->user_id = 1;
        $company->nome = "João";
        $company->empresa = "Empresa X";
        $company->save();
    }
}
