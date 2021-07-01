<?php

use App\Menu;
use App\PermissionsMenu;
use App\PurchaseValuation;

require_once dirname(__FILE__). '/oauth-php/OAuthRequestSigner.php';

define("DOCUMENTS_API_URL", "https://sandbox.viafirma.com/documents/api/v3");
define("DOCUMENTS_CONSUMER_KEY", "motostion");
define("DOCUMENTS_CONSUMER_SECRET", "8793fEeQ9");

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

    function send_document ($purchase, $url_pdf1, $url_pdf2)

    {   
        error_reporting(E_ALL);

        $url=DOCUMENTS_API_URL."/set";

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
                            "groupCode" : "motostion",
                            "workflow": {
                                "type": "PRESENTIAL"
                              },
                            "title" :     "motostion",
                            "description" : "Documentos a Firmar",
                            "recipients": [
                                {
                                  "key": "FIRMANTE_01_KEY",
                                  "mail": "'.$email.'",
                                  "name": "'.$purchase->name.'",
                                  "id": "'.$purchase->dni.'"
                                }
                            ],
                            "metadataList" :[{
                                "key" : "FIRMANTE_01_NAME",
                                "value" : "'.$purchase->name.'"
                            },{
                                "key" : "telefono",
                                "value" : "+34'.$purchase->phone.'"
                            }
                            
                            ],
                            "customization": {
                                "requestMailSubject": "Contrato listo para firmar",
                                "requestMailBody": "Hola. <br /><br />Ya puedes revisar y firmar el documento. Haz click en el siguiente enlace y sigue las instrucciones.",
                                "requestSmsBody": "En el siguiente link puedes revisar y firmar el document"
                            },
                            "messages" : [
                                {
                                "document" : {
                                    "templateType" : "url",
                                    "templateReference" : "'.$url_pdf1.'",
                                    "templateCode": "motostion_SEPA",
                                    "readRequired" : true
                                    }
                                },
                                {
                                "document" : {
                                    "templateType" : "url",
                                    "templateReference" : "'.$url_pdf2.'",
                                    "templateCode": "motostion_SEPA",
                                    "readRequired" : true
                                    }
                                }
                            ],
                            "callbackMails": "webmaster@motostion.com",
                            "callbackURL" : "'.url('/purchase_valuation_interested/callback_document_viafirma').'"
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
        // $link=$array->notification->sharedLink->link;


        $code = '';
        foreach($array->messages as $key => $message){
            if($key != 0)
                $code .= ','.$message->code;
            else $code = $message->code;
        }
        
        $purchase = PurchaseValuation::find($purchase->purchase_valuation_id);
        $purchase->document_code = $code;
        $purchase->update();

        // Closing
        curl_close($ch);
    }

    function send_deceased_document ($purchase, $url_pdf)

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
                          "metadataList" :[{
                                    "key" : "FIRMANTE_01_NAME",
                                    "value" : "'.$purchase->name.'"
                                },{
                                    "key" : "telefono",
                                    "value" : "+34'.$purchase->phone.'"
                                }
                                
                                ],
                          "document": {
                            "templateType" : "url",
                            "templateReference" : "'.$url_pdf.'",
                            "templateCode": "motostion_documento_fallecido",
                            "readRequired" : true,
                            "watermarkText" : "Previsualización",
                            "items" : [ {
                              "key" : "customer_name",
                              "value" : "'.$purchase->name.'"
                            }, {
                              "key" : "otpmail_phoneNumber",
                              "value" : "+34'.$purchase->phone.'"
                            } ]
                          },
                          "callbackMails": "webmaster@motostion.com",
                          "callbackURL" : "'.url('/purchase_valuation_interested/callback_document_viafirma').'"
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
        // $link=$array->notification->sharedLink->link;
        
        $purchase = PurchaseValuation::find($purchase->purchase_valuation_id);
        $purchase->deceased_code = $array->code;
        $purchase->update();

        // Closing
        curl_close($ch);

        return json_encode($array);
    }

    function get_status_document($messageCode = '')
    {
        error_reporting(E_ALL);

        // header('Content-Type: text/plain; charset=utf-8');

        $url=DOCUMENTS_API_URL."/messages/status/".$messageCode;

        OAuthStore::instance('MySQL', array('conn'=>false));
        $req = new OAuthRequestSigner($url, 'GET');
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

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$url);

        // OAuth Header
        $headr = array();
        // $headr[] = 'Content-length: 0';
        // $headr[] = 'Content-type: application/json';
        $headr[] = ''.$req->getAuthorizationHeader();
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headr);

        $result=curl_exec($ch);
        $json = json_decode($result);

        curl_close($ch);

        return $json;
    }

    function download_signed($messageCode = '')
    {
        error_reporting(E_ALL);

        // header('Content-Type: text/plain; charset=utf-8');

        $url=DOCUMENTS_API_URL."/documents/download/signed/".$messageCode;

        OAuthStore::instance('MySQL', array('conn'=>false));
        $req = new OAuthRequestSigner($url, 'GET');
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

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$url);

        // OAuth Header
        $headr = array();
        // $headr[] = 'Content-length: 0';
        // $headr[] = 'Content-type: application/json';
        $headr[] = ''.$req->getAuthorizationHeader();
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headr);

        $result=curl_exec($ch);
        $json = json_decode($result);


        // Closing
        curl_close($ch);

        return $json;
    }

    
    function get_document_info($messageCode = '')
    {
        error_reporting(E_ALL);

        // header('Content-Type: text/plain; charset=utf-8');

        $url=DOCUMENTS_API_URL."/messages/".$messageCode;

        OAuthStore::instance('MySQL', array('conn'=>false));
        $req = new OAuthRequestSigner($url, 'GET');
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

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$url);

        // OAuth Header
        $headr = array();
        // $headr[] = 'Content-length: 0';
        // $headr[] = 'Content-type: application/json';
        $headr[] = ''.$req->getAuthorizationHeader();
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headr);

        $result=curl_exec($ch);
        $json = json_decode($result);

        curl_close($ch);

        return $json;
    }

    function get_status_set($messageCode = '')
    {
        error_reporting(E_ALL);

        // header('Content-Type: text/plain; charset=utf-8');

        $url=DOCUMENTS_API_URL."/set/summary/".$messageCode;

        OAuthStore::instance('MySQL', array('conn'=>false));
        $req = new OAuthRequestSigner($url, 'GET');
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

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$url);

        // OAuth Header
        $headr = array();
        // $headr[] = 'Content-length: 0';
        // $headr[] = 'Content-type: application/json';
        $headr[] = ''.$req->getAuthorizationHeader();
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headr);

        $result=curl_exec($ch);
        $json = json_decode($result);

        curl_close($ch);

        return $json;
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