<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\PurchaseValuation;
use App\PurchaseManagement;
use App\ImagesPurchase;
use Redirect;
use Storage;
use DB;
use Mail;
use App\States;
use App\Processes;
use App\SubProcesses;
use App\Email;
use App\DocumentsPurchaseValuation;
use App\LinksRegister;
use App\Forms;
use App\Business;
use Yajra\Datatables\Datatables;
use App\ApplySubProcessAndProcess;
use App\IncidencePurchase;

class PurchaseValuationController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => [
            'create', 'store', 'callback_document_viafirma'
        ]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view = getPermission('Motos que nos ofrecen', 'record-view');

        if(!$view) return Redirect::to('/')->with('error', 'Usted no posee permisos!');
        
        $haspermision = getPermission('Motos que nos ofrecen', 'record-create');
        $states = States::all();
        $processes = Processes::all();
        $marcas = DB::connection('recambio_ps')->select("SELECT recambio_ps.ps_category.*,recambio_ps.ps_category_lang.name marca FROM recambio_ps.ps_category LEFT JOIN recambio_ps.ps_category_lang ON recambio_ps.ps_category.id_category=recambio_ps.ps_category_lang.id_category AND recambio_ps.ps_category_lang.id_lang='4' WHERE recambio_ps.ps_category.id_parent='13042' GROUP BY recambio_ps.ps_category_lang.name ORDER BY recambio_ps.ps_category_lang.name ASC");

        $motos = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status')
        ->paginate(10);
   
        return view('backend.purchase_valuation.index', compact('states', 'processes', 'marcas', 'haspermision', 'motos'));
    }

    public function getPurchaseValuations(Request $request)
    {
        $requestData = $request;

        $columns = array(
            // datatable column index  => database column name
            1 => 'id',
            4 => 'model'
        );

        $sqlTotalData = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status')
        ->where('purchase_valuation.states_id', '=', 1)
        ->count();

        $totalData = $sqlTotalData;

        $purchases = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status')
        ->where('purchase_valuation.states_id', '=', 1)
        ->get();

        $totalFiltered = $sqlTotalData;
        
        $view = getPermission('Motos que nos ofrecen', 'record-view');
        $edit = getPermission('Motos que nos ofrecen', 'record-edit');
        $delete = getPermission('Motos que nos ofrecen', 'record-delete');
        
        $data = array();
        foreach($purchases as $value){
            $fieldsArray = json_decode($value->data_serialize, true);
           
            $nestedData = array();       

            if($edit == true){             
                $botones = "<a class='mb-2 mr-2 btn btn-warning text-white button_edit' title='Ficha Moto'> Editar</a>";
            }
            else {
                $botones = "No tienes permiso";
            }
            $nestedData[] ='<div class="custom-control custom-checkbox"><input type="checkbox" name="apply" id="apply-1_'.$value->id.'" value="'.$value->id.'" class="custom-control-input"><label class="custom-control-label" for="apply-1_'.$value->id.'"></label></div>';
            $nestedData[] = 'L'.$value->id;
            $nestedData[] = $value->date;
            $nestedData[] = $value->model;
            $nestedData[] = $value->year;
            // $nestedData[] = $value->email .' <br>' . $value->phone;
            $nestedData[] = $value->phone;
            $nestedData[] = $value->province;
            $nestedData[] = $value->price_min;
            $nestedData[] = '<center>' . $botones . '</center>';
            $data[] = $nestedData;
        }
        //exit;
        
        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data, // total data array
        ); 
 
        return response()->json($json_data);
        
    }

    public function getPurchaseValuationsInterested(Request $request)
    {
        $requestData = $request;

        $columns = array(
            // datatable column index  => database column name
            1 => 'id',
            2 => 'model'
        );

        $sqlTotalData = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status')
        ->where('purchase_valuation.states_id', '=', 3)
        ->count();

        $totalData = $sqlTotalData;

        $purchases = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status')
        ->where('purchase_valuation.states_id', '=', 3)
        ->get();

        $totalFiltered = $sqlTotalData;
        
        $view = getPermission('Motos que nos ofrecen', 'record-view');
        $edit = getPermission('Motos que nos ofrecen', 'record-edit');
        $delete = getPermission('Motos que nos ofrecen', 'record-delete');
        
        $data = array();
        foreach($purchases as $value){
           
            $fieldsArray = json_decode($value->data_serialize, true);
            $serializado = '0,00';
            if(isset($fieldsArray) && $fieldsArray != null){
                $serializado  = $fieldsArray[0]['value'];              
            }

            $nestedData = array();   

            if($value->status == 2){
                $status_ficha = "<span class='badge badge-success'>Ficha <br> Verificada</span>";
            }
            elseif($value->status == 1){
                $status_ficha = "<span class='badge badge-warning'>Ficha <br> Registrada</span>";
            }
            elseif($value->status == 0){
                $status_ficha = "<span class='badge badge-danger'>Ficha No <br> Registrada</span>";
            }

            if($edit == true){
                if($value->status == 1){
                    $botones = "<a class='mb-2 mr-2 btn btn-primary text-white button_verificar' title='Verificar Moto'>Verificar</a>";
                    $botones .= "<a class='mb-2 mr-2 btn btn-warning text-white button_ficha' title='Ficha Moto'> Editar</a>";
                }
                else{
                    $botones = "<a class='mb-2 mr-2 btn btn-warning text-white button_ficha' title='Ficha Moto'> Editar</a>";
                }                
            }
            else {
                $botones = "No tienes permiso";
            }
            $nestedData[] ='<div class="custom-control custom-checkbox"><input type="checkbox" name="apply" id="apply-1_'.$value->id.'" value="'.$value->id.'" class="custom-control-input"><label class="custom-control-label" for="apply-1_'.$value->id.'"></label></div>';
            $nestedData[] = 'L'.$value->id;
            $nestedData[] = $value->date;
            $nestedData[] = $value->model;
            $nestedData[] = $value->year;
            $nestedData[] = $value->phone;
            $nestedData[] = $value->province;
            $nestedData[] = $serializado;
            $nestedData[] = $status_ficha;
            $nestedData[] = '<center>' . $botones . '</center>';
            $data[] = $nestedData;
        }
        
        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data, // total data array
        ); 
        // dd($json_data);
        return response()->json($json_data);
    }

    public function getPurchaseValuationsNoInterested(Request $request)
    {
        $requestData = $request;

        $columns = array(
            // datatable column index  => database column name
            1 => 'id',
            2 => 'model'
        );

        $sqlTotalData = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status')
        ->where('purchase_valuation.states_id', '=', 2)
        ->count();

        $totalData = $sqlTotalData;

        $purchases = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status')
        ->where('purchase_valuation.states_id', '=', 2)
        ->get();

        $totalFiltered = $sqlTotalData;
        
        $view = getPermission('Motos que nos ofrecen', 'record-view');
        $edit = getPermission('Motos que nos ofrecen', 'record-edit');
        $delete = getPermission('Motos que nos ofrecen', 'record-delete');
        
        $data = array();
        foreach($purchases as $value){
            $nestedData = array();   

            if($value->status == 2){
                $status_ficha = "<span class='badge badge-success'>Ficha <br> Verificada</span>";
            }
            elseif($value->status == 1){
                $status_ficha = "<span class='badge badge-warning'>Ficha <br> Registrada</span>";
            }
            elseif($value->status == 0){
                $status_ficha = "<span class='badge badge-danger'>Ficha No <br> Registrada</span>";
            }

            if($edit == true && $delete == true){               
                $botones = "<a class='mb-2 mr-2 btn btn-warning text-white button_ficha' title='Ficha Moto'> Editar</a>";
                $botones .= "<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Estado'>Eliminar</a>";
                 
            }elseif ($delete == true) {
                $botones = "<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Estado'>Eliminar</a>";
            }
            else {
                $botones = "No tienes permiso";
            }
            $nestedData[] ='<div class="custom-control custom-checkbox"><input type="checkbox" name="apply" id="apply-1_'.$value->id.'" value="'.$value->id.'" class="custom-control-input"><label class="custom-control-label" for="apply-1_'.$value->id.'"></label></div>';
            $nestedData[] = 'L'.$value->id;
            $nestedData[] = $value->model; 
            $nestedData[] = $value->year;
            $nestedData[] = $value->price_min;   
            $nestedData[] = $value->date; 
            $nestedData[] = $value->motocycle_state;
            $nestedData[] = $value->province;
            $nestedData[] = $value->phone;          
            $nestedData[] = $status_ficha;
            $nestedData[] = '<center>' . $botones . '</center>';
            $data[] = $nestedData;
        }
    
        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data, // total data array
        ); 
       
        return response()->json($json_data);
    }

    public function getPurchaseValuationsScrapping(Request $request)
    {
        $requestData = $request;

        $columns = array(
            // datatable column index  => database column name
            1 => 'id',
            2 => 'model'
        );

        $sqlTotalData = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status')
        ->where('purchase_valuation.states_id', '=', 4)
        ->count();

        $totalData = $sqlTotalData;

        $purchases = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status')
        ->where('purchase_valuation.states_id', '=', 4)
        ->get();

        $totalFiltered = $sqlTotalData;
        
        $view = getPermission('Motos que nos ofrecen', 'record-view');
        $edit = getPermission('Motos que nos ofrecen', 'record-edit');
        $delete = getPermission('Motos que nos ofrecen', 'record-delete');
    
        $data = array();
        foreach($purchases as $value){
            $nestedData = array();   

            if($value->status == 2){
                $status_ficha = "<span class='badge badge-success'>Ficha <br> Verificada</span>";
            }
            elseif($value->status == 1){
                $status_ficha = "<span class='badge badge-warning'>Ficha <br> Registrada</span>";
            }
            elseif($value->status == 0){
                $status_ficha = "<span class='badge badge-danger'>Ficha No <br> Registrada</span>";
            }

            if($edit == true){                
                $botones = "<a class='mb-2 mr-2 btn btn-warning text-white button_ficha' title='Ficha Moto'> Editar</a>";
            }else {
                $botones = "No tienes permiso";
            }

            $nestedData[] ='<div class="custom-control custom-checkbox"><input type="checkbox" name="apply" id="apply-1_'.$value->id.'" value="'.$value->id.'" class="custom-control-input"><label class="custom-control-label" for="apply-1_'.$value->id.'"></label></div>';
            $nestedData[] = 'L'.$value->id;
            $nestedData[] = nl2br($value->model);

            $pro1 = Processes::where('id', 12)->first();           
            if(!!$pro1){
                $grua = ApplySubProcessAndProcess::where('processes_id', $pro1->id)->where('purchase_valuation_id', $value->id)->first();
                $grua_subproceso = SubProcesses::where('id', $grua['subprocesses_id'])->first();  
                if(!!$grua_subproceso){ 
                    if($grua_subproceso['name'] != 'Incidencia Grua'){
                        $nestedData[] = '<span class="text-success"><b>' .nl2br('Si Grúa'). '</b></span>'; 
                    } 
                    if($grua_subproceso['name'] == 'Incidencia Grua'){
                        $nestedData[] = '<span style="color:orange"><b>' .nl2br($grua_subproceso['name']). '</b></span>'; 
                    }  
                    if($grua_subproceso['name'] == 'No Grua'){
                        $nestedData[] = '<span class="text-danger"><b>' .nl2br('No Grúa'). '</b></span>'; 
                    }            
                }else {
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>';
                }
                  
            }

            $pro2 = Processes::where('id', 8)->first(); 
            if(isset($pro2)){
                $alta_motor = ApplySubProcessAndProcess::where('processes_id', $pro2->id)->where('purchase_valuation_id', $value->id)->first();
                $alta_motor_subproceso = SubProcesses::where('id', $alta_motor['subprocesses_id'])->first();  
                if(isset($alta_motor_subproceso)){ 
                    if ($alta_motor_subproceso['name'] == 'Si Motor 1ª F'){
                        $nestedData[] = '<span class="text-success"><b>' .nl2br($alta_motor_subproceso['name']). '</b></span>'; 
                    }   
                    if($alta_motor_subproceso['name'] == 'Incidencia Motor'){
                        $nestedData[] = '<span style="color:orange"><b>' .nl2br($alta_motor_subproceso['name']). '</b></span>'; 
                    }                
                    if ($alta_motor_subproceso['name'] == 'No Motor 1ª F'){
                        $nestedData[] = '<span class="text-danger"><b>' .nl2br($alta_motor_subproceso['name']). '</b></span>'; 
                    }
                }
                else{
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>'; 
                }
                        
            }

            $pro3 = Processes::where('id', 15)->first(); 
            if(isset($pro3)){
                $microfichas = ApplySubProcessAndProcess::where('processes_id', $pro3->id)->where('purchase_valuation_id', $value->id)->first();
                $microfichas_subproceso = SubProcesses::where('id', $microfichas['subprocesses_id'])->first();  
                             
                if(isset($microfichas_subproceso)){ 
                    if ($microfichas_subproceso['name'] == 'No MicroFich'){
                        $nestedData[] = '<span class="text-danger"><b>' .nl2br($microfichas_subproceso['name']). '</b></span>'; 
                    }  
                    if($microfichas_subproceso['name'] == 'Incidencia Microf'){
                        $nestedData[] = '<span style="color:orange"><b>' .nl2br($microfichas_subproceso['name']). '</b></span>'; 
                    }                 
                    if ($microfichas_subproceso['name'] == 'Si MicroFich'){
                        $nestedData[] = '<span class="text-success"><b>' .nl2br($microfichas_subproceso['name']). '</b></span>';                          
                    }                      
                }
                else{
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>'; 
                }
                       
            } 

            $pro4 = Processes::where('id', 24)->first(); 
            if(isset($pro4)){
                $greida_moto = ApplySubProcessAndProcess::where('processes_id', $pro4->id)->where('purchase_valuation_id', $value->id)->first();
                $greida_moto_subproceso = SubProcesses::where('id', $greida_moto['subprocesses_id'])->first();  
                             
                if(isset($greida_moto_subproceso)){ 
                    if ($greida_moto_subproceso['name'] == 'No Greida'){
                        $nestedData[] = '<span class="text-danger"><b>' .nl2br($greida_moto_subproceso['name']). '</b></span>'; 
                    } 
                    if($greida_moto_subproceso['name'] == 'Incidencia Greida'){
                        $nestedData[] = '<span style="color:orange"><b>' .nl2br($greida_moto_subproceso['name']). '</b></span>'; 
                    }                
                    if($greida_moto_subproceso['name'] == 'Si Greida'){
                        $nestedData[] = '<span class="text-success"><b>' .nl2br($greida_moto_subproceso['name']). '</b></span>';                          
                    }                      
                }
                else{
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>'; 
                }
                        
            }   

            $pro5 = Processes::where('id', 3)->first(); 
            if(isset($pro5)){
                $recepcion_moto = ApplySubProcessAndProcess::where('processes_id', $pro5->id)->where('purchase_valuation_id', $value->id)->first();
                $recepcion_moto_subproceso = SubProcesses::where('id', $recepcion_moto['subprocesses_id'])->first();  
                             
                if(isset($recepcion_moto_subproceso)){ 
                    if ($recepcion_moto_subproceso['name'] == 'Pendiente entrada'){
                        $nestedData[] = '<span class="text-danger"><b>' .nl2br($recepcion_moto_subproceso['name']). '</b></span>'; 
                    } 
                    if($recepcion_moto_subproceso['name'] == 'Recepción con incidencia'){
                        $nestedData[] = '<span style="color:orange"><b>' .nl2br($recepcion_moto_subproceso['name']). '</b></span>'; 
                    }                
                    if($recepcion_moto_subproceso['name'] == 'Recepción correcta'){
                        $nestedData[] = '<span class="text-success"><b>' .nl2br($recepcion_moto_subproceso['name']). '</b></span>';                          
                    }                      
                }
                else{
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>'; 
                }
                        
            }   

            $pro6 = Processes::where('id', 4)->first(); 
            if(isset($pro6)){
                $arranque = ApplySubProcessAndProcess::where('processes_id', $pro6->id)->where('purchase_valuation_id', $value->id)->first();
                $arranque_subproceso = SubProcesses::where('id', $arranque['subprocesses_id'])->first();  
                             
                if(isset($arranque_subproceso)){      
                    if ($arranque_subproceso['name'] == 'No arranca'){
                        $nestedData[] = '<span class="text-danger"><b>' .nl2br($arranque_subproceso['name']). '</b></span>'; 
                    } 
                    if($arranque_subproceso['name'] == 'Si Arranca Def'){
                        $nestedData[] = '<span style="color:orange"><b>' .nl2br($arranque_subproceso['name']). '</b></span>'; 
                    }                
                    if($arranque_subproceso['name'] == 'Si Arrancada'){
                        $nestedData[] = '<span class="text-success"><b>' .nl2br($arranque_subproceso['name']). '</b></span>';                          
                    }; 
                }
                else{
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>'; 
                } 
                        
            } 
            
            $pro7 = Processes::where('id', 11)->first(); 
            if(isset($pro7)){
                $descontaminacion = ApplySubProcessAndProcess::where('processes_id', $pro7->id)->where('purchase_valuation_id', $value->id)->first();
                $descontaminacion_subproceso = SubProcesses::where('id', $descontaminacion['subprocesses_id'])->first();  
                             
                if(isset($descontaminacion_subproceso)){
                    if ($descontaminacion_subproceso['name'] == 'Si Descontam.'){
                        $nestedData[] = '<span class="text-success"><b>' .nl2br($descontaminacion_subproceso['name']). '</b></span>'; 
                    } 
                    if($descontaminacion_subproceso['name'] == 'Incidencia Descont'){
                        $nestedData[] = '<span style="color:orange"><b>' .nl2br($descontaminacion_subproceso['name']). '</b></span>'; 
                    }                 
                    elseif ($descontaminacion_subproceso['name'] == 'No Descontam.'){
                        $nestedData[] = '<span class="text-danger"><b>' .nl2br($descontaminacion_subproceso['name']). '</b></span>'; 
                    }                    
                }
                else{
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>'; 
                }
                         
            } 

            $pro8 = Processes::where('id', 13)->first(); 
            if(isset($pro8)){
                $motor2 = ApplySubProcessAndProcess::where('processes_id', $pro8->id)->where('purchase_valuation_id', $value->id)->first();
                $motor2_subproceso = SubProcesses::where('id', $motor2['subprocesses_id'])->first();  
                             
                if(isset($motor2_subproceso)){
                    if ($motor2_subproceso['name'] == 'Si Motor 2ª F'){
                        $nestedData[] = '<span class="text-success"><b>' .nl2br($motor2_subproceso['name']). '</b></span>'; 
                    } 
                    if($motor2_subproceso['name'] == 'Incidencia Motor'){
                        $nestedData[] = '<span style="color:orange"><b>' .nl2br($motor2_subproceso['name']). '</b></span>'; 
                    }                  
                    if ($motor2_subproceso['name'] == 'No Motor 2ª F'){
                        $nestedData[] = '<span class="text-danger"><b>' .nl2br($motor2_subproceso['name']). '</b></span>'; 
                    }                    
                }
                else{
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>'; 
                }                          
            }

       
            $pro9 = Processes::where('id', 6)->first(); 
            if(isset($pro9)){
                $tpv = ApplySubProcessAndProcess::where('processes_id', $pro9->id)->where('purchase_valuation_id', $value->id)->first();
                $tpv_subproceso = SubProcesses::where('id', $tpv['subprocesses_id'])->first();  
                    
                if(isset($tpv_subproceso)){    
                    if ($tpv_subproceso['name'] == 'Si TPV'){
                        $nestedData[] = '<span class="text-success"><b>' .nl2br($tpv_subproceso['name']). '</b></span>'; 
                    } 
                    if($tpv_subproceso['name'] == 'Incidencia TPV'){
                        $nestedData[] = '<span style="color:orange"><b>' .nl2br($tpv_subproceso['name']). '</b></span>'; 
                    }                
                    if ($tpv_subproceso['name'] == 'No TPV'){
                        $nestedData[] = '<span class="text-danger"><b>' .nl2br($tpv_subproceso['name']). '</b></span>'; 
                    }                   
                }
                else{
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>'; 
                }                   
            }

            $pro10 = Processes::where('id', 25)->first(); 
            if(isset($pro10)){
                $desmontaje = ApplySubProcessAndProcess::where('processes_id', $pro10->id)->where('purchase_valuation_id', $value->id)->first();
                $desmontaje_subproceso = SubProcesses::where('id', $desmontaje['subprocesses_id'])->first();  
                             
                if(isset($desmontaje_subproceso)){
                    if ($desmontaje_subproceso['name'] == 'Si desmontaje'){
                        $nestedData[] = '<span class="text-success"><b>' .nl2br($desmontaje_subproceso['name']). '</b></span>'; 
                    }
                    if($desmontaje_subproceso['name'] == 'Incidencia desmontaje'){
                        $nestedData[] = '<span style="color:orange"><b>' .nl2br($desmontaje_subproceso['name']). '</b></span>'; 
                    }                  
                    if ($desmontaje_subproceso['name'] == 'No desmontaje'){
                        $nestedData[] = '<span class="text-danger"><b>' .nl2br($desmontaje_subproceso['name']). '</b></span>'; 
                    }                    
                }
                else{
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>'; 
                }                          
            }

            $pro11 = Processes::where('id', 23)->first(); 
            if(isset($pro11)){
                $fotos = ApplySubProcessAndProcess::where('processes_id', $pro11->id)->where('purchase_valuation_id', $value->id)->first();
                $fotos_subproceso = SubProcesses::where('id', $fotos['subprocesses_id'])->first();  
                if(isset($fotos_subproceso)){           
                    if ($fotos_subproceso['name'] == 'Si Fotos'){
                        $nestedData[] = '<span class="text-success"><b>' .nl2br($fotos_subproceso['name']). '</b></span>'; 
                    }
                    if($fotos_subproceso['name'] == 'Incidencia fotos'){
                        $nestedData[] = '<span style="color:orange"><b>' .nl2br($fotos_subproceso['name']). '</b></span>'; 
                    }                  
                    if ($fotos_subproceso['name'] == 'No Fotos'){
                        $nestedData[] = '<span class="text-danger"><b>' .nl2br($fotos_subproceso['name']). '</b></span>'; 
                    }
                }
                else{
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>'; 
                }      
            }

            $pro12 = Processes::where('id', 9)->first(); 
            if(isset($pro12)){
                $prioridad = ApplySubProcessAndProcess::where('processes_id', $pro12->id)->where('purchase_valuation_id', $value->id)->first();
                $prioridad_subproceso = SubProcesses::where('id', $prioridad['subprocesses_id'])->first();  
                
                if(isset($prioridad_subproceso)){   
                    $nestedData[] = '<b>' .substr($prioridad_subproceso['name'], 0, 1). '</b>';                
                }       
                else{
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>'; 
                }
            }
            
            $pro13 = Processes::where('id', 10)->first(); 
            if(isset($pro13)){
                $bastidor = ApplySubProcessAndProcess::where('processes_id', $pro13->id)->where('purchase_valuation_id', $value->id)->first();
                $bastidor_subproceso = SubProcesses::where('id', $bastidor['subprocesses_id'])->first();  
                             
                if(isset($bastidor_subproceso)){    
                    if ($bastidor_subproceso['name'] == 'Guardar Bastidor'){
                        $nestedData[] = '<span class="text-danger"><b>' .nl2br($bastidor_subproceso['name']). '</b></span>'; 
                    }                 
                    if ($bastidor_subproceso['name'] == 'No Guardar Bastidor'){
                        $nestedData[] = '<b>' .nl2br($bastidor_subproceso['name']). '</b>'; 
                    }                
                }
                else{
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>'; 
                } 
                        
            }
            
            $nestedData[] = $status_ficha;
            $nestedData[] = '<center>' . $botones . '</center>';
            
            $data[] = $nestedData;
        }
        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data, // total data array
        ); 
   
        return response()->json($json_data);
    }

    public function getPurchaseValuationsSale(Request $request)
    {
        $requestData = $request;

        $columns = array(
            // datatable column index  => database column name
            1 => 'id',
            2 => 'model',
            3 => 'year'
        );

        $sqlTotalData = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status')
        ->where('purchase_valuation.states_id', '=', 5)
        ->count();

        $totalData = $sqlTotalData;

        $purchases = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status')
        ->where('purchase_valuation.states_id', '=', 5)
        ->get();

        $totalFiltered = $sqlTotalData;
        
        $view = getPermission('Motos que nos ofrecen', 'record-view');
        $edit = getPermission('Motos que nos ofrecen', 'record-edit');
        $delete = getPermission('Motos que nos ofrecen', 'record-delete');
        
        $data = array();
        foreach($purchases as $value){
            $nestedData = array();   

            if($value->status == 2){
                $status_ficha = "<span class='badge badge-success'>Ficha <br> Verificada</span>";
            }
            elseif($value->status == 1){
                $status_ficha = "<span class='badge badge-warning'>Ficha <br> Registrada</span>";
            }
            elseif($value->status == 0){
                $status_ficha = "<span class='badge badge-danger'>Ficha No <br> Registrada</span>";
            }

            if($edit == true){                
                $botones = "<a class='mb-2 mr-2 btn btn-warning text-white button_ficha' title='Ficha Moto'> Editar</a>";                
            }
            else {
                $botones = "No tienes permiso";
            }
            $nestedData[] ='<div class="custom-control custom-checkbox"><input type="checkbox" name="apply" id="apply-1_'.$value->id.'" value="'.$value->id.'" class="custom-control-input"><label class="custom-control-label" for="apply-1_'.$value->id.'"></label></div>';
            $nestedData[] = 'L'.$value->id;
            $nestedData[] = $value->model;
            $nestedData[] = $value->date;

            $pro1 = Processes::where('id', 16)->first(); 
            if(isset($pro1)){
                $anunciada = ApplySubProcessAndProcess::where('processes_id', $pro1->id)->where('purchase_valuation_id', $value->id)->first();
                $anunciada_subproceso = SubProcesses::where('id', $anunciada['subprocesses_id'])->first();  
                             
                if(isset($anunciada_subproceso)){
                    if ($anunciada_subproceso['name'] == 'Si Anunci'){
                        $nestedData[] = '<span class="text-success"><b>' .nl2br($anunciada_subproceso['name']). '</b></span>'; 
                    } 
                    if($anunciada_subproceso['name'] == 'Inciden Anunc'){
                        $nestedData[] = '<span style="color:orange"><b>' .nl2br($anunciada_subproceso['name']). '</b></span>'; 
                    }                  
                    if ($anunciada_subproceso['name'] == 'No Anunci'){
                        $nestedData[] = '<span class="text-danger"><b>' .nl2br($anunciada_subproceso['name']). '</b></span>'; 
                    }                    
                }
                else{
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>'; 
                } 
                        
            }

            $pro2 = Processes::where('id', 17)->first(); 
            if(isset($pro2)){
                $presu = ApplySubProcessAndProcess::where('processes_id', $pro2->id)->where('purchase_valuation_id', $value->id)->first();
                $presu_subproceso = SubProcesses::where('id', $presu['subprocesses_id'])->first();  
                             
                if(isset($presu_subproceso)){
                    if ($presu_subproceso['name'] == 'Si Presu'){
                        $nestedData[] = '<span class="text-success"><b>' .nl2br($presu_subproceso['name']). '</b></span>'; 
                    } 
                    if($presu_subproceso['name'] == 'Incide Presu'){
                        $nestedData[] = '<span style="color:orange"><b>' .nl2br($presu_subproceso['name']). '</b></span>'; 
                    }                  
                    if ($presu_subproceso['name'] == 'No Presu'){
                        $nestedData[] = '<span class="text-danger"><b>' .nl2br($presu_subproceso['name']). '</b></span>'; 
                    }                    
                }
                else{
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>'; 
                } 
                        
            }

            $pro3 = Processes::where('id', 18)->first(); 
            if(isset($pro3)){
                $pedido = ApplySubProcessAndProcess::where('processes_id', $pro3->id)->where('purchase_valuation_id', $value->id)->first();
                $pedido_subproceso = SubProcesses::where('id', $pedido['subprocesses_id'])->first();  
                             
                if(isset($pedido_subproceso)){
                    if ($pedido_subproceso['name'] == 'Si Pedid'){
                        $nestedData[] = '<span class="text-success"><b>' .nl2br($pedido_subproceso['name']). '</b></span>'; 
                    } 
                    if($pedido_subproceso['name'] == 'Incide Pedid'){
                        $nestedData[] = '<span style="color:orange"><b>' .nl2br($pedido_subproceso['name']). '</b></span>'; 
                    }                  
                    if ($pedido_subproceso['name'] == 'No Pedid'){
                        $nestedData[] = '<span class="text-danger"><b>' .nl2br($pedido_subproceso['name']). '</b></span>'; 
                    }                    
                }
                else{
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>'; 
                } 
                        
            }

            $pro4 = Processes::where('id', 19)->first(); 
            if(isset($pro4)){
                $recibido = ApplySubProcessAndProcess::where('processes_id', $pro4->id)->where('purchase_valuation_id', $value->id)->first();
                $recibido_subproceso = SubProcesses::where('id', $recibido['subprocesses_id'])->first();  
                             
                if(isset($recibido_subproceso)){
                    if ($recibido_subproceso['name'] == 'Si Recibido'){
                        $nestedData[] = '<span class="text-success"><b>' .nl2br($recibido_subproceso['name']). '</b></span>'; 
                    } 
                    if($recibido_subproceso['name'] == 'Incidenci Recambio'){
                        $nestedData[] = '<span style="color:orange"><b>' .nl2br($recibido_subproceso['name']). '</b></span>'; 
                    }                  
                    if ($recibido_subproceso['name'] == 'No Recibido'){
                        $nestedData[] = '<span class="text-danger"><b>' .nl2br($recibido_subproceso['name']). '</b></span>'; 
                    }                    
                }
                else{
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>'; 
                } 
                        
            }

            $pro5 = Processes::where('id', 20)->first(); 
            if(isset($pro5)){
                $reparacion = ApplySubProcessAndProcess::where('processes_id', $pro5->id)->where('purchase_valuation_id', $value->id)->first();
                $reparacion_subproceso = SubProcesses::where('id', $reparacion['subprocesses_id'])->first();  
                             
                if(isset($reparacion_subproceso)){
                    if ($reparacion_subproceso['name'] == 'Si Reparada'){
                        $nestedData[] = '<span class="text-success"><b>' .nl2br($reparacion_subproceso['name']). '</b></span>'; 
                    } 
                    if($reparacion_subproceso['name'] == 'Incidencia Reparación'){
                        $nestedData[] = '<span style="color:orange"><b>' .nl2br($reparacion_subproceso['name']). '</b></span>'; 
                    }                  
                    if ($reparacion_subproceso['name'] == 'No Reparada'){
                        $nestedData[] = '<span class="text-danger"><b>' .nl2br($reparacion_subproceso['name']). '</b></span>'; 
                    }                    
                }
                else{
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>'; 
                } 
                        
            }

            $pro6 = Processes::where('id', 21)->first(); 
            if(isset($pro6)){
                $probada = ApplySubProcessAndProcess::where('processes_id', $pro6->id)->where('purchase_valuation_id', $value->id)->first();
                $probada_subproceso = SubProcesses::where('id', $probada['subprocesses_id'])->first();  
                             
                if(isset($probada_subproceso)){
                    if ($probada_subproceso['name'] == 'Si Probada'){
                        $nestedData[] = '<span class="text-success"><b>' .nl2br($probada_subproceso['name']). '</b></span>'; 
                    } 
                    if($probada_subproceso['name'] == 'Inciden Pruebas'){
                        $nestedData[] = '<span style="color:orange"><b>' .nl2br($probada_subproceso['name']). '</b></span>'; 
                    }                  
                    if ($probada_subproceso['name'] == 'No Probada'){
                        $nestedData[] = '<span class="text-danger"><b>' .nl2br($probada_subproceso['name']). '</b></span>'; 
                    }                    
                }
                else{
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>'; 
                } 
                        
            }

            $pro7 = Processes::where('id', 22)->first(); 
            if(isset($pro7)){
                $anunciada_repa = ApplySubProcessAndProcess::where('processes_id', $pro7->id)->where('purchase_valuation_id', $value->id)->first();
                $anunciada_repa_subproceso = SubProcesses::where('id', $anunciada_repa['subprocesses_id'])->first();  
                             
                if(isset($anunciada_repa_subproceso)){
                    if ($anunciada_repa_subproceso['name'] == 'Si Anunci Repar'){
                        $nestedData[] = '<span class="text-success"><b>' .nl2br($anunciada_repa_subproceso['name']). '</b></span>'; 
                    } 
                    if($anunciada_repa_subproceso['name'] == 'Inciden Anunci'){
                        $nestedData[] = '<span style="color:orange"><b>' .nl2br($anunciada_repa_subproceso['name']). '</b></span>'; 
                    }                  
                    if ($anunciada_repa_subproceso['name'] == 'No Anunci Repar'){
                        $nestedData[] = '<span class="text-danger"><b>' .nl2br($anunciada_repa_subproceso['name']). '</b></span>'; 
                    }                    
                }
                else{
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>'; 
                } 
                        
            }

            $nestedData[] = $status_ficha;
            $nestedData[] = '<center>' . $botones . '</center>';
            $data[] = $nestedData;
        }
        
        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data, // total data array
        ); 
       
        return response()->json($json_data);         
    }

    public function getPurchaseValuationsAuction(Request $request)
    {

        $requestData = $request;

        $columns = array(
            // datatable column index  => database column name
            1 => 'id',
            2 => 'model'
        );

        $sqlTotalData = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status')
        ->where('purchase_valuation.states_id', '=', 6)
        ->count();

        $totalData = $sqlTotalData;

        $purchases = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status', 'purchase_management.street', 'purchase_management.nro_street', 
        'purchase_management.municipality','purchase_management.postal_code')
        ->where('purchase_valuation.states_id', '=', 6)
        ->get();

        $totalFiltered = $sqlTotalData;
        
        $view = getPermission('Motos que nos ofrecen', 'record-view');
        $edit = getPermission('Motos que nos ofrecen', 'record-edit');
        $delete = getPermission('Motos que nos ofrecen', 'record-delete');
        
        $data = array();
        foreach($purchases as $value){
            $nestedData = array();   

            if($value->status == 2){
                $status_ficha = "<span class='badge badge-success'>Ficha <br> Verificada</span>";
            }
            elseif($value->status == 1){
                $status_ficha = "<span class='badge badge-warning'>Ficha <br> Registrada</span>";
            }
            elseif($value->status == 0){
                $status_ficha = "<span class='badge badge-danger'>Ficha No <br> Registrada</span>";
            }

            if($edit == true){
                if($value->publish == 1){
                    $botones = "<a class='mb-2 mr-2 btn btn-success text-white button_publish' name='no_publicado' value='0'>Publicado</a>";
                    $botones .= "<a class='mb-2 mr-2 btn btn-warning text-white button_ficha' title='Ficha Moto'> Editar</a>";
                }else{
                    $botones = "<a class='mb-2 mr-2 btn btn-info text-white button_publish' name='no_publicado' value='1'>Publicar</a>";
                    $botones .= "<a class='mb-2 mr-2 btn btn-warning text-white button_ficha' title='Ficha Moto'> Editar</a>";
                }
            }
            else {
                $botones = "No tienes permiso";
            }
            $nestedData[] ='<div class="custom-control custom-checkbox"><input type="checkbox" name="apply" id="apply-1_'.$value->id.'" value="'.$value->id.'" class="custom-control-input"><label class="custom-control-label" for="apply-1_'.$value->id.'"></label></div>';
            $nestedData[] = 'L'.$value->id;
            $nestedData[] = $value->model;
            $nestedData[] = $value->street. ' ' . $value->nro_street. ' ' . $value->municipality. ' ' . $value->postal_code;
            $nestedData[] = $status_ficha;
            $nestedData[] = '<center>' . $botones . '</center>';
            $data[] = $nestedData;
        }
        
        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data, // total data array
        ); 
       
        return response()->json($json_data); 
    }

    public function getPurchaseValuationsScrapped(Request $request)
    {
        $requestData = $request;

        $columns = array(
            // datatable column index  => database column name
            1 => 'id',
            2 => 'model',
            3 => 'year'
        );

        $sqlTotalData = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status')
        ->where('purchase_valuation.states_id', '=', 7)
        ->count();

        $totalData = $sqlTotalData;

        $purchases = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status')
        ->where('purchase_valuation.states_id', '=', 7)
        ->get();

        $totalFiltered = $sqlTotalData;
        
        $view = getPermission('Motos que nos ofrecen', 'record-view');
        $edit = getPermission('Motos que nos ofrecen', 'record-edit');
        $delete = getPermission('Motos que nos ofrecen', 'record-delete');
        
        $data = array();
        foreach($purchases as $value){
            $nestedData = array();   

            if($value->status == 2){
                $status_ficha = "<span class='badge badge-success'>Ficha <br> Verificada</span>";
            }
            elseif($value->status == 1){
                $status_ficha = "<span class='badge badge-warning'>Ficha <br> Registrada</span>";
            }
            elseif($value->status == 0){
                $status_ficha = "<span class='badge badge-danger'>Ficha No <br> Registrada</span>";
            }

            if($edit == true && $delete == true){                
                $botones = "<a class='mb-2 mr-2 btn btn-warning text-white button_ficha' title='Ficha Moto'> Editar</a>";
                $botones .= "<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Estado'>Eliminar</a>";
            }elseif ($delete == true) {
                $botones = "<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Estado'>Eliminar</a>";
            }
            else {
                $botones = "No tienes permiso";
            }
            $nestedData[] ='<div class="custom-control custom-checkbox"><input type="checkbox" name="apply" id="apply-1_'.$value->id.'" value="'.$value->id.'" class="custom-control-input"><label class="custom-control-label" for="apply-1_'.$value->id.'"></label></div>';
            $nestedData[] = 'L'.$value->id;
            $nestedData[] = $value->model;
            $pro1 = Processes::where('id', 8)->first(); 

            if(isset($pro1)){
                $alta_motor = ApplySubProcessAndProcess::where('processes_id', $pro1->id)->where('purchase_valuation_id', $value->id)->first();
                $alta_motor_subproceso = SubProcesses::where('id', $alta_motor['subprocesses_id'])->first();  
                if(isset($alta_motor_subproceso)){ 
                    if ($alta_motor_subproceso['name'] == 'Si Motor 1ª F'){
                        $nestedData[] = '<span class="text-success"><b>' .nl2br($alta_motor_subproceso['name']). '</b></span>'; 
                    }   
                    if($alta_motor_subproceso['name'] == 'Incidencia Motor'){
                        $nestedData[] = '<span style="color:orange"><b>' .nl2br($alta_motor_subproceso['name']). '</b></span>'; 
                    }                
                    if ($alta_motor_subproceso['name'] == 'No Motor 1ª F'){
                        $nestedData[] = '<span class="text-danger"><b>' .nl2br($alta_motor_subproceso['name']). '</b></span>'; 
                    }
                }
                else{
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>'; 
                }
                        
            }

            $pro2 = Processes::where('id', 4)->first(); 
            if(isset($pro2)){
                $arranque = ApplySubProcessAndProcess::where('processes_id', $pro2->id)->where('purchase_valuation_id', $value->id)->first();
                $arranque_subproceso = SubProcesses::where('id', $arranque['subprocesses_id'])->first();  
                             
                if(isset($arranque_subproceso)){      
                    if ($arranque_subproceso['name'] == 'No arranca'){
                        $nestedData[] = '<span class="text-danger"><b>' .nl2br($arranque_subproceso['name']). '</b></span>'; 
                    } 
                    if($arranque_subproceso['name'] == 'Si Arranca Def'){
                        $nestedData[] = '<span style="color:orange"><b>' .nl2br($arranque_subproceso['name']). '</b></span>'; 
                    }                
                    if($arranque_subproceso['name'] == 'Si Arrancada'){
                        $nestedData[] = '<span class="text-success"><b>' .nl2br($arranque_subproceso['name']). '</b></span>';                          
                    }; 
                }
                else{
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>'; 
                } 
                        
            } 

            $pro3 = Processes::where('id', 11)->first(); 
            if(isset($pro3)){
                $descontaminacion = ApplySubProcessAndProcess::where('processes_id', $pro3->id)->where('purchase_valuation_id', $value->id)->first();
                $descontaminacion_subproceso = SubProcesses::where('id', $descontaminacion['subprocesses_id'])->first();  
                             
                if(isset($descontaminacion_subproceso)){
                    if ($descontaminacion_subproceso['name'] == 'Si Descontam.'){
                        $nestedData[] = '<span class="text-success"><b>' .nl2br($descontaminacion_subproceso['name']). '</b></span>'; 
                    } 
                    if($descontaminacion_subproceso['name'] == 'Incidencia Descont'){
                        $nestedData[] = '<span style="color:orange"><b>' .nl2br($descontaminacion_subproceso['name']). '</b></span>'; 
                    }                 
                    elseif ($descontaminacion_subproceso['name'] == 'No Descontam.'){
                        $nestedData[] = '<span class="text-danger"><b>' .nl2br($descontaminacion_subproceso['name']). '</b></span>'; 
                    }                    
                }
                else{
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>'; 
                }
                         
            } 
       
            $pro4 = Processes::where('id', 6)->first(); 
            if(isset($pro4)){
                $tpv = ApplySubProcessAndProcess::where('processes_id', $pro4->id)->where('purchase_valuation_id', $value->id)->first();
                $tpv_subproceso = SubProcesses::where('id', $tpv['subprocesses_id'])->first();  
                    
                if(isset($tpv_subproceso)){    
                    if ($tpv_subproceso['name'] == 'Si TPV'){
                        $nestedData[] = '<span class="text-success"><b>' .nl2br($tpv_subproceso['name']). '</b></span>'; 
                    } 
                    if($tpv_subproceso['name'] == 'Incidencia TPV'){
                        $nestedData[] = '<span style="color:orange"><b>' .nl2br($tpv_subproceso['name']). '</b></span>'; 
                    }                
                    if ($tpv_subproceso['name'] == 'No TPV'){
                        $nestedData[] = '<span class="text-danger"><b>' .nl2br($tpv_subproceso['name']). '</b></span>'; 
                    }                   
                }
                else{
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>'; 
                }                   
            }

            $pro5 = Processes::where('id', 25)->first(); 
            if(isset($pro5)){
                $desmontaje = ApplySubProcessAndProcess::where('processes_id', $pro5->id)->where('purchase_valuation_id', $value->id)->first();
                $desmontaje_subproceso = SubProcesses::where('id', $desmontaje['subprocesses_id'])->first();  
                             
                if(isset($desmontaje_subproceso)){
                    if ($desmontaje_subproceso['name'] == 'Si desmontaje'){
                        $nestedData[] = '<span class="text-success"><b>' .nl2br($desmontaje_subproceso['name']). '</b></span>'; 
                    }
                    if($desmontaje_subproceso['name'] == 'Incidencia desmontaje'){
                        $nestedData[] = '<span style="color:orange"><b>' .nl2br($desmontaje_subproceso['name']). '</b></span>'; 
                    }                  
                    if ($desmontaje_subproceso['name'] == 'No desmontaje'){
                        $nestedData[] = '<span class="text-danger"><b>' .nl2br($desmontaje_subproceso['name']). '</b></span>'; 
                    }                    
                }
                else{
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>'; 
                }                          
            }

            $pro6 = Processes::where('id', 10)->first(); 
            if(isset($pro6)){
                $bastidor = ApplySubProcessAndProcess::where('processes_id', $pro6->id)->where('purchase_valuation_id', $value->id)->first();
                $bastidor_subproceso = SubProcesses::where('id', $bastidor['subprocesses_id'])->first();  
                             
                if(isset($bastidor_subproceso)){    
                    if ($bastidor_subproceso['name'] == 'Guardar Bastidor'){
                        $nestedData[] = '<span class="text-danger"><b>' .nl2br($bastidor_subproceso['name']). '</b></span>'; 
                    }                 
                    if ($bastidor_subproceso['name'] == 'No Guardar Bastidor'){
                        $nestedData[] = '<b>' .nl2br($bastidor_subproceso['name']). '</b>'; 
                    }                
                }
                else{
                    $nestedData[] = '<span class="badge badge-danger"><b>PROCESO <br> NO APLICADO</b></span>'; 
                } 
                        
            }
 
            $nestedData[] = $status_ficha;
            $nestedData[] = '<center>' . $botones . '</center>';
            $data[] = $nestedData;
        }
        
        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data, // total data array
        ); 
       
        return response()->json($json_data);         
    }

    public function getPurchaseValuationsSold(Request $request)
    {
        $requestData = $request;

        $columns = array(
            // datatable column index  => database column name
            1 => 'id',
            2 => 'model'
        );

        $sqlTotalData = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status')
        ->where('purchase_valuation.states_id', '=', 8)
        ->count();

        $totalData = $sqlTotalData;

        $purchases = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status', 'purchase_management.street', 'purchase_management.nro_street', 
        'purchase_management.municipality','purchase_management.postal_code')
        ->where('purchase_valuation.states_id', '=', 8)
        ->get();
        
        
        $totalFiltered = $sqlTotalData;
        
        $view = getPermission('Motos que nos ofrecen', 'record-view');
        $edit = getPermission('Motos que nos ofrecen', 'record-edit');
        $delete = getPermission('Motos que nos ofrecen', 'record-delete');
        
        $data = array();
        foreach($purchases as $value){
            $nestedData = array();   

            if($value->status == 2){
                $status_ficha = "<span class='badge badge-success'>Ficha <br> Verificada</span>";
            }
            elseif($value->status == 1){
                $status_ficha = "<span class='badge badge-warning'>Ficha <br> Registrada</span>";
            }
            elseif($value->status == 0){
                $status_ficha = "<span class='badge badge-danger'>Ficha No <br> Registrada</span>";
            }

            if($edit == true && $delete == true){                
                $botones = "<a class='mb-2 mr-2 btn btn-warning text-white button_ficha' title='Ficha Moto'> Editar</a>";
                $botones .= "<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Estado'>Eliminar</a>";
            }elseif ($delete == true) {
                $botones = "<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Estado'>Eliminar</a>";
            }
            else {
                $botones = "No tienes permiso";
            }
            $nestedData[] ='<div class="custom-control custom-checkbox"><input type="checkbox" name="apply" id="apply-1_'.$value->id.'" value="'.$value->id.'" class="custom-control-input"><label class="custom-control-label" for="apply-1_'.$value->id.'"></label></div>';
            $nestedData[] = 'L'.$value->id;
            $nestedData[] = $value->model;
            $nestedData[] = $value->street. ' ' . $value->nro_street. ' ' . $value->municipality. ' ' . $value->postal_code;
            $nestedData[] = $status_ficha;
            $nestedData[] = '<center>' . $botones . '</center>';
            $data[] = $nestedData;
        }
        
        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data, // total data array
        ); 
       
        return response()->json($json_data);         
    }

    public function getPurchaseValuationsAuctioned(Request $request)
    {
        $requestData = $request;

        $columns = array(
            // datatable column index  => database column name
            1 => 'id',
            2 => 'model'
        );

        $sqlTotalData = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status')
        ->where('purchase_valuation.states_id', '=', 9)
        ->count();

        $totalData = $sqlTotalData;

        $purchases = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status', 'purchase_management.street', 'purchase_management.nro_street', 
        'purchase_management.municipality','purchase_management.postal_code')
        ->where('purchase_valuation.states_id', '=', 9)
        ->get();

        $totalFiltered = $sqlTotalData;
        
        $view = getPermission('Motos que nos ofrecen', 'record-view');
        $edit = getPermission('Motos que nos ofrecen', 'record-edit');
        $delete = getPermission('Motos que nos ofrecen', 'record-delete');
        
        $data = array();
        foreach($purchases as $value){
            $nestedData = array();   

            if($value->status == 2){
                $status_ficha = "<span class='badge badge-success'>Ficha <br> Verificada</span>";
            }
            elseif($value->status == 1){
                $status_ficha = "<span class='badge badge-warning'>Ficha <br> Registrada</span>";
            }
            elseif($value->status == 0){
                $status_ficha = "<span class='badge badge-danger'>Ficha No <br> Registrada</span>";
            }

            if($edit == true && $delete == true){                
                $botones = "<a class='mb-2 mr-2 btn btn-warning text-white button_ficha' title='Ficha Moto'> Editar</a>";
                $botones .= "<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Estado'>Eliminar</a>";
            }elseif ($delete == true) {
                $botones = "<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Estado'>Eliminar</a>";
            }
            else {
                $botones = "No tienes permiso";
            }
            $nestedData[] ='<div class="custom-control custom-checkbox"><input type="checkbox" name="apply" id="apply-1_'.$value->id.'" value="'.$value->id.'" class="custom-control-input"><label class="custom-control-label" for="apply-1_'.$value->id.'"></label></div>';
            $nestedData[] = 'L'.$value->id;
            $nestedData[] = $value->model;
            $nestedData[] = $value->year;
            $nestedData[] = $value->street. ' ' . $value->nro_street. ' ' . $value->municipality. ' ' . $value->postal_code;
            $nestedData[] = $value->phone;
            $nestedData[] = $status_ficha;
            $nestedData[] = '<center>' . $botones . '</center>';
            $data[] = $nestedData;
        }
        
        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data, // total data array
        ); 
       
        return response()->json($json_data);         
    }

    public function getPurchaseValuationsWhitoutDeal(Request $request)
    {
        $requestData = $request;

        $columns = array(
            // datatable column index  => database column name
            1 => 'id',
            2 => 'model'
        );

        $sqlTotalData = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status')
        ->where('purchase_valuation.states_id', '=', 10)
        ->count();

        $totalData = $sqlTotalData;

        $purchases = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status')
        ->where('purchase_valuation.states_id', '=', 10)
        ->get();

        $totalFiltered = $sqlTotalData;
        
        $view = getPermission('Motos que nos ofrecen', 'record-view');
        $edit = getPermission('Motos que nos ofrecen', 'record-edit');
        $delete = getPermission('Motos que nos ofrecen', 'record-delete');
        
        $data = array();
        foreach($purchases as $value){
            $nestedData = array();   

            if($value->status == 2){
                $status_ficha = "<span class='badge badge-success'>Ficha <br> Verificada</span>";
            }
            elseif($value->status == 1){
                $status_ficha = "<span class='badge badge-warning'>Ficha <br> Registrada</span>";
            }
            elseif($value->status == 0){
                $status_ficha = "<span class='badge badge-danger'>Ficha No <br> Registrada</span>";
            }

            // if($edit == true && $delete == true){                
            //     $botones = "<a class='mb-2 mr-2 btn btn-warning text-white button_ficha' title='Ficha Moto'> Editar</a>";
            //     $botones .= "<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Estado'>Eliminar</a>";
            // }
            if ($delete == true) {
                $botones = "<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Estado'>Eliminar</a>";
            }
            else {
                $botones = "No tienes permiso";
            }
            $nestedData[] ='<div class="custom-control custom-checkbox"><input type="checkbox" name="apply" id="apply-1_'.$value->id.'" value="'.$value->id.'" class="custom-control-input"><label class="custom-control-label" for="apply-1_'.$value->id.'"></label></div>';
            $nestedData[] = 'L'.$value->id;
            $nestedData[] = $value->model;
            $nestedData[] = $value->year;
            $nestedData[] = $value->price_min;
            $nestedData[] = $value->date;
            $nestedData[] = $value->motocycle_state;
            $nestedData[] = $value->province;
            $nestedData[] = $value->phone;
            $nestedData[] = $status_ficha;
            $nestedData[] = '<center>' . $botones . '</center>';
            $data[] = $nestedData;
        }
        
        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data, // total data array
        ); 
       
        return response()->json($json_data);         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = DB::connection('recambio_ps')->select("SELECT recambio_ps.ps_category.*,recambio_ps.ps_category_lang.name marca FROM recambio_ps.ps_category LEFT JOIN recambio_ps.ps_category_lang ON recambio_ps.ps_category.id_category=recambio_ps.ps_category_lang.id_category AND recambio_ps.ps_category_lang.id_lang='4' WHERE recambio_ps.ps_category.id_parent='13042' GROUP BY recambio_ps.ps_category_lang.name ORDER BY recambio_ps.ps_category_lang.name ASC");

        return view('backend.purchase_valuation.create', compact('marcas'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required', 
            'km' => 'required', 
            'email' => 'required', 
            'name' => 'required', 
            'lastname' => 'required', 
            'phone' => ['required'],
            'province' => 'required', 
            'price_min' => 'required', 
            'observations' => 'required',
        ]);

        $purchaseExist = PurchaseValuation::where('brand', $request->brand)->where('model', $request->model)->where('year', $request->year)->where('km', $request->km)->where('name', $request->name)->where('lastname', $request->lastname)->where('email', $request->email)->where('phone', $request->phone)->where('status_trafic', $request->status_trafic)->where('observations', $request->observations)->where('price_min', $request->price_min)->count();

        if($purchaseExist == 0){
            $purchase = new PurchaseValuation($request->all());
            $purchase->date = date('Y-m-d');
            $purchase->states_id = 1; // En Revisión
            $purchase->save();

            foreach($request->images as $file){
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                

                $image_resize = \Image::make($file->getRealPath());
                $img = \Image::make($file->getRealPath())->widen(250, function ($constraint) {
                    $constraint->upsize();
                });

                $img->stream();

                Storage::disk('images_purchase')->put($fileNameToStore, $img);

                $images_purchase = new ImagesPurchase();
                $images_purchase->purchase_valuation_id = $purchase->id;
                $images_purchase->name = $fileNameToStore;
                $images_purchase->save();
            }

            $imagesPurchase = ImagesPurchase::where('purchase_valuation_id', $purchase->id)->get();

            Mail::send('backend.emails.copy-form', ['purchase' => $purchase], function ($message) use ($purchase, $imagesPurchase)
                    {
                        $message->from('info@motostion.com', 'MotOstion');

                        // SE ENVIARA A
                        $message->to('tasacion@motostion.com')->subject($purchase->brand.', '.$purchase->model.', '.$purchase->province);

                        foreach($imagesPurchase as $image){
                            $message->attach(public_path('img_app/images_purchase/'.$image->name));
                        }
                    });

            return Redirect::to('https://motostion.com/');

        }else
            return Redirect::back()->with('error', 'Existe una Tasación con los mismos datos ingresados!')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = str_replace('L', '', $id); 
        $purchase_valuation = PurchaseValuation::find($id);
        $forms = Forms::select(['form_display'])->where('id', 1)->first();
        $images = ImagesPurchase::where('purchase_valuation_id', $purchase_valuation->id)->get();  

        $data['id'] = $purchase_valuation['id'];
        $data['date'] = $purchase_valuation['date'];
        $data['brand'] = $purchase_valuation['brand'];
        $data['model'] = $purchase_valuation['model'];
        $data['exist_model_brand'] = $purchase_valuation['exist_model_brand'];
        $data['year'] = $purchase_valuation['year'];
        $data['km'] = $purchase_valuation['km'];
        $data['email'] = $purchase_valuation['email'];
        $data['name'] = $purchase_valuation['name'];
        $data['lastname'] = $purchase_valuation['lastname'];
        $data['phone'] = $purchase_valuation['phone'];
        $data['province'] = $purchase_valuation['province'];
        $data['status_trafic'] = $purchase_valuation['status_trafic'];
        $data['motocycle_state'] = $purchase_valuation['motocycle_state'];
        $data['price_min'] = $purchase_valuation['price_min'];
        $data['observations'] = $purchase_valuation['observations'];
        $data['form_display'] = htmlspecialchars_decode($forms->form_display);
        $data['data_serialize'] = utf8_encode($purchase_valuation['data_serialize']);
        $data['images_purchase_valuation'] = $images;
        $data['link'] = url('/');
        // dd(htmlspecialchars_decode($forms->form_display));

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase = PurchaseValuation::find($id);
        $images = ImagesPurchase::where('purchase_valuation_id', $purchase->id)->get();     
        $marcas = DB::connection('recambio_ps')->select("SELECT recambio_ps.ps_category.*,recambio_ps.ps_category_lang.name marca FROM recambio_ps.ps_category LEFT JOIN recambio_ps.ps_category_lang ON recambio_ps.ps_category.id_category=recambio_ps.ps_category_lang.id_category AND recambio_ps.ps_category_lang.id_lang='4' WHERE recambio_ps.ps_category.id_parent='13042' GROUP BY recambio_ps.ps_category_lang.name ORDER BY recambio_ps.ps_category_lang.name ASC");

        return view('backend.purchase_valuation.edit', compact('purchase', 'marcas', 'images'));  
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
        // dd($request->all());
        $validator = \Validator::make($request->all(),[
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required', 
            'km' => 'required', 
            'email' => 'required', 
            'name' => 'required', 
            'lastname' => 'required', 
            'phone' => 'required', 
            'province' => 'required', 
            'price_min' => 'required', 
            'observations' => 'required',
        ]);

        if ($validator->fails()) {
            $out['code'] = 422;
            $out['response'] = $validator->errors();
            $out['message'] = 'Errores de validacion';            
            
        }
        if (!$validator->fails()) {
            $purchase = PurchaseValuation::find($id);
            $input = $request->all();
            $purchase->update($input);

            $purchaseCount = PurchaseManagement::where('purchase_valuation_id', $purchase->id)->count();
                
            if($purchaseCount == 1){
                $purchase_management = PurchaseManagement::where('purchase_valuation_id', $purchase->id)->first();
                $purchase_management->name = $purchase->name;
                $purchase_management->firts_surname = $purchase->lastname;
                $purchase_management->second_surtname = '';
                $purchase_management->email = $purchase->email;
                $purchase_management->phone = $purchase->phone;
                $purchase_management->province = $purchase->province;
                $purchase_management->brand = $purchase->brand;
                $purchase_management->model = $purchase->model;
                $purchase_management->kilometres = $purchase->km;
                $purchase_management->update();
            }

            $out['code'] = 200;
            $out['response'] = $purchase;
            $out['message'] = 'Registro Actualizado Exitosamente';
            
        }
        return response()->json($out);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = str_replace('L', '', $id); 
        $delete = getPermission('Motos que nos ofrecen', 'record-delete');

        if(!$delete) return Redirect::to('/')->with('error', 'Usted no posee permisos!');
        
        $purchase = PurchaseValuation::destroy($id);
        $out['code'] = 200;
        $out['message'] = 'Moto eliminada exitosamente!';
        $out['data'] = $purchase;
        
        return response()->json($out);
    }

    public function applyState(Request $request)
    {
        $state = States::find($request->applyState);
        $motos = explode(",", $request->apply);
       
        $out['code'] = 204;
        $out['message'] = 'Hubo un error';

        foreach($motos as $purchase) {
            $id = str_replace('L', '', $purchase);  
            $purchase_model = PurchaseValuation::find($purchase);
            $purchase_model->states_id = $request->applyState;
            $purchase_model->update();

            $token = create_token();

            if($request->applyState == 3){ // CHECK IF IS INTERESTED
                $linksRegister = new LinksRegister();
                $linksRegister->token = $token;
                $linksRegister->purchase_valuation_id = $purchase_model->id;
                $linksRegister->status = 0;
                $linksRegister->save();

                $purchaseCount = PurchaseManagement::where('purchase_valuation_id', $purchase)->count();
                
                if($purchaseCount == 0){
                    $purchase_management = new PurchaseManagement();
                    $purchase_management->purchase_valuation_id = $purchase_model->id;
                    $purchase_management->file_no = $purchase_model->id;
                    $purchase_management->current_year = $purchase_model->date;
                    $purchase_management->collection_contract_date = date('Y-m-d');
                    $purchase_management->documents_attached = '';
                    $purchase_management->non_existence_document = '';
                    $purchase_management->vehicle_delivers = '';
                    $purchase_management->name = $purchase_model->name;
                    $purchase_management->firts_surname = $purchase_model->lastname;
                    $purchase_management->second_surtname = '';
                    $purchase_management->dni = '';
                    $purchase_management->birthdate = '';
                    $purchase_management->phone = $purchase_model->phone;
                    $purchase_management->email = $purchase_model->email;
                    $purchase_management->street = '';
                    $purchase_management->nro_street = '';
                    $purchase_management->stairs = '';
                    $purchase_management->floor = '';
                    $purchase_management->letter = '';
                    $purchase_management->municipality = '';
                    $purchase_management->postal_code = '';
                    $purchase_management->province = '';
                    $purchase_management->iban = '';
                    $purchase_management->sale_amount = $purchase_model->price_min;
                    $purchase_management->name_representantive = '';
                    $purchase_management->firts_surname_representative = '';
                    $purchase_management->second_surtname_representantive = '';
                    $purchase_management->dni_representative = '';
                    $purchase_management->birthdate_representative = '';
                    $purchase_management->phone_representantive = '';
                    $purchase_management->email_representative = '';
                    $purchase_management->representation_concept = '';
                    $purchase_management->brand = $purchase_model->brand;
                    $purchase_management->model = $purchase_model->model;
                    $purchase_management->version = '';
                    $purchase_management->type = '';
                    $purchase_management->kilometres = $purchase_model->km;
                    $purchase_management->color = '';
                    $purchase_management->fuel = '';
                    $purchase_management->weight = 0;
                    $purchase_management->registration_number = '';
                    $purchase_management->registration_date = '';
                    $purchase_management->registration_country = '';
                    $purchase_management->frame_no = '';
                    $purchase_management->motor_no = '';
                    $purchase_management->type_motor = '';
                    $purchase_management->vehicle_state_trafic = $purchase_model->status_trafic;
                    $purchase_management->vehicle_state = '';
                    $purchase_management->save();
                }
                
                
            }

            if($state->email->id != 7){ // SINO ES PLANTILLA DEFAULT ENVIA CORREO
                $subprocesses = [];
                $subject = '';

                if($request->applyState == 3){
                    $subject = 'Formulario para terminar de vender tu moto';
                }
                elseif($request->applyState == 2){
                    $subject = 'Tasación de tu moto';
                }
                else{
                    $subject = $state->name;
                }
                // ENVIAR CORREO
                Mail::send('backend.emails.template', ['purchase' => $purchase_model, 'state' => $state, 'token' => $token, 'subprocesses' => $subprocesses, 'purchaseCount' => $purchaseCount], function ($message) use ($subject, $purchase_model)
                {
                    $message->from('info@motostion.com', 'MotOstion');

                    // SE ENVIARA A
                    $message->to($purchase_model->email)->subject($subject);
                });
            }
            
            $out['code'] = 200;
            $out['data'] = $purchase;
            $out['message'] = 'Estado Actualizado Exitosamente';
        }
        
        return response()->json($out);
    }

    public function applyProcesses(Request $request)
    {
        $processes = Processes::find($request->processes_id);
        $subprocesses = SubProcesses::find($request->subprocesses_id);
        $purchase = PurchaseValuation::find($request->purchase_id);
        $purchase_management = PurchaseManagement::where('purchase_valuation_id', $purchase->id)->first();

        // check last process and delete
        $lastProcessApply = ApplySubProcessAndProcess::where('processes_id', $processes->id)->where('purchase_valuation_id', $purchase->id)->get();

        if($lastProcessApply->count() > 0){            
            ApplySubProcessAndProcess::where('processes_id', $processes->id)->where('purchase_valuation_id', $purchase->id)->delete();
        }

        $apply = new ApplySubProcessAndProcess();
        $apply->processes_id = $processes->id;
        $apply->subprocesses_id = $subprocesses->id;
        $apply->purchase_valuation_id = $purchase->id;
        $apply->save();

        if(isset($request->incidence)){
            $inci = new IncidencePurchase();
            $inci->processes_id = $processes->id;
            $inci->subprocesses_id = $subprocesses->id;
            $inci->purchase_valuation_id = $purchase->id;
            $inci->description = $request->incidence;
            $inci->save();
        }
    
        if(!empty($subprocesses->business_id) && $processes->id == 12){
            $state = [];
            $token = '';
            $business = Business::find($subprocesses->business_id);

            
            Mail::send('backend.emails.business', ['purchase' => $purchase, 'purchase_management' => $purchase_management,'subprocesses' => $subprocesses, 'state' => $state, 'token' => $token, 'business' => $business], function ($message) use ($subprocesses, $business)
                {
                    $message->from('info@motostion.com', 'MotOstion');

                    // SE ENVIARA A
                    $message->to($business->email)->subject($subprocesses->name);
                });
        }
        if($subprocesses->email->id != 7 && $processes->id != 12){ // SINO ES PLANTILLA DEFAULT ENVIA CORREO
            $state = [];
            $token = '';
            Mail::send('backend.emails.template', ['purchase' => $purchase, 'subprocesses' => $subprocesses, 'state' => $state, 'token' => $token], function ($message) use ($subprocesses, $purchase)
                {
                    $message->from('info@motostion.com', 'MotOstion');

                    // SE ENVIARA A
                    $message->to($purchase->email)->subject($subprocesses->name);
                });
        }

        $out['code'] = 200;
        $out['data'] = $purchase;
        $out['message'] = 'Se ha aplicado el proceso Exitosamente';

        return response()->json($out);
    }

    public function showImages(Request $request)
    {
        $id = str_replace('L', '', $request->id); 
        $data = $id;
       
        $images = ImagesPurchase::where('purchase_valuation_id', $data)->get();        
        return response()->json(['success'=> 200, 'data' => $images]);
    }

    public function uploadDocument(Request $request)
    {
        $path = public_path().'/documents_purchase/';
        $files = $request->file('file');
        foreach($files as $file){
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $file->move($path, $fileNameToStore);

            $projectImage = new DocumentsPurchaseValuation();
            $projectImage->purchase_valuation_id = $request->id;
            $projectImage->name = $fileNameToStore;
            $projectImage->save();
        }
    }

    public function uploadImage(Request $request)
    {
        $path = public_path().'/img_app/images_purchase/';
        $files = $request->file('file');
        foreach($files as $file){
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $file->move($path, $fileNameToStore);

            $images_purchase = new ImagesPurchase();
            $images_purchase->purchase_valuation_id = $request->id;
            $images_purchase->name = $fileNameToStore;
            $images_purchase->save();
            
        }
    }

    public function showFicha()
    {
        $view = getPermission('Motos que nos ofrecen', 'record-view');

        if(!$view) return Redirect::to('/')->with('error', 'Usted no posee permisos!');
        
        $states = States::all();
        $processes = Processes::all();
        $marcas = DB::connection('recambio_ps')->select("SELECT recambio_ps.ps_category.*,recambio_ps.ps_category_lang.name marca FROM recambio_ps.ps_category LEFT JOIN recambio_ps.ps_category_lang ON recambio_ps.ps_category.id_category=recambio_ps.ps_category_lang.id_category AND recambio_ps.ps_category_lang.id_lang='4' WHERE recambio_ps.ps_category.id_parent='13042' GROUP BY recambio_ps.ps_category_lang.name ORDER BY recambio_ps.ps_category_lang.name ASC");   

        return view('backend.purchase_valuation.ficha', compact('states', 'processes', 'marcas'));

    }

    public function getDataFicha($id)
    {
        $id = str_replace('L', '', $id);       
        $view = getPermission('Motos que nos ofrecen', 'record-view');

        if(!$view) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $purchase_valuation = PurchaseValuation::find($id);
        $documents_purchase_valuation = DocumentsPurchaseValuation::where('purchase_valuation_id', $id)->get();
        $images_purchase_valuation = ImagesPurchase::where('purchase_valuation_id', $id)->get();
        $purchase_management = PurchaseManagement::where('purchase_valuation_id', $id)->first();
        $forms = Forms::select(['form_display'])->where('id', 1)->first(); 
        $datos_del_mecanico = Forms::select(['form_display'])->where('id', 2)->first(); 
        $datos_interno = Forms::select(['form_display'])->where('id', 3)->first(); 
        $subprocesses_id = $purchase_valuation['subprocesses_id'];
        
        $apply = ApplySubProcessAndProcess::where('purchase_valuation_id', $id)->get();
        $processes = array();
        $dateDocuments = '';
        foreach ($apply as $key => $value) {
            $process = Processes::find($value->processes_id);
            $subprocesses = SubProcesses::find($value->subprocesses_id);
            array_push($processes, ['name' => $process->name, 'subproceso' => $subprocesses->name, 'date' => date_format($value->created_at, 'Y-m-d')]);

            if($subprocesses->id == 17 || $subprocesses->id == 18)
                $dateDocuments = date_format($value->created_at, 'Y-m-d');
        }

        $data['documents_send'] = false;
        $documentsDestruction = array();
        $documentsDestructionDeceased = array();
        $documentsPossibleSale = array();
        $documentsPossibleSaleDeceased = array();

        if(ApplySubProcessAndProcess::where('processes_id', 7)->where('subprocesses_id', 17)->where('purchase_valuation_id', $purchase_valuation->id)->count() > 0 || ApplySubProcessAndProcess::where('processes_id', 7)->where('subprocesses_id', 18)->where('purchase_valuation_id', $purchase_valuation->id)->count() > 0){
            
            $data['documents_send'] = true;

            if($purchase_valuation['documents_destruction'] != NULL){

                $explodeCode = explode(",", $purchase_valuation->destruction_code);

                foreach($explodeCode as $key => $code){
                    $nameDocument = '';
                    if($key == 0)
                        $nameDocument = 'Certificado de destrucción';
                    elseif($key == 1)
                        $nameDocument = 'Documentos para Destrucción';


                    array_push($documentsDestruction, ['name_document' => $nameDocument,'get_status_document' =>  get_status_document($code), 'download_signed' => download_signed($code), 'approval_document' => str_replace("trail", "approval", get_document_info($code)->auditTrailPage), 'date' => $dateDocuments, 'code' => $code ]);
                }
            }

            if($purchase_valuation['destruction_deceased'] != NULL){

                $explodeCode = explode(",", $purchase_valuation->destruction_deceased_code);

                foreach($explodeCode as $key => $code){
                    $nameDocument = '';
                    if($key == 0)
                        $nameDocument = 'Certificado de destrucción';
                    elseif($key == 1)
                        $nameDocument = 'Documentos para Destrucción';
                    elseif($key == 2)
                        $nameDocument = 'Declaracion Responsable Fallecidos';


                    array_push($documentsDestructionDeceased, ['name_document' => $nameDocument,'get_status_document' =>  get_status_document($code), 'download_signed' => download_signed($code), 'approval_document' => str_replace("trail", "approval", get_document_info($code)->auditTrailPage), 'date' => $dateDocuments, 'code' => $code ]);
                }
            }

            if($purchase_valuation['possible_sale'] != NULL){

                $explodeCode = explode(",", $purchase_valuation->possible_sale_code);

                foreach($explodeCode as $key => $code){
                    $nameDocument = '';
                    if($key == 0)
                        $nameDocument = 'Certificado de destrucción';
                    elseif($key == 1)
                        $nameDocument = 'Documentos para Destrucción';
                    elseif($key == 2)
                        $nameDocument = 'Documentos para venta';


                    array_push($documentsPossibleSale, ['name_document' => $nameDocument,'get_status_document' =>  get_status_document($code), 'download_signed' => download_signed($code), 'approval_document' => str_replace("trail", "approval", get_document_info($code)->auditTrailPage), 'date' => $dateDocuments, 'code' => $code ]);
                }
            }

            if($purchase_valuation['possible_sale_deceased'] != NULL){

                $explodeCode = explode(",", $purchase_valuation->sale_deceased_code);

                foreach($explodeCode as $key => $code){
                    $nameDocument = '';
                    if($key == 0)
                        $nameDocument = 'Certificado de destrucción';
                    elseif($key == 1)
                        $nameDocument = 'Documentos para Destrucción';
                    elseif($key == 2)
                        $nameDocument = 'Documentos para venta';
                    elseif($key == 3)
                        $nameDocument = 'Declaracion Responsable Fallecidos';


                    array_push($documentsPossibleSaleDeceased, ['name_document' => $nameDocument,'get_status_document' =>  get_status_document($code), 'download_signed' => download_signed($code), 'approval_document' => str_replace("trail", "approval", get_document_info($code)->auditTrailPage), 'date' => $dateDocuments, 'code' => $code ]);
                }
            }
        }
        
        $data['id'] = $purchase_valuation['id'];
        $data['date'] = $purchase_valuation['date'];
        $data['brand'] = $purchase_valuation['brand'];
        $data['model'] = $purchase_valuation['model'];
        $data['exist_model_brand'] = $purchase_valuation['exist_model_brand'];
        $data['year'] = $purchase_valuation['year'];
        $data['km'] = $purchase_valuation['km'];
        $data['email'] = $purchase_valuation['email'];
        $data['name'] = $purchase_valuation['name'];
        $data['lastname'] = $purchase_valuation['lastname'];
        $data['phone'] = $purchase_valuation['phone'];
        $data['province'] = $purchase_valuation['province'];
        $data['status_trafic'] = $purchase_valuation['status_trafic'];
        $data['motocycle_state'] = $purchase_valuation['motocycle_state'];
        $data['price_min'] = $purchase_valuation['price_min'];
        $data['observations'] = $purchase_valuation['observations'];
        $data['form_display'] = htmlspecialchars_decode($forms->form_display);
        $data['data_serialize'] = ($purchase_valuation['data_serialize']);
        $data['states_id'] = $purchase_valuation['states_id'];
        $data['processes'] = $processes;
        $data['created_at'] = date_format($purchase_valuation['created_at'], 'Y-m-d');

        //Datos Purchase Management
        $data['file_no'] = $purchase_management['file_no'];
        $data['current_year'] = date('Y-m-d');
        $data['collection_contract_date'] = $purchase_management['collection_contract_date'];
        $data['documents_attached'] = $purchase_management['documents_attached'];
        $data['non_existence_document'] = $purchase_management['non_existence_document'];
        $data['vehicle_delivers'] = $purchase_management['vehicle_delivers'];
        $data['firts_name'] = $purchase_management['name'];
        $data['firts_surname'] = $purchase_management['firts_surname'];
        $data['second_surtname'] = $purchase_management['second_surtname'];
        $data['dni'] = $purchase_management['dni'];
        $data['birthdate'] = $purchase_management['birthdate'];
        $data['phone_management'] = $purchase_management['phone'];
        $data['email_management'] = $purchase_management['email'];
        $data['street'] = $purchase_management['street'];
        $data['nro_street'] = $purchase_management['nro_street'];
        $data['stairs'] = $purchase_management['stairs'];
        $data['floor'] = $purchase_management['floor'];
        $data['letter'] = $purchase_management['letter'];
        $data['municipality'] = $purchase_management['municipality'];
        $data['postal_code'] = $purchase_management['postal_code'];
        $data['province_management'] = $purchase_management['province'];
        $data['iban'] = $purchase_management['iban'];
        $data['sale_amount'] = $purchase_management['sale_amount'];
        $data['name_representantive'] = $purchase_management['name_representantive'];
        $data['firts_surname_representative'] = $purchase_management['firts_surname_representative'];
        $data['second_surtname_representantive'] = $purchase_management['second_surtname_representantive'];
        $data['dni_representative'] = $purchase_management['dni_representative'];
        $data['birthdate_representative'] = $purchase_management['birthdate_representative'];
        $data['phone_representantive'] = $purchase_management['phone_representantive'];
        $data['email_representative'] = $purchase_management['email_representative'];
        $data['representation_concept'] = $purchase_management['representation_concept'];
        $data['brand_management'] = $purchase_management['brand'];
        $data['model_management'] = $purchase_management['model'];
        $data['version'] = $purchase_management['version'];
        $data['type'] = $purchase_management['type'];
        $data['kilometres'] = $purchase_management['kilometres'];
        $data['color'] = $purchase_management['color'];
        $data['fuel'] = $purchase_management['fuel'];
        $data['registration_number'] = $purchase_management['registration_number'];
        $data['registration_date'] = $purchase_management['registration_date'];
        $data['registration_country'] = $purchase_management['registration_country'];
        $data['frame_no'] = $purchase_management['frame_no'];
        $data['motor_no'] = $purchase_management['motor_no'];
        $data['type_motor'] = $purchase_management['type_motor'];
        $data['vehicle_state_trafic'] = $purchase_management['vehicle_state_trafic'];
        $data['vehicle_state'] = $purchase_management['vehicle_state'];
        $data['status_ficha'] = $purchase_management['status'];
        $data['weight'] = $purchase_management['weight'];
        //
        $data['documents_purchase_valuation'] = $documents_purchase_valuation;
        $data['images_purchase_valuation'] = $images_purchase_valuation;

        // GET DOCS FORM MAIL INTERESTED
        $data['dni_doc'] = $purchase_management['dni_doc'];
        $data['per_circulacion'] = $purchase_management['per_circulacion'];
        $data['ficha_tecnica'] = $purchase_management['ficha_tecnica'];
        $data['other_docs'] = $purchase_management['other_docs'];   
        
        //nuevos formularios
        $data['form_display_datos_mecanico'] = htmlspecialchars_decode($datos_del_mecanico->form_display);
        $data['datos_del_mecanico'] = ($purchase_management['datos_del_mecanico']);
        $data['form_display_datos_internos'] = htmlspecialchars_decode($datos_interno->form_display);
        $data['datos_internos'] = ($purchase_management['datos_internos']);
        $data['check_chasis'] = $purchase_management['check_chasis'];
        
        $data['link'] = url('/');
        $data['url_label'] = url('labels/'. $purchase_valuation['id']);

        // DOCUMENTS VIAFIRMA
        $data['documentsDestruction'] = $documentsDestruction;
        $data['documentsDestructionDeceased'] = $documentsDestructionDeceased;
        $data['documentsPossibleSale'] = $documentsPossibleSale;
        $data['documentsPossibleSaleDeceased'] = $documentsPossibleSaleDeceased;
 
        return response()->json($data);

    }

    public function updateFicha(Request $request)
    {
        $edit = getPermission('Motos que nos ofrecen', 'record-edit');

        if(!$edit) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $validator = \Validator::make($request->all(),[
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required', 
            'km' => 'required', 
            'email' => 'required', 
            'name' => 'required', 
            'lastname' => 'required', 
            'phone' => ['required'],
            // 'phone_representantive' => ["regex:^\+[1-9]{1}[0-9]{3,14}$/"],
            'province' => 'required', 
            'price_min' => 'required', 
            'observations' => 'required',
            'type' => 'required',
            'kilometres' => 'required',
            'fuel' => 'required',
            'weight' => 'required',
            'registration_number' => 'required',
            'registration_date' => 'required|date',
            'registration_country' => 'required',
            'frame_no' => ['required'],
            'type_motor' => 'required',
            'vehicle_state_trafic' => 'required',
            'vehicle_state' => 'required'
        ]);

        $purchase = PurchaseValuation::find($request->purchase_id);
        $purchase->date = $request->date;
        $purchase->brand = $request->brand;
        $purchase->model = $request->model;
        $purchase->year = $request->year;
        $purchase->km = $request->km;
        $purchase->email = $request->email;
        $purchase->name = $request->name;
        $purchase->lastname = $request->lastname;
        $purchase->phone = $request->phone;
        $purchase->province = $request->province;
        $purchase->status_trafic = $request->status_trafic;
        $purchase->motocycle_state = $request->motocycle_state;
        $purchase->price_min = $request->price_min;
        $purchase->observations = $request->observations;
        $purchase->data_serialize = $request->data_serialize;
        $purchase->exist_model_brand = $request->exist_model_brand;
        $purchase->update();

        $documents_attached = 0;
        $non_existence_document = 0;

        if($request->documents_attached){
            $documents_attached = 1;
        }
        if($request->non_existence_document){
            $non_existence_document = 1;
        }

        $purchaseM = PurchaseManagement::where('purchase_valuation_id', $purchase->id)->first();
        
        $purchase_management = PurchaseManagement::find($purchaseM->id);
         
        $purchase_management->file_no = $request->file_no;
        $purchase_management->current_year = $request->current_year;
        $purchase_management->collection_contract_date = $request->collection_contract_date;
        $purchase_management->documents_attached = $documents_attached;
        $purchase_management->non_existence_document = $non_existence_document;     
        $purchase_management->vehicle_delivers = $request->vehicle_delivers;
        $purchase_management->name = $request->firts_name;
        $purchase_management->firts_surname = $request->firts_surname;
        $purchase_management->second_surtname = $request->second_surtname;
        $purchase_management->dni = $request->dni;
        $purchase_management->birthdate = $request->birthdate;
        $purchase_management->phone = $request->phone;
        $purchase_management->email = $request->email;
        $purchase_management->street = $request->street;
        $purchase_management->nro_street = $request->nro_street;
        $purchase_management->stairs = $request->stairs;
        $purchase_management->floor = $request->floor;
        $purchase_management->letter = $request->letter;
        $purchase_management->municipality = $request->municipality;
        $purchase_management->postal_code = $request->postal_code;
        $purchase_management->province = $request->province;
        $purchase_management->iban = $request->iban;
        $purchase_management->sale_amount = $request->sale_amount;
        $purchase_management->name_representantive = $request->name_representantive;
        $purchase_management->firts_surname_representative = $request->firts_surname_representative;
        $purchase_management->second_surtname_representantive = $request->second_surtname_representantive;
        $purchase_management->dni_representative = $request->dni_representative;
        $purchase_management->birthdate_representative = $request->birthdate_representative;
        $purchase_management->phone_representantive = $request->phone_representantive;
        $purchase_management->email_representative = $request->email_representative;
        $purchase_management->representation_concept = $request->representation_concept;
        $purchase_management->brand = $request->brand;
        $purchase_management->model = $request->model;
        $purchase_management->version = $request->version;
        $purchase_management->type = $request->type;
        $purchase_management->kilometres = $request->kilometres;
        $purchase_management->color = $request->color;
        $purchase_management->fuel = $request->fuel;
        $purchase_management->registration_number = $request->registration_number;
        $purchase_management->registration_date = $request->registration_date;
        $purchase_management->registration_country = $request->registration_country;
        $purchase_management->frame_no = $request->frame_no;
        $purchase_management->motor_no = $request->motor_no;
        $purchase_management->type_motor = $request->type_motor;
        $purchase_management->vehicle_state_trafic = $request->vehicle_state_trafic;
        $purchase_management->vehicle_state = $request->vehicle_state;
        $purchase_management->datos_del_mecanico = $request->datos_del_mecanico;
        $purchase_management->datos_internos = $request->datos_internos;
        $purchase_management->weight = $request->weight;
        $purchase_management->check_chasis = $request->check_chasis;
        $purchase_management->update();

        $out['message'] = 'Registro Actualizado Exitosamente.';
    
        if($request->sendMailMecanico == 1){
            $mecanico = $request->datos_del_mecanico;
            $subject = 'Datos para el mécanico de la moto #'. $request->file_no;   
              
            $fieldsArray = (json_decode(utf8_encode($request->datos_del_mecanico)));
            foreach ($fieldsArray as $key => $value) {
                if ($value->name == 'ctBGrVLw'){
                    $mailMecanico = $value->value;
                }
            }   
            
            Mail::send('backend.emails.mecanico', ['dataSerialize' => $mecanico, 'subject' => $subject], function ($message) use ($mailMecanico, $subject)
                {
                $message->from('info@motostion.com', 'MotOstion');

                // SE ENVIARA A
                $message->to($mailMecanico)->subject($subject);
            });
        }

        $json_data = array('data'=> $purchase_management);
        $json_data = collect($json_data);  

        $out['code'] = 200;
        $out['data'] = $json_data;

        return response()->json($out);
    }

    public function PublishMotocycle(Request $request)
    {
        $id = str_replace('L', '', $request->id); 
        $user = PurchaseValuation::findOrFail($id);
        $status = '';
        $mensaje = '';
        if ($user->publish == 0) {
            $status = 1;
            $mensaje = 'Moto publicada exitosamente. !';
        }
        if ($user->publish == 1) {
            $status = 0;
            $mensaje = 'Moto despublicada exitosamente. !';
        }

        $user->publish = $status;
        $user->save();

        $data['code']    = 200;
        $data['message'] = $mensaje;

        return response()->json($data);
    }

    public function verifyFicha(Request $request)
    {
        $id = str_replace('L', '', $request->id); 
        $purchase = PurchaseManagement::where('purchase_valuation_id', $id)->first();
        $purchase->status = 2;
        $purchase->update();

        $data['code']    = 200;
        $data['message'] = "Ficha de la Moto VERIFICADA!";

        return response()->json($data);
    }
    

    public function document($fileName){
        $path = public_path().'/documents_purchase/'.$fileName;
        return \Response::download($path);        
    }

    public function image($fileName){
        $path = public_path().'/images_purchase/'.$fileName;
        return \Response::download($path);        
    }

    public function deleteImages(Request $request){
        //dd($request->all());
        $purchase = ImagesPurchase::find($request->id);
        if(isset($purchase)){
            $imagePath = public_path().'/path/'. $purchase->name; // For dynamic value  
            ImagesPurchase::destroy($purchase->id);
            \File::delete($imagePath); //delete image from server
            $images = ImagesPurchase::where('purchase_valuation_id', $purchase->purchase_valuation_id)->get();       
            $out['code'] = 200;
            $out['message'] = 'Imagen eliminada exitosamente';
            $out['images_purchase_valuation'] = $images;
            $out['link'] = url('/');
        }
        else{
            $out['code'] = 422;
            $out['message'] = 'Imagen no encontrada! No se pudo eliminar.';
            $out['images_purchase_valuation'] = '';
            $out['link'] = url('/');
        }
        return response()->json($out);
    }

    public function deleteDocuments(Request $request){
        //dd($request->all());
        $purchase = DocumentsPurchaseValuation::find($request->id);
        if(isset($purchase)){
            $documentPath = public_path().'/path/'. $purchase->name; // For dynamic value  
            DocumentsPurchaseValuation::destroy($purchase->id);
            \File::delete($documentPath); //delete image from server
            $documents = DocumentsPurchaseValuation::where('purchase_valuation_id', $purchase->purchase_valuation_id)->get(); 
            $purchase_management = PurchaseManagement::where('purchase_valuation_id', $purchase->purchase_valuation_id)->first();
      
            $out['code'] = 200;
            $out['message'] = 'Documento eliminado exitosamente';
            $out['documents_purchase_valuation'] = $documents;
            $out['dni_doc'] = $purchase_management['dni_doc'];
            $out['per_circulacion'] = $purchase_management['per_circulacion'];
            $out['ficha_tecnica'] = $purchase_management['ficha_tecnica'];
            $out['other_docs'] = $purchase_management['other_docs'];  
            $out['link'] = url('/');
        }
        else{
            $out['code'] = 422;
            $out['message'] = 'Documento no encontrado! No se pudo eliminar.';
            $out['documents_purchase_valuation'] = '';
            $out['link'] = url('/');
        }
        return response()->json($out);
    } 

    public function findImages(Request $request)
    {
        $images_purchase_valuation = ImagesPurchase::where('purchase_valuation_id', $request->id)->get();
        $out['code'] = 200;
        $out['message'] = 'Imagen(es) agregada(s) exitosamente';
        $out['images_purchase_valuation'] = $images_purchase_valuation;
        $out['link'] = url('/');

        return response()->json($out);
    }

    public function findDocuments(Request $request)
    {
        $documents = DocumentsPurchaseValuation::where('purchase_valuation_id', $request->id)->get();
        $purchase_management = PurchaseManagement::where('purchase_valuation_id', $request->id)->first();
        $out['code'] = 200;
        $out['message'] = 'Documento(s) agregado(s) exitosamente';
        $out['documents_purchase_valuation'] = $documents;
        $out['dni_doc'] = $purchase_management['dni_doc'];
        $out['per_circulacion'] = $purchase_management['per_circulacion'];
        $out['ficha_tecnica'] = $purchase_management['ficha_tecnica'];
        $out['other_docs'] = $purchase_management['other_docs']; 
        $out['link'] = url('/');

        return response()->json($out);
    }

    public function labelsPdf($id)
    {
        $purchase = PurchaseValuation::find($id);
        $purchaseM = PurchaseManagement::where('purchase_valuation_id', $purchase->id)->first();
        $purchase_management = PurchaseManagement::find($purchaseM->id);
         // CREATE PDF
        $view =  \View::make('pdf.etiqueta', compact('purchase', 'purchase_management'))->render(); // send data to view
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        $nameFile = 'Etiquetas-'.date('y-m-d-h-i-s').'.pdf';
        return $pdf->stream($nameFile);
        // return $pdf->download($nameFile);
    }

    // DESTRUCTION
    public function send_document_destruction($id)
    {
        $purchase = PurchaseValuation::find($id);
        $purchase_management = PurchaseManagement::where('purchase_valuation_id', $purchase->id)->first();
       
        if(ApplySubProcessAndProcess::where('processes_id', 7)->where('subprocesses_id', 17)->where('purchase_valuation_id', $purchase->id)->count() > 0){

            // CREATE CERTIFICATE DESTRUCTION
            $view =  \View::make('pdf.certificado-destruccion', compact('purchase', 'purchase_management'))->render(); // send data to view
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);

            $output = $pdf->output();
            $nameFile ='Certificado-destruccion-'.date('y-m-d-h-i-s').'.pdf';
            file_put_contents( public_path().'/pdfs/'.$nameFile, $output);

            // CREATE DOCUMENT DESTRUCTION
            $view2 =  \View::make('pdf.documentos-para-destruccion', compact('purchase', 'purchase_management'))->render(); // send data to view
            $pdf2 = \App::make('dompdf.wrapper');
            $pdf2->loadHTML($view2);

            $output2 = $pdf2->output();
            $nameFile2 ='Documento-para-destruccion-'.date('y-m-d-h-i-s').'.pdf';
            file_put_contents( public_path().'/pdfs/'.$nameFile2, $output2);

            //////////////////////////////////////////////////// 
            $url_pdf1 = "https://gestion-motos.motostion.com/local/public/pdfs/".$nameFile;
            $url_pdf2 = "https://gestion-motos.motostion.com/local/public/pdfs/".$nameFile2;

            $purchase = PurchaseValuation::find($purchase->id);
            $purchase->documents_destruction = "https://gestion-motos.motostion.com/local/public/pdfs/".$nameFile.","."https://gestion-motos.motostion.com/local/public/pdfs/".$nameFile2;  // DOCUMENT DECEASED HERE
            $purchase->update();

            send_document_desctruction($purchase_management, $url_pdf1, $url_pdf2);

            return Redirect::back()->with('notification', 'Se ha enviado los documentos para destrucción mediante Viafirma exitosamente!');
        }else
            return Redirect::to('/')->with('error', 'Ha ocurrido un error!');
    }

    // DESTRUCTION DECEASED
    public function send_destruction_deceased($id)
    {
        $purchase = PurchaseValuation::find($id);
        $purchase_management = PurchaseManagement::where('purchase_valuation_id', $purchase->id)->first();
       
        if(ApplySubProcessAndProcess::where('processes_id', 7)->where('subprocesses_id', 17)->where('purchase_valuation_id', $purchase->id)->count() > 0){

            // CREATE CERTIFICATE DESTRUCTION
            $view =  \View::make('pdf.certificado-destruccion', compact('purchase', 'purchase_management'))->render(); // send data to view
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);

            $output = $pdf->output();
            $nameFile ='Certificado-destruccion-'.date('y-m-d-h-i-s').'.pdf';
            file_put_contents( public_path().'/pdfs/'.$nameFile, $output);

            // CREATE DOCUMENT DESTRUCTION
            $view2 =  \View::make('pdf.documentos-para-destruccion', compact('purchase', 'purchase_management'))->render(); // send data to view
            $pdf2 = \App::make('dompdf.wrapper');
            $pdf2->loadHTML($view2);

            $output2 = $pdf2->output();
            $nameFile2 ='Documento-para-destruccion-'.date('y-m-d-h-i-s').'.pdf';
            file_put_contents( public_path().'/pdfs/'.$nameFile2, $output2);

            // CREATE DECLARATION DECEASED
            $view3 =  \View::make('pdf.declaracion-fallecido', compact('purchase', 'purchase_management'))->render(); // send data to view
            $pdf3 = \App::make('dompdf.wrapper');
            $pdf3->loadHTML($view3);

            $output3 = $pdf3->output();
            $nameFile3 ='Declaracion-responsable-fallecidos-'.date('y-m-d-h-i-s').'.pdf';
            file_put_contents( public_path().'/pdfs/'.$nameFile3, $output3);

            //////////////////////////////////////////////////// 
            $url_pdf1 = "https://gestion-motos.motostion.com/local/public/pdfs/".$nameFile;
            $url_pdf2 = "https://gestion-motos.motostion.com/local/public/pdfs/".$nameFile2;
            $url_pdf3 = "https://gestion-motos.motostion.com/local/public/pdfs/".$nameFile3;

            $purchase = PurchaseValuation::find($purchase->id);
            $purchase->destruction_deceased = "https://gestion-motos.motostion.com/local/public/pdfs/".$nameFile.","."https://gestion-motos.motostion.com/local/public/pdfs/".$nameFile2.","."https://gestion-motos.motostion.com/local/public/pdfs/".$nameFile3;  // DOCUMENT DECEASED HERE
            $purchase->update();

            send_destruction_deceased($purchase_management, $url_pdf1, $url_pdf2, $url_pdf3);

            return Redirect::back()->with('notification', 'Se ha enviado los documentos para destrucción con fallecido mediante Viafirma exitosamente!');
        }else
            return Redirect::to('/')->with('error', 'Ha ocurrido un error!');
    }

    // POSSIBLE SALE
    public function send_possible_sale($id)
    {
        $purchase = PurchaseValuation::find($id);
        $purchase_management = PurchaseManagement::where('purchase_valuation_id', $purchase->id)->first();
       
        if(ApplySubProcessAndProcess::where('processes_id', 7)->where('subprocesses_id', 17)->where('purchase_valuation_id', $purchase->id)->count() > 0){

            // CREATE CERTIFICATE DESTRUCTION
            $view =  \View::make('pdf.certificado-destruccion', compact('purchase', 'purchase_management'))->render(); // send data to view
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);

            $output = $pdf->output();
            $nameFile ='Certificado-destruccion-'.date('y-m-d-h-i-s').'.pdf';
            file_put_contents( public_path().'/pdfs/'.$nameFile, $output);

            // CREATE DOCUMENT DESTRUCTION
            $view2 =  \View::make('pdf.documentos-para-destruccion', compact('purchase', 'purchase_management'))->render(); // send data to view
            $pdf2 = \App::make('dompdf.wrapper');
            $pdf2->loadHTML($view2);

            $output2 = $pdf2->output();
            $nameFile2 ='Documento-para-destruccion-'.date('y-m-d-h-i-s').'.pdf';
            file_put_contents( public_path().'/pdfs/'.$nameFile2, $output2);

            // CREATE DOCUMENT SALE
            $view3 =  \View::make('pdf.documentos-para-venta', compact('purchase', 'purchase_management'))->render(); // send data to view
            $pdf3 = \App::make('dompdf.wrapper');
            $pdf3->loadHTML($view3);

            $output3 = $pdf3->output();
            $nameFile3 ='Documentos-venta-'.date('y-m-d-h-i-s').'.pdf';
            file_put_contents( public_path().'/pdfs/'.$nameFile3, $output3);

            //////////////////////////////////////////////////// 
            $url_pdf1 = "https://gestion-motos.motostion.com/local/public/pdfs/".$nameFile;
            $url_pdf2 = "https://gestion-motos.motostion.com/local/public/pdfs/".$nameFile2;
            $url_pdf3 = "https://gestion-motos.motostion.com/local/public/pdfs/".$nameFile3;

            $purchase = PurchaseValuation::find($purchase->id);
            $purchase->possible_sale = "https://gestion-motos.motostion.com/local/public/pdfs/".$nameFile.","."https://gestion-motos.motostion.com/local/public/pdfs/".$nameFile2.","."https://gestion-motos.motostion.com/local/public/pdfs/".$nameFile3;  // DOCUMENT DECEASED HERE
            $purchase->update();


            send_possible_sale($purchase_management, $url_pdf1, $url_pdf2, $url_pdf3);

            return Redirect::back()->with('notification', 'Se ha enviado los documentos para posible venta mediante Viafirma exitosamente!');
        }else
            return Redirect::to('/')->with('error', 'Ha ocurrido un error!');
    }

    // POSSIBLE SALE DECEASED
    public function send_sale_deceased($id)
    {
        $purchase = PurchaseValuation::find($id);
        $purchase_management = PurchaseManagement::where('purchase_valuation_id', $purchase->id)->first();
       
        if(ApplySubProcessAndProcess::where('processes_id', 7)->where('subprocesses_id', 17)->where('purchase_valuation_id', $purchase->id)->count() > 0){

            // CREATE CERTIFICATE DESTRUCTION
            $view =  \View::make('pdf.certificado-destruccion', compact('purchase', 'purchase_management'))->render(); // send data to view
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);

            $output = $pdf->output();
            $nameFile ='Certificado-destruccion-'.date('y-m-d-h-i-s').'.pdf';
            file_put_contents( public_path().'/pdfs/'.$nameFile, $output);

            // CREATE DOCUMENT DESTRUCTION
            $view2 =  \View::make('pdf.documentos-para-destruccion', compact('purchase', 'purchase_management'))->render(); // send data to view
            $pdf2 = \App::make('dompdf.wrapper');
            $pdf2->loadHTML($view2);

            $output2 = $pdf2->output();
            $nameFile2 ='Documento-para-destruccion-'.date('y-m-d-h-i-s').'.pdf';
            file_put_contents( public_path().'/pdfs/'.$nameFile2, $output2);

            // CREATE DOCUMENT SALE
            $view3 =  \View::make('pdf.documentos-para-venta', compact('purchase', 'purchase_management'))->render(); // send data to view
            $pdf3 = \App::make('dompdf.wrapper');
            $pdf3->loadHTML($view3);

            $output3 = $pdf3->output();
            $nameFile3 ='Documentos-venta-'.date('y-m-d-h-i-s').'.pdf';
            file_put_contents( public_path().'/pdfs/'.$nameFile3, $output3);

            // CREATE DECLARATION DECEASED
            $view4 =  \View::make('pdf.declaracion-fallecido', compact('purchase', 'purchase_management'))->render(); // send data to view
            $pdf4 = \App::make('dompdf.wrapper');
            $pdf4->loadHTML($view4);

            $output4 = $pdf4->output();
            $nameFile4 ='Declaracion-responsable-fallecidos-'.date('y-m-d-h-i-s').'.pdf';
            file_put_contents( public_path().'/pdfs/'.$nameFile4, $output4);


            //////////////////////////////////////////////////// 
            $url_pdf1 = "https://gestion-motos.motostion.com/local/public/pdfs/".$nameFile;
            $url_pdf2 = "https://gestion-motos.motostion.com/local/public/pdfs/".$nameFile2;
            $url_pdf3 = "https://gestion-motos.motostion.com/local/public/pdfs/".$nameFile3;
            $url_pdf4 = "https://gestion-motos.motostion.com/local/public/pdfs/".$nameFile4;

            $purchase = PurchaseValuation::find($purchase->id);
            $purchase->possible_sale_deceased = "https://gestion-motos.motostion.com/local/public/pdfs/".$nameFile.","."https://gestion-motos.motostion.com/local/public/pdfs/".$nameFile2.","."https://gestion-motos.motostion.com/local/public/pdfs/".$nameFile3.","."https://gestion-motos.motostion.com/local/public/pdfs/".$nameFile4;  // DOCUMENT DECEASED HERE
            $purchase->update();

            send_sale_deceased($purchase_management, $url_pdf1, $url_pdf2, $url_pdf3, $url_pdf4);

            return Redirect::back()->with('notification', 'Se ha enviado los documentos para posible venta fallecido mediante Viafirma exitosamente!');
        }else
            return Redirect::to('/')->with('error', 'Ha ocurrido un error!');
    }

    public function callback_document_viafirma()
    {
        // Proccessing the POST
        $raw = urldecode((file_get_contents('php://input')));
        $res = str_replace("message=", '', $raw);
        $json = json_decode($res);
        $messageCode = $json->code;

        $purchase = PurchaseValuation::where('deceased_document',$json->document->templateReference)->first();
        $purchase->deceased_code = $messageCode;
        $purchase->update();

        // if current status is RESPONSED, download the signed document
        if ($json->workflow->current === 'RESPONSED') {
            // Download URL 
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

            //  Initiate curl
            $ch = curl_init();
            // Disable SSL verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            // Will return the response, if false it print the response
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // Set the url
            curl_setopt($ch, CURLOPT_URL,$url);

            // OAuth Header
            $headr = array();
            $headr[] = 'Content-length: 0';
            //$headr[] = 'Content-Type: application/json';
            $headr[] = ''.$req->getAuthorizationHeader();
            curl_setopt($ch, CURLOPT_HTTPHEADER,$headr);

            // Execute
            $result=curl_exec($ch);
            $jsonRes = json_decode($result);

            // Put the file on the same folder
            file_put_contents($jsonRes->fileName, fopen($jsonRes->link, 'r'));
        }

    }

    public function buscador(Request $request){
        
        $input = $request->all();
        if($request->get('texto')){
            $motos = DB::table('purchase_valuation')
            ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
            ->select('purchase_valuation.*', 'purchase_management.status', 'purchase_management.frame_no', 'purchase_management.registration_number')            
            ->where('purchase_valuation.id', "LIKE", "%{$request->get('texto')}%")
            ->orWhere('purchase_valuation.phone', "LIKE", "%{$request->get('texto')}%")
            ->orWhere('purchase_valuation.email', "LIKE", "%{$request->get('texto')}%")
            ->orWhere('purchase_management.registration_number','like',$request->texto."%")
            ->orWhere('purchase_management.frame_no','like',$request->texto."%")     
            ->paginate(5);
            
            return view('backend.purchase_valuation.paginas',compact('motos'));  
        }
              
    }

    // SEND DOCUMENTS VIA EMAIL
    public function send_mail_document($id){
        $purchase = PurchaseValuation::find($id);
        $purchase_management = PurchaseManagement::where('purchase_valuation_id', $purchase->id)->first();

        if(ApplySubProcessAndProcess::where('processes_id', 7)->where('subprocesses_id', 17)->where('purchase_valuation_id', $purchase->id)->count() > 0){
            // CREATE PDF
            $view =  \View::make('pdf.ficha', compact('purchase', 'purchase_management'))->render(); // send data to view
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);

            $output = $pdf->output();
            $nameFile ='Ficha'.date('y-m-d-h-i-s').'.pdf';
            file_put_contents( public_path().'/pdfs/'.$nameFile, $output);

            Mail::send('backend.emails.send-document-firma', ['purchase' => $purchase], function ($message) use ($purchase, $nameFile)

                {
                    $message->from('info@motostion.com', 'MotOstion');

                    // SE ENVIARA A
                    $message->to($purchase->email)->subject('Documento a Firmar');

                    $message->attach(public_path().'/pdfs/'.$nameFile);
                }); 
            return Redirect::back()->with('notification', 'Registro Actualizado Exitosamente. Se ha enviado al correo el documento a firmar. <br> <a href="'.url('/local/public/pdfs/').'/'.$nameFile.'" target="_blank"> Descargar Ficha </a>');
        }else{
            return Redirect::back()->with('error', 'Ha ocurrido un error!');
        }
    }
}
