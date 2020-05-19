<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class Admin_RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //SuperAdmin
       $admin = Admin::where('username','administrador')->first();
       $admin->assignRole(Role::where('name','SuperAdmin')->first());

       //admin
       $role = Role::where('name','Admin')->first();
       
       $admin = Admin::where('username','administrador2')->first();
       $admin->assignRole($role);
       
       $admin = Admin::where('username','administrador3')->first();
       $admin->assignRole($role);
    }
}
