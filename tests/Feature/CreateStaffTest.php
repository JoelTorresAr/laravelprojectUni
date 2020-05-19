<?php

namespace Tests\Feature;

use App\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateStaffTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function admin_can_create_staff()
    {
        //1 Given => Teniendo un usuario autenticado
        $admin = factory(Admin::class)->create();
        $this->actingAs($admin);

        //2. When => Cuando hace un post request a staff
        $this->post(route('staff.'));

    }
}
