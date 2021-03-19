<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Processes;
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
        $processes = Processes::all();
        
        return view('backend.processes.index')->with('processes', $processes);
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
