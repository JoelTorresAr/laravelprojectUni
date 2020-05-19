<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CitiesTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
        $this->call(WorkstationsTableSeeder::class);
        $this->call(WorkpositionsTableSeeder::class);
        $this->call(SubsidiariesTableSeeder::class);
        $this->call(StaffTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(Permission_RoleTableSeeder::class);
        $this->call(Admin_RoleTableSeeder::class);
    }
}
