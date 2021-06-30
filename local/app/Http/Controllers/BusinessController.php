<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Business;
use App\Service; 
use App\Email;
use DB;
use Redirect;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view = getPermission('Empresas', 'record-view');

        if(!$view) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $haspermision = getPermission('Empresas', 'record-create');
        $services = Service::all();
        $emails = Email::where('type', 2)->get();
        return view('backend.business.index', compact('haspermision', 'services', 'emails'));
    }

    public function getBusiness()
    {
       
        $business = DB::table('business')
        ->join('services', 'services.id', '=', 'business.service_id')
        ->leftjoin('emails', 'emails.id', '=', 'business.email_id')
        ->select('business.*', 'services.name AS servicio', 'emails.name AS plantilla')
        ->where('services.status', '=', 1)    
        ->get();

 
        $view = getPermission('Empresas', 'record-view');
        $edit = getPermission('Empresas', 'record-edit');
        $delete = getPermission('Empresas', 'record-delete');

        $data = array(); 
        foreach($business as $key => $value){  

            $row = array();      
            $row['id'] = $value->id;
            $row['service_id'] = $value->servicio;
            $row['email_id'] = $value->plantilla;
            $row['name'] = $value->name;
            $row['cif'] = $value->cif;
            $row['email'] = $value->email;
            $row['city'] = $value->city;
            $row['province'] = $value->province;
            $row['edit'] = $edit;
            $row['delete'] = $delete;
            $data[] = $row;
        }
        
        $json_data = array('data'=> $data); 
        $json_data= collect($json_data);        
        return response()->json($json_data);
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
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = \Validator::make($request->all(), ['service_id' => 'required', 'name' => 'required|min:5', 'phone' => 'required', 'email' => 'required|email', 'city' => 'required|string', 'postal_code' => 'required', 'cif' => 'required']);

        if ($validator->fails()) {
            $out['code'] = 422;
            $out['message'] = 'Campos requeridos';
            $out['response'] = $validator->errors();
      
        } else {
            $bussiness = Business::create($request->all());
            $out['code'] = 200;
            $out['message'] = 'Datos registrados exitosamente.';
            $out['response'] = $bussiness;
      
            
        } 

        return response()->json($out);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bussiness = Business::find($id);
        return response()->json($bussiness);
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
    public function update(Request $request, $id)
    {
        $bussiness = Business::find($id);

        $validator = \Validator::make($request->all(), ['service_id' => 'required', 'name' => 'required|min:5', 'phone' => 'required', 'email' => 'required|email', 'city' => 'required|string', 'postal_code' => 'required', 'cif' => 'required']);

        if ($validator->fails()) {
            $out['code'] = 422;
            $out['message'] = 'Campos requeridos';
            $out['response'] = $validator->errors();
      
        } else {
            $bussiness->update($request->all());
            $out['code'] = 200;
            $out['message'] = 'Registro actualizado exitosamente.';
            $out['response'] = $bussiness;
      
            
        } 
        return response()->json($out);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bussiness = Business::findOrFail($id);
        if(isset($bussiness)){
            Business::destroy($id);
            $out['code'] = 200;
            $out['message'] = 'Registro eliminado exitosamente';
        }
        else{
            $out['code'] = 422;
            $out['message'] = 'Empresa no encontrada! No se pudo eliminar.';
        }
        return response()->json($out);
    }
}
