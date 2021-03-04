<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\UserTypes;
use App\Http\Requests;
use Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();      
        return view('backend.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_types = UserTypes::all();

        return view('backend.users.create', compact('user_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
        User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->email,
            'password' => bcrypt($request->password),
            'user_type_id' => $request->user_type_id
        ]);

        return Redirect::to('/users')->with('notification', 'Usuario creado exitosamente!');
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
        $user = User::find($id);
        $user_types = UserTypes::all();

        return view('backend.users.edit', compact('user', 'user_types'));
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
        $user = User::find($id);

        $user->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->email,
            'password' => bcrypt($request->password),
            'user_type_id' => $request->user_type_id
        ]);

        return Redirect::to('/users')->with('notification', 'Usuario modificado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        User::destroy($id);         
        return Redirect::to('/users')->with('notification', 'Registro eliminado exitosamente!');
    }
}
