<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Admin;


class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Master
        Admin::create([
            'name' => 'Joel Torres',
            'username' => 'administrador',
            'password' => bcrypt('administrador'),
            'description' => 'Persona con total control del sistema',
            'remember_token' => Str::random(10)
        ]);

        Admin::create([
            'name' => 'Luis Sanchéz',
            'username' => 'administrador2',
            'password' => bcrypt('administrador'),
            'description' => 'Persona con total control del sistema',
            'remember_token' => Str::random(10)
        ]);        
        Admin::create([
            'name' => 'Jose Alonzo',
            'username' => 'administrador3',
            'password' => bcrypt('administrador'),
            'description' => 'Persona con total control del sistema',
            'remember_token' => Str::random(10)
        ]);        

        //Prueba
        factory(Admin::class,15)->create();
    }
}
