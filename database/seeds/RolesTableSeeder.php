<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //Admins
        Role::create([
            'name'       => 'SuperAdmin',
            'guard_name' => 'admin'
        ]);

        //
        Role::create([
            'name'       => 'Admin',
            'guard_name' => 'admin'
        ]);
    }
}
