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
        $view = getPermission('Permisos', 'record-view');

        if(!$view) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $permission = Permission::get()->take(4);    
        $menus = DB::table('menus')->get();
        $roles = Role::get();
        $permissionsMenu = PermissionsMenu::all();
    
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
        $edit = getPermission('Permisos', 'record-edit');
        $create = getPermission('Permisos', 'record-create');

        if(!$edit || !$create) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $roles = Role::all();
        $menus = Menu::all();

        DB::table('permissions_menus')->update(array('permissions' => ''));

        foreach($roles as $key => $rol){
            foreach($menus as $key => $me){
                
                if(isset($request['permissionRol'.$rol->id.'_'.$me->id])){
                    $menu = PermissionsMenu::where('roles_id', $rol->id)->where('menus_id', $me->id)->first();
                    $menuPermission = '';
                    
                    foreach($request['permissionRol'.$rol->id.'_'.$me->id] as $key => $value){
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
