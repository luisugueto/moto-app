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

    function create_token() 
    { 
        $token = md5(uniqid(microtime(), true));
        return $token;
    }
 
    function validDniCifNie($dni) {
        $cif = strtoupper($dni);
        for ($i = 0; $i < 9; $i++) {
            $num[$i] = substr($cif, $i, 1);
        }
        // Si no tiene un formato valido devuelve error
        if (!preg_match('/((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)/', $cif)) {
            return false;
        }
        // Comprobacion de NIFs estandar
        if (preg_match('/(^[0-9]{8}[A-Z]{1}$)/', $cif)) {
            if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($cif, 0, 8) % 23, 1)) {
                return true;
            } else {
                return false;
            }
        }
        // Algoritmo para comprobacion de codigos tipo CIF
        $suma = $num[2] + $num[4] + $num[6];
        for ($i = 1; $i < 8; $i += 2) {
            $suma += (int)substr((2 * $num[$i]), 0, 1) + (int)substr((2 * $num[$i]), 1, 1);
        }
        $n = 10 - substr($suma, strlen($suma) - 1, 1);
        // Comprobacion de NIFs especiales (se calculan como CIFs o como NIFs)
        if (preg_match('/^[KLM]{1}/', $cif)) {
            if ($num[8] == chr(64 + $n) || $num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($cif, 1, 8) % 23, 1)) {
                return true;
            } else {
                return false;
            }
        }
        // Comprobacion de CIFs
        if (preg_match('/^[ABCDEFGHJNPQRSUVW]{1}/', $cif)) {
            if ($num[8] == chr(64 + $n) || $num[8] == substr($n, strlen($n) - 1, 1)) {
                return true;
            } else {
                return false;
            }
        }
        // Comprobacion de NIEs
        // T
        if (preg_match('/^[T]{1}/', $cif)) {
            if ($num[8] == preg_match('/^[T]{1}[A-Z0-9]{8}$/', $cif)) {
                return true;
            } else {
                return false;
            }
        }
        // XYZ
        if (preg_match('/^[XYZ]{1}/', $cif)) {
            if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr(str_replace(array('X', 'Y', 'Z'), array('0', '1', '2'), $cif), 0, 8) % 23, 1)) {
                return true;
            } else {
                return false;
            }
        }
        // Si todavía no se ha verificado devuelve error
        return false;
    }