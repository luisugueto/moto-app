<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Processes;
use App\States;
use Redirect;
use App\Http\Requests;


class ProcessesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view = getPermission('Procesos', 'record-view');

        if(!$view) return Redirect::to('/')->with('error', 'Usted no posee permisos!');
        
        $haspermision = getPermission('Procesos', 'record-create');
        $states = States::get();
        return view('backend.processes.index', compact('haspermision', 'states'));
    }

    public function getProcesses()
    {
        $procceses = Processes::select(['id','name','description','status', 'destiny'])->get();
 
        $view = getPermission('Procesos', 'record-view');
        $edit = getPermission('Procesos', 'record-edit');
        $delete = getPermission('Procesos', 'record-delete');

        $data = array(); 
        foreach($procceses as $key => $value){  
            
            $row = array();      
            $row['id'] = $value->id;
            $row['name'] = $value->name;
            $row['description'] = $value->description;
            $row['destiny'] = $value->destiny;
            $row['status'] = $value->status;
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
        $validator = \Validator::make($request->all(), ['name' => 'required', 'description' => 'required']);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $process = Processes::create($request->all());
             
            return response()->json($process);
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
        $process = Processes::find($id);
        return response()->json($process);
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
        $process = Processes::find($id);
        $process->name = $request->name;
        $process->description = $request->description;
        $process->destiny = $request->destiny;
        $process->status = $request->status;
        $process->save();
        return response()->json($process);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $process = Processes::destroy($id);
        return response()->json($process);
    }
}
