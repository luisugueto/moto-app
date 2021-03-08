<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\UserTypes;
use Redirect;
use App\Http\Requests;

class UserTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_types = UserTypes::all();
        return view('backend.user_types.index', compact('user_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.user_types.create');
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
        $user_types = new UserTypes($request->all());
        $user_types->save();

        return Redirect::to('/user_types')->with('notification', 'Rol creado exitosamente!');
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
        $user_type = UserTypes::find($id);

        return view('backend.user_types.edit', compact('user_type'));
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
      
        $user_types = UserTypes::find($id);
        $user_types->name = $request->name;
        $user_types->description = $request->description;
        $user_types->save();

        return Redirect::to('/user_types')->with('notification', 'Rol modificado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserTypes::destroy($id);

        return Redirect::to('/user_types')->with('notification', 'Registro eliminado exitosamente!');
    }
}
