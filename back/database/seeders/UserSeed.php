<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y/m/d H:i:s');

        $user1 = new User;
        $user1->email = 'recrutador@teste.com';
        $user1->password = Hash::make('1234');
        $user1->save();

        $user2 = new User;
        $user2->email = 'profissional@teste.com';
        $user2->password = Hash::make('1234');
        $user2->save();

        $user1->roles()->attach(1);
        $user2->roles()->attach(2);
    }
}
