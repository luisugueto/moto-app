<?php

use App\Menu;
use App\PermissionsMenu;

require_once dirname(__FILE__). '/oauth-php/OAuthRequestSigner.php';

define("DOCUMENTS_API_URL", "https://services.viafirma.com/documents/api/v3");
define("DOCUMENTS_CONSUMER_KEY", "motostion");
define("DOCUMENTS_CONSUMER_SECRET", "xIHcdj");

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


    function system_alive ()
    {
        error_reporting(E_ALL);

        header('Content-Type: text/plain; charset=utf-8');

        $url=DOCUMENTS_API_URL."/system/alive";

        //  Initiate curl
        $ch = curl_init();

        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Set the url
        curl_setopt($ch, CURLOPT_URL,$url);

        // Execute
        $result=curl_exec($ch);
        return prettyPrint($result);

        // Closing
        curl_close($ch);
    }

    function send_document ($purchase, $url_pdf)
    {   
        error_reporting(E_ALL);

        $url=DOCUMENTS_API_URL."/messages/dispatch";

        OAuthStore::instance('MySQL', array('conn'=>false));
        $req = new OAuthRequestSigner($url, 'POST');
        $fecha = new DateTime();
        $secrets = array(
                    'consumer_key'      => DOCUMENTS_CONSUMER_KEY,
                    'consumer_secret'   => DOCUMENTS_CONSUMER_SECRET,
                    'token'             => '',
                    'token_secret'      => '',
                    'signature_methods' => array('HMAC-SHA1'),
                    'nonce'             => '3jd834jd9',
                    'timestamp'         => $fecha->getTimestamp(),
                    );
        $req->sign(0, $secrets); 

        $email = $purchase->email;

        // POST
        $string_json = '{
                          "groupCode": "motostion",
                          "workflow": {
                            "type": "PRESENTIAL"
                          },
                          "notification": {
                            "text": "Documento Generado App",
                            "detail": "Documento a firmar.",
                            "sharedLink" : {
                                "email" : "'.$email.'",
                                "subject" : "ViaFirma PHP"
                            },
                            "retryTime" : 7
                          },
                          "document": {
                            "templateType" : "url",
                            "templateReference" : "'.$url_pdf.'",
                            "templateCode": "motostion_documents_generados",
                            "readRequired" : true,
                            "watermarkText" : "Previsualización",
                            "formRequired": true,
                            "items" : [ {
                              "key" : "customer_name",
                              "value" : "'.$purchase->name.'"
                            }, {
                              "key" : "otpmail_phoneNumber",
                              "value" : "+584121382321"
                            } ]
                          },
                          "callbackMails": "'.$email.'",
                          "callbackURL" : "https://www.viafirma.com/download/documents/callbackURL/callbackURL.php"
                        }'; 

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $string_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // OAuth Header
        $headr = array();
        $headr[] = 'Content-Length: ' . strlen($string_json);
        $headr[] = 'Content-type: application/json';
        $headr[] = ''.$req->getAuthorizationHeader();
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headr);
        

        $result = curl_exec($ch);
        $array = json_decode($result);
        $link=$array->notification->sharedLink->link; 

        // echo $statusCode;
        // Closing
        curl_close($ch); 
    }

    function prettyPrint( $json )
    {
        $result = '';
        $level = 0;
        $in_quotes = false;
        $in_escape = false;
        $ends_line_level = NULL;
        $json_length = strlen( $json );

        for( $i = 0; $i < $json_length; $i++ ) {
            $char = $json[$i];
            $new_line_level = NULL;
            $post = "";
            if( $ends_line_level !== NULL ) {
                $new_line_level = $ends_line_level;
                $ends_line_level = NULL;
            }
            if ( $in_escape ) {
                $in_escape = false;
            } else if( $char === '"' ) {
                $in_quotes = !$in_quotes;
            } else if( ! $in_quotes ) {
                switch( $char ) {
                    case '}': case ']':
                        $level--;
                        $ends_line_level = NULL;
                        $new_line_level = $level;
                        break;

                    case '{': case '[':
                        $level++;
                    case ',':
                        $ends_line_level = $level;
                        break;

                    case ':':
                        $post = " ";
                        break;

                    case " ": case "\t": case "\n": case "\r":
                        $char = "";
                        $ends_line_level = $new_line_level;
                        $new_line_level = NULL;
                        break;
                }
            } else if ( $char === '\\' ) {
                $in_escape = true;
            }
            if( $new_line_level !== NULL ) {
                $result .= "\n".str_repeat( "\t", $new_line_level );
            }
            $result .= $char.$post;
        }

        return $result;
    }