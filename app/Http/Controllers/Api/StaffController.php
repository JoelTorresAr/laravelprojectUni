<?php


namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\StaffStoreRequest;
use App\Http\Requests\StaffUpdateRequest;
use App\models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  DB::table('staff')
        ->join('subsidiaries','staff.subsidiary_id','=','subsidiaries.id')
        ->join('workpositions','staff.workposition_id','=','workpositions.id')
        ->join('workstations','workpositions.workstation_id','=','workstations.id')
        ->join('districts','staff.district_id','=','districts.id')
        ->join('cities','districts.city_id','=','cities.id')
        ->select('staff.*','subsidiaries.name as subsidiary',
                 'workpositions.name as workposition','workstations.id as workstation_id',
                 'workstations.name as workstation','districts.name as district',
                 'cities.id as city_id','cities.name as city')
        ->orderBy('subsidiary')
        ->orderBy('workposition')->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nonCredentialStaff()
    {
        return  DB::table('admins')
        ->rightJoin('staff','admins.staff_id','=','staff.id')
        ->select('staff.id','staff.firstname','staff.firstlastname',
                 'staff.secondlastname')
        ->whereNull('admins.staff_id')
        ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffStoreRequest $request)
    {
        Staff::create($request->all());
        
        return ['status' => '200','message' => 'Creado con exito'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StaffUpdateRequest $request, $id)
    {
        $staff = Staff::find($id);
        $staff->fill($request->all())->save();

        return ['status' => '200','message' => 'Actualizado con exito'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Staff::findOrFail($id)->delete();
        return ['status' => '200', 'message' => 'Eliminado con exito'];
    }
}
