<?php

namespace App\Http\Controllers\Api;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAssignRequest;
use App\Http\Requests\AdminStoreRequest;
use App\Http\Requests\AdminUpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function list()
    {
        /*return  DB::table('admins')
                ->leftJoin('staff','admins.staff_id','=','staff.id')
                ->select('admins.id','admins.staff_id','admins.name',
                         'admins.username','admins.description','admins.created_at',
                         'admins.updated_at','staff.firstname','staff.firstlastname',
                         'staff.secondlastname')
                ->get();*/
        $admins = Admin::with([
            'staff' => function ($query2) {
                $query2->select('id', 'firstname', 'firstlastname', 'secondlastname');
            },
            'roles' => function ($query) {
                $query->select('name');
            },
        ])->get();
        return $admins;
    }
    public function store(AdminStoreRequest $request)
    {
        $admin = Admin::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'password' => Hash::make($request['password']),
            'description' => $request['description'],
        ]);
        if ($request['roles'] !== null) {
            $admin->assignRole($request['roles']);
        }


        return ['status' => '200', 'message' => 'Creado con exito'];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUpdateRequest $request, $id)
    {
        $admin = Admin::find($id);
        if ($request['password'] !== null) {
            $admin->fill([
                'name' => $request['name'],
                'username' => $request['username'],
                'password' => Hash::make($request['password']),
                'description' => $request['description'],
            ])->save();
        } else {
            $admin->fill([
                'name' => $request['name'],
                'username' => $request['username'],
                'description' => $request['description'],
            ])->save();
        }

        $admin->syncRoles($request['roles']);

        return ['status' => '200', 'message' => 'Editado con exito'];
    }
    /**
     * Assign credential to specific staff.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function assign(AdminAssignRequest $request, $id)
    {
        $admin = Admin::find($id);
        $admin->fill([
            'staff_id' => $request['staff_id'],
        ])->save();

        return ['status' => '200', 'message' => 'Asignado con exito'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::findOrFail($id)->delete();
        return ['status' => '200', 'message' => 'Eliminado con exito'];
    }
}
