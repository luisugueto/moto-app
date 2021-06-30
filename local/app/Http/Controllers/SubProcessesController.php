<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Processes;
use App\SubProcesses;
use App\Email;
use App\Business;
use Redirect;
use App\Http\Requests;

class SubProcessesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view = getPermission('SubProcesos', 'record-view');

        if(!$view) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

            $haspermision = getPermission('SubProcesos', 'record-create');
            $processes = Processes::select(['id','name','description','status'])->get();
            $business = Business::select(['id','name','email'])->where('service_id', 1)->get();
            $emails = Email::all();

            return view('backend.subprocesses.index', compact('haspermision', 'processes', 'emails', 'business'));
    }

    public function getSubProcesses()
    {
        $subprocesses = SubProcesses::select(['id','name','description','processes_id','email_id','status'])->get();

        $view = getPermission('SubProcesos', 'record-view');
        $edit = getPermission('SubProcesos', 'record-edit');
        $delete = getPermission('SubProcesos', 'record-delete');

        $data = array(); 
        foreach($subprocesses as $key => $value){  

            $row = array();      
            $row['id'] = $value->id;
            $row['name'] = $value->name;
            $row['description'] = $value->description;
            $row['status'] = $value->status;

            $processes = Processes::find($value->processes_id);
            $row['processes'] = $processes->name;

            $email = Email::find($value->email_id);
            $row['email'] = $email->name;

            $row['view'] = $view;
            $row['edit'] = $edit;
            $row['delete'] = $delete;
            $data[] = $row;
        }

        $json_data = array('data'=> $data); 
        $json_data= collect($json_data);        
        return response()->json($json_data);
    }

    public function getSubProcessesAjax($id)
    {
        $subprocesses = SubProcesses::where('processes_id', $id)->get();
 
        $view = getPermission('SubProcesos', 'record-view');
        $edit = getPermission('SubProcesos', 'record-edit');
        $delete = getPermission('SubProcesos', 'record-delete');

        $data = array(); 
        foreach($subprocesses as $key => $value){  
            
            $row = array();      
            $row['id'] = $value->id;
            $row['name'] = $value->name;
            $row['description'] = $value->description;
            $row['status'] = $value->status;

            $processes = Processes::find($value->processes_id);
            $row['processes'] = $processes['name'];
            
            $row['view'] = $view;
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
        $validator = \Validator::make($request->all(), ['name' => 'required', 'description' => 'required', 'processes_id' => 'required', 'email_id' => 'required']);

        if ($validator->fails()) {
            $out['code'] = 422;
            $out['message'] = 'Campos requeridos';
            $out['response'] = $validator->errors();
      
        } else {
            $subprocess = SubProcesses::create($request->all());
            $out['code'] = 200;
            $out['message'] = 'Datos registrados exitosamente.';
            $out['response'] = $subprocess;
      
            
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
        $subprocess = SubProcesses::find($id);
        return response()->json($subprocess);
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
        if($request->business_id != ''){
            $business = $request->business_id;
        }
        $business = '';

        $subprocess = SubProcesses::find($id);
        $subprocess->name = $request->name;
        $subprocess->description = $request->description;
        $subprocess->status = $request->status;
        $subprocess->processes_id = $request->processes_id;
        $subprocess->email_id = $request->email_id;
        $subprocess->business_id = $business;
        $subprocess->update();
 
        $out['code'] = 200;
        $out['message'] = 'Registro actualizado exitosamente.';
        $out['response'] = $subprocess;    
       
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

        $subprocess = Business::findOrFail($id);
        if(isset($subprocess)){
            SubProcesses::destroy($id);
            $out['code'] = 200;
            $out['message'] = 'Registro eliminado exitosamente';
        }
        else{
            $out['code'] = 422;
            $out['message'] = 'Subproceso no encontrada! No se pudo eliminar.';
        }

        return response()->json($out);
    }

    public function getMailBusiness(Request $request)
    {
        $business = Business::find($request->id);
        $email = Email::select(['id', 'name'])->where('id', $business->email_id)->first();       
        
        if( $request->ajax() ) {
            return response()->json([
                'email' => $email
            ]);
        }
    }
}
