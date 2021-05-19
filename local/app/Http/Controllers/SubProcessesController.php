<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Processes;
use App\SubProcesses;
use App\Email;
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
        $haspermision = getPermission('SubProcesos', 'record-create');
        $processes = Processes::select(['id','name','description','status'])->get();
        $emails = Email::all();

        return view('backend.subprocesses.index', compact('haspermision', 'processes', 'emails'));
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
            return response()->json($validator->errors(), 422);
        } else {
            $subprocess = SubProcesses::create($request->all());
             
            return response()->json($subprocess);
        }
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
        $subprocess = SubProcesses::find($id);
        $subprocess->name = $request->name;
        $subprocess->description = $request->description;
        $subprocess->status = $request->status;
        $subprocess->processes_id = $request->processes_id;
        $subprocess->email_id = $request->email_id;
        $subprocess->update();

        return response()->json($subprocess);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subprocess = SubProcesses::destroy($id);
        return response()->json($subprocess);
    }
}
