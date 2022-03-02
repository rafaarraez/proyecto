<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $user               = new User();
        $user->name         = 'Usuario Administrador';
        $user->email        = 'admin@user.com';
        $user->password     = bcrypt('12345678');
        $user->cedula       = 0;
        $user->phone        = 0;
        $user->address      = "Universidad Jose Antonio Paez, Faculta de Ingenieria";
        $user->photo        = "cool_photo,jpg";
        $user->is_admin     = true;
        $user->is_active    = true;
        $user->save();
    }
}
