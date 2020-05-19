<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Permission_RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name','SuperAdmin')->first();
        $permisos = Permission::all();

        $role->syncPermissions($permisos);
    }
}
