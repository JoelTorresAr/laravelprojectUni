<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Admin::query()->delete();
        Permission::query()->delete();*/

        //maintenance:

        //Admin
        Permission::create([
            'name'       => 'admins.index',
            'guard_name' => 'admin',
            'description' => 'Lista y navega las credenciales',
        ]);
        Permission::create([
            'name'       => 'admins.create',
            'guard_name' => 'admin',
            'description' => 'Crea las credenciales'
        ]);
        Permission::create([
            'name'       => 'admins.edit',
            'guard_name' => 'admin',
            'description' => 'Edita los datos de las credenciales'
        ]);
        Permission::create([
            'name'       => 'admins.destroy',
            'guard_name' => 'admin',
            'description' => 'Elimina las credenciales'
        ]);
        //Districts
        Permission::create([
            'name'       => 'districts.index',
            'guard_name' => 'admin',
            'description'=> 'Lista y navega los distritos y ciudades'
        ]);
        Permission::create([
            'name'       => 'districts.create',
            'guard_name' => 'admin',
            'description'=> 'Crea distritos y ciudades'
        ]);
        Permission::create([
            'name'       => 'districts.edit',
            'guard_name' => 'admin',
            'description'=> 'Edita los distritos y ciudades'
        ]);
        Permission::create([
            'name'       => 'districts.destroy',
            'guard_name' => 'admin',
            'description'=> 'Elimina los distritos y ciudades'
        ]);
        //WorkStations
        Permission::create([
            'name'       => 'workstations.index',
            'guard_name' => 'admin',
            'description'=> 'Lista y navega las areas de trabajo'
        ]);
        Permission::create([
            'name'       => 'workstations.create',
            'guard_name' => 'admin',
            'description'=> 'Crea areas de trabajo'
        ]);
        Permission::create([
            'name'       => 'workstations.edit',
            'guard_name' => 'admin',
            'description'=> 'Editar las areas de trabajo'
        ]);
        Permission::create([
            'name'       => 'workstations.destroy',
            'guard_name' => 'admin',
            'description'=> 'Elimina las areas de trabajo'
        ]);
        //WorkPositions
        Permission::create([
            'name'       => 'workpositions.index',
            'guard_name' => 'admin',
            'description'=> 'Lista y navega los puestos de trabajo'
        ]);
        Permission::create([
            'name'       => 'workpositions.create',
            'guard_name' => 'admin',
            'description'=> 'Crea puestos de trabajo'
        ]);
        Permission::create([
            'name'       => 'workpositions.edit',
            'guard_name' => 'admin',
            'description'=> 'Edita los puestos de trabajo'
        ]);
        Permission::create([
            'name'       => 'workpositions.destroy',
            'guard_name' => 'admin',
            'description'=> 'Elimina un puesto de trabajo'
        ]);
        //Subsidiaries
        Permission::create([
            'name'       => 'subsidiaries.index',
            'guard_name' => 'admin',
            'description'=> 'Lista y navega las subisidiarias'
        ]);
        Permission::create([
            'name'       => 'subsidiaries.create',
            'guard_name' => 'admin',
            'description'=> 'Crea subsidiarias'
        ]);
        Permission::create([
            'name'       => 'subsidiaries.edit',
            'guard_name' => 'admin',
            'description'=> 'Edita las subisidiaries'
        ]);
        Permission::create([
            'name'       => 'subsidiaries.destroy',
            'guard_name' => 'admin',
            'description'=> 'Elimina una subisidiarie'
        ]);
        //Staff
        Permission::create([
            'name'       => 'staff.index',
            'guard_name' => 'admin',
            'description'=> 'Lista y navega el personal'
        ]);
        Permission::create([
            'name'       => 'staff.create',
            'guard_name' => 'admin',
            'description'=> 'Crea personal'
        ]);
        Permission::create([
            'name'       => 'staff.edit',
            'guard_name' => 'admin',
            'description'=> 'Edita el personal'
        ]);
        Permission::create([
            'name'       => 'staff.destroy',
            'guard_name' => 'admin',
            'description'=> 'Elimina un personal'
        ]);
    }
}
