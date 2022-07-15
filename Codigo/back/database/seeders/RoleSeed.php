<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Role;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = new Role;
        $role1->nome = 'recrutador';
        $role1->descricao = 'Recrutador';
        $role1->save();

        $role2 = new Role;
        $role2->nome = 'profissional';
        $role2->descricao = 'Profissional';
        $role2->save();

    }
}
