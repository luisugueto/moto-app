<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\States;
use Redirect;
use App\Http\Requests;

class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = States::all();
        return view('backend.states.index', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.states.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
        $state = new States($request->all());
        $state->save();

        return Redirect::to('/states')->with('notification', 'Estado creado exitosamente!');
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
        $state = States::find($id);

        return view('backend.states.edit', compact('state'));
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
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
      
        $state = States::find($id);
        $state->name = $request->name;
        $state->description = $request->description;
        $state->save();

         return Redirect::to('/states')->with('notification', 'Estado modificado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        States::destroy($id);

        return Redirect::to('/states')->with('notification', 'Registro eliminado exitosamente!');
    }

    public function changeStatus($id)
    {
        $state = States::findOrFail($id);
        $status = 0;
        if ($state->status == 0) {
            $status = 1;
        }
        if ($state->status == 1) {
            $status = 0;
        }

        $state->status = $status;
        $state->save();

        return Redirect::to('/states')->with('notification', 'Se ha actualizado el estado del registro!');
    }
}
