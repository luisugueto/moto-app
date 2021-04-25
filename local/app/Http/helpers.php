<?php

use App\Menu;
use App\PermissionsMenu;

 	function getPermission($menu, $permission){

        switch ($permission) { // TIPO DE PERMISOS
            case 'record-view': $id_permission = 1; break;
            case 'record-create': $id_permission = 2; break;
            case 'record-edit': $id_permission = 3; break;
            case 'record-delete': $id_permission = 4; break;            
            case 'record-list': $id_permission = 5; break;
            default: $id_permission = 0; break;
        }

        $menu = Menu::where('name', $menu)->first(); // SE BUSCA EL MENU
        $role = DB::select('SELECT * FROM role_user WHERE user_id = '.Auth::user()->id); // SE BUSCA EL TIPO DE ROL DEL USUARIO
        
        $permissionsMenu = PermissionsMenu::where('menus_id', $menu->id)->where('roles_id', $role[0]->role_id)->first(); // SE BUSCAN LOS PERMISOS DEL MENU
   
        $explod_permissions = explode(",", $permissionsMenu->permissions);

        return in_array($id_permission, $explod_permissions); // SE VERIFICA SI EL PERMISO EXISTE EN ESE MENU
    }