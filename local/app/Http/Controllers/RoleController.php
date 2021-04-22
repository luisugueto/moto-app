<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Role;
use App\Permission;
use DB;
use Redirect;


class RoleController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $permission = Permission::get();
        $haspermision = getPermission('Perfiles', 'record-create');
        return view('backend.roles.index',compact('permission', 'haspermision'));
    }


    public function getRoles()
    {   
        $roles = DB::table('roles')
            ->select('roles.*')
            ->groupBy('roles.id')
            ->get();            
       
            $view = getPermission('Perfiles', 'record-view');
            $edit = getPermission('Perfiles', 'record-edit');
            $delete = getPermission('Perfiles', 'record-delete');   
            
        $data = array();
        foreach($roles as $key => $value){  

            $row = array();  
                    
            $row['id'] = $value->id;
            $row['name'] = $value->name;
            $row['description'] = $value->description;
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
        
        $validator = \Validator::make($request->all(), ['name' => 'required|unique:roles,name', 'display_name' => 'required', 'description' => 'required']);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $role = new Role();
            $role->name = $request->input('name');
            $role->display_name = $request->input('display_name');
            $role->description = $request->input('description');
            $role->save();

            return response()->json($role);
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
        $role = Role::find($id);

        // $rolePermissions = Permission::join("permission_role","permission_role.permission_id","=","permissions.id")
        //     ->where("permission_role.role_id",$id)
        //     ->get();
        
        $data = [];
        $data['id'] = $role->id;
        $data['name'] = $role->name;
        $data['display_name'] = $role->display_name;
        $data['description'] = $role->description;

        // $id_roles = '';
        // foreach($rolePermissions as $value){
        //     $id_roles .= $value->id .',';
        // }
        // $data['permisions'] = $id_roles;
        
        return response()->json(collect($data));

        // return view('backend.roles.show',compact('role','rolePermissions'));
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

        $validator = \Validator::make($request->all(), ['display_name' => 'required', 'description' => 'required']);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $role = Role::find($id);
            $role->display_name = $request->input('display_name');
            $role->description = $request->input('description');
            $role->save();


            // DB::table("permission_role")->where("permission_role.role_id",$id)
            // ->delete();

            // foreach ($request->input('permission') as $key => $value) {
            //     $role->attachPermission($value);
            // }

            return response()->json($role);
            // return Redirect::to('/roles')->with('notification', 'Rol creado exitosamente!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $role = DB::table("roles")->where('id',$id)->delete();
        return response()->json($role);
        // return Redirect::to('/roles')->with('notification', 'Rol eliminado exitosamente!');
    }

}
