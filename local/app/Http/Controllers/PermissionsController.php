<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Permission;
use App\Menu;
use App\Role;
use App\PermissionsMenu;
use DB;
use Redirect;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$haspermision = auth()->user()->can('record-create');   
        $permission = Permission::get()->take(4);    
        $menus = DB::table('menus')->get();
        $roles = Role::get();
        $permissionsMenu = PermissionsMenu::all();
        
        // $roles = DB::table('roles')
        // ->join('permission_role', 'permission_role.role_id', '=', 'roles.id')
        // ->join('permissions', 'permission_role.permission_id', '=', 'permissions.id')
        // ->select('roles.*', DB::raw('group_concat(permissions.display_name) as permisos'))
        // ->groupBy('roles.id')
        // ->get();
    
        return view('backend.permissions.index', compact('permission', 'permissionsMenu','menus','roles'));
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
        $roles = Role::count();
        $menus = DB::table('menus')->count();
       
        for($i = 1; $i <= $roles; $i++){ 
            for($j = 1; $j <= $menus; $j++){
                $menu = PermissionsMenu::where('roles_id', $i)->where('menus_id', $j)->first();
        
                $menuPermission = '';
                foreach($request['permissionRol'.$i.'_'.$j] as $key => $value){
                    if($key == 0)
                        $menuPermission.=$value;
                    else
                        $menuPermission.=','.$value;
                }
                $menu = PermissionsMenu::find($menu->id);

                $menu->permissions = $menuPermission;
                $menu->update();
            }
        }
            
        return Redirect::to('/permisos')->with('notification', 'Permisos actualizados exitosamente!');

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
