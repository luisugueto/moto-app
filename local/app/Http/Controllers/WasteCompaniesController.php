<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\WasteCompanies;
use App\Waste;
use App\Email;
use App\Materials;
use DB;
use Redirect;

class WasteCompaniesController extends Controller
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
        $emails = Email::where('type', 2)->get();
        $materials = Materials::get();
        return view('backend.waste_companies.index', compact('haspermision', 'emails', 'materials'));
    }

    public function getWasteCompanies()
    {
       
        $business = DB::table('waste_companies')
        ->leftjoin('emails', 'emails.id', '=', 'waste_companies.email_id')
        ->select('waste_companies.*', 'emails.name AS plantilla')  
        ->get();

 
        $view = getPermission('Empresas', 'record-view');
        $edit = getPermission('Empresas', 'record-edit');
        $delete = getPermission('Empresas', 'record-delete');

        $data = array(); 
        foreach($business as $key => $value){  

            $row = array();      
            $row['id'] = $value->id;
            $row['name'] = $value->name;
            $row['nif_inst_destination'] = $value->nif_inst_destination;
            $row['email_id'] = $value->plantilla;           
            $row['reason_social_inst_destination'] = $value->reason_social_inst_destination;
            $row['nima_inst_destination'] = $value->nima_inst_destination;
            $row['location'] = $value->location;
            $row['province'] = $value->province;
            $row['authorization_no'] = $value->authorization_no;
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
        $validator = \Validator::make($request->all(), ['name' => 'required|min:5', 'nif_inst_destination' => 'required', 'reason_social_inst_destination' => 'required', 'nima_inst_destination' => 'required', 'postal_code' => 'required', 'location' => 'required', 'province' => 'required', 'country' => 'required', 'authorization_no' => 'required']);

        if ($validator->fails()) {
            $out['code'] = 422;
            $out['message'] = 'Campos requeridos';
            $out['response'] = $validator->errors();
      
        } else {
            $bussiness = WasteCompanies::create($request->all());
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
        $waste = WasteCompanies::find($id);
        return response()->json($waste);
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
        $waste = WasteCompanies::find($id);

        $validator = \Validator::make($request->all(), ['name' => 'required|min:5', 'nif_inst_destination' => 'required', 'reason_social_inst_destination' => 'required', 'nima_inst_destination' => 'required', 'postal_code' => 'required', 'location' => 'required', 'province' => 'required', 'country' => 'required', 'authorization_no' => 'required']);

        if ($validator->fails()) {
            $out['code'] = 422;
            $out['message'] = 'Campos requeridos';
            $out['response'] = $validator->errors();
      
        } else {
            $waste->update($request->all());
            $out['code'] = 200;
            $out['message'] = 'Registro actualizado exitosamente.';
            $out['response'] = $waste;
      
            
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
        $waste = WasteCompanies::findOrFail($id);
        if(isset($waste)){
            WasteCompanies::destroy($id);
            $out['code'] = 200;
            $out['message'] = 'Registro eliminado exitosamente';
        }
        else{
            $out['code'] = 422;
            $out['message'] = 'Empresa no encontrada! No se pudo eliminar.';
        }
        return response()->json($out);
    }

    public function addMaterials($id)
    {
        $waste = WasteCompanies::findOrFail($id);
        return response()->json($waste);
    }
}
