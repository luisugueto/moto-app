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

class PurchaseValuationController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => [
            'create', 'store'
        ]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $haspermision = getPermission('Motos que nos ofrecen', 'record-create');
        $states = States::all();
        $processes = Processes::all();
        $marcas = DB::connection('recambio_ps')->select("SELECT recambio_ps.ps_category.*,recambio_ps.ps_category_lang.name marca FROM recambio_ps.ps_category LEFT JOIN recambio_ps.ps_category_lang ON recambio_ps.ps_category.id_category=recambio_ps.ps_category_lang.id_category AND recambio_ps.ps_category_lang.id_lang='4' WHERE recambio_ps.ps_category.id_parent='13042' GROUP BY recambio_ps.ps_category_lang.name ORDER BY recambio_ps.ps_category_lang.name ASC");
   
        return view('backend.purchase_valuation.index', compact('states', 'processes', 'marcas', 'haspermision'));
    }

    public function getPurchaseValuations(Request $request)
    {
        $requestData = $request;

        $columns = array(
            // datatable column index  => database column name
            1 => 'id',
            2 => 'model',
            3 => 'year'
        );
        $sql = "SELECT * FROM purchase_valuation WHERE states_id = 1";
        if (!empty($requestData['search']['value'])) {
            // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql .= " AND (model LIKE '%" . $requestData['search']['value'] . "%'";
            $sql .= " OR year LIKE '%" . $requestData['search']['value'] . "%' )";
        }
	    
        $query = DB::connection('mysql')->select(DB::raw($sql));
        $totalData = count($query);
        $totalFiltered = count($query);

        $sql = "SELECT * FROM purchase_valuation WHERE states_id = 1";
        if (!empty($requestData['search']['value'])) {
            // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql .= " AND (model LIKE '%" . $requestData['search']['value'] . "%'";
            $sql .= " OR year LIKE '%" . $requestData['search']['value'] . "%' )";
        }

        $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";

        $query = DB::connection('mysql')->select(DB::raw($sql));          

        $view = getPermission('Motos que nos ofrecen', 'record-view');
        $edit = getPermission('Motos que nos ofrecen', 'record-edit');
        $delete = getPermission('Motos que nos ofrecen', 'record-delete');
        
        $data = array();
        foreach($query as $value){ 
            $nestedData = array();       

            if($edit == true){             
                $botones = "<a class='mb-2 mr-2 btn btn-warning text-white button_edit' title='Ficha Moto'> Editar</a>";
            }
            else {
                $botones = "No tienes permiso";
            }
            $nestedData[] ='<div class="custom-control custom-checkbox"><input type="checkbox" name="apply" id="apply-1_'.$value->id.'" value="'.$value->id.'" class="custom-control-input"><label class="custom-control-label" for="apply-1_'.$value->id.'"></label></div>';
            $nestedData[] = $value->id;
            $nestedData[] = $value->date;
            $nestedData[] = $value->brand;
            $nestedData[] = $value->model;
            $nestedData[] = $value->year;
            $nestedData[] = $value->km;
            $nestedData[] = $value->email .' <br>' . $value->phone;
            $nestedData[] = $value->name .' '. $value->lastname;
            $nestedData[] = $value->province;
            $nestedData[] = $value->status_trafic;
            $nestedData[] = $value->motocycle_state;
            $nestedData[] = $value->price_min;
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
                }else{
                    $botones = "<a class='mb-2 mr-2 btn btn-warning text-white button_ficha' title='Ficha Moto'> Editar</a>";
                }                
            }
            else {
                $botones = "No tienes permiso";
            }
            $nestedData[] ='<div class="custom-control custom-checkbox"><input type="checkbox" name="apply" id="apply-1_'.$value->id.'" value="'.$value->id.'" class="custom-control-input"><label class="custom-control-label" for="apply-1_'.$value->id.'"></label></div>';
            $nestedData[] = $value->id;
            $nestedData[] = $value->model;
            $nestedData[] = $value->year;
            $proceso = Processes::all();
            foreach($proceso as $pro){
                $apply = ApplySubProcessAndProcess::where('processes_id', $pro->id)->where('purchase_valuation_id', $value->id)->first();
                $subproceso = SubProcesses::where('id', $apply['subprocesses_id'])->first();
                $nestedData[]= $subproceso['name'];
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
            $nestedData[] = $value->id;
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
            $nestedData[] = $value->id;
            $nestedData[] = $value->model;
            $nestedData[] = $value->year;
            $proceso = Processes::all();
            foreach($proceso as $pro){
                $apply = ApplySubProcessAndProcess::where('processes_id', $pro->id)->where('purchase_valuation_id', $value->id)->first();
                $subproceso = SubProcesses::where('id', $apply['subprocesses_id'])->first();
                if($pro['name'] == 'Bastidor'){
                    $subprocesoN = '<span class="text-danger">'.$subproceso['name'].'</span>';
                }else{
                    $subprocesoN = '<span>'.$subproceso['name'].'</span>';
                }
                $nestedData[]= $subprocesoN;
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
            $nestedData[] = $value->id;
            $nestedData[] = $value->model;
            $nestedData[] = $value->year;
            $proceso = Processes::all();
            foreach($proceso as $pro){
                $apply = ApplySubProcessAndProcess::where('processes_id', $pro->id)->where('purchase_valuation_id', $value->id)->first();
                $subproceso = SubProcesses::where('id', $apply['subprocesses_id'])->first();
                $nestedData[]= $subproceso['name'];
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
        ->select('purchase_valuation.*', 'purchase_management.status')
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
            $nestedData[] = $value->id;
            $nestedData[] = $value->model;
            $nestedData[] = $value->year;
            $proceso = Processes::all();
            foreach($proceso as $pro){
                $apply = ApplySubProcessAndProcess::where('processes_id', $pro->id)->where('purchase_valuation_id', $value->id)->first();
                $subproceso = SubProcesses::where('id', $apply['subprocesses_id'])->first();
                $nestedData[]= $subproceso['name'];
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
            $nestedData[] = $value->id;
            $nestedData[] = $value->model;
            $nestedData[] = $value->year;
            $proceso = Processes::all();
            foreach($proceso as $pro){
                $apply = ApplySubProcessAndProcess::where('processes_id', $pro->id)->where('purchase_valuation_id', $value->id)->first();
                $subproceso = SubProcesses::where('id', $apply['subprocesses_id'])->first();
                if($pro['name'] == 'Bastidor'){
                    $subprocesoN = '<span class="text-danger">'.$subproceso['name'].'</span>';
                }else{
                    $subprocesoN = '<span>'.$subproceso['name'].'</span>';
                }
                $nestedData[]= $subprocesoN;
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
        ->select('purchase_valuation.*', 'purchase_management.status')
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
            $nestedData[] = $value->id;
            $nestedData[] = $value->model;
            $nestedData[] = $value->year;
            $proceso = Processes::all();
            foreach($proceso as $pro){
                $apply = ApplySubProcessAndProcess::where('processes_id', $pro->id)->where('purchase_valuation_id', $value->id)->first();
                $subproceso = SubProcesses::where('id', $apply['subprocesses_id'])->first();
                $nestedData[]= $subproceso['name'];
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
        ->select('purchase_valuation.*', 'purchase_management.status')
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
            $nestedData[] = $value->id;
            $nestedData[] = $value->model;
            $nestedData[] = $value->year;
            $proceso = Processes::all();
            foreach($proceso as $pro){
                $apply = ApplySubProcessAndProcess::where('processes_id', $pro->id)->where('purchase_valuation_id', $value->id)->first();
                $subproceso = SubProcesses::where('id', $apply['subprocesses_id'])->first();
                $nestedData[]= $subproceso['name'];
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
            $nestedData[] = $value->id;
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
        // dd($request->all());
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
            // Storage::disk('images_purchase')->put($fileNameToStore,  \File::get($file));

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
        // return Redirect::to('/motos-que-nos-ofrecen')->with('notification', 'Tasación creada exitosamente!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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

        // check last process and delete
        $lastProcessApply = ApplySubProcessAndProcess::where('processes_id', $processes->id)->where('purchase_valuation_id', $purchase->id)->first();
        $countLastProcessApply = ApplySubProcessAndProcess::where('processes_id', $processes->id)->where('purchase_valuation_id', $purchase->id)->count();         
        
        if($countLastProcessApply > 0){            
            ApplySubProcessAndProcess::destroy($lastProcessApply->id);
        }

        $apply = new ApplySubProcessAndProcess();
        $apply->processes_id = $processes->id;
        $apply->subprocesses_id = $subprocesses->id;
        $apply->purchase_valuation_id = $purchase->id;
        $apply->save();
    
        if(!empty($subprocesses->business_id) && $processes->id = 12){
            $state = [];
            $token = '';
            $business = Business::find($subprocesses->business_id);

            
            Mail::send('backend.emails.business', ['purchase' => $purchase, 'subprocesses' => $subprocesses, 'state' => $state, 'token' => $token, 'business' => $business], function ($message) use ($subprocesses, $business)
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
        $data = $request->id;
       
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
        $states = States::all();
        $processes = Processes::all();
        $marcas = DB::connection('recambio_ps')->select("SELECT recambio_ps.ps_category.*,recambio_ps.ps_category_lang.name marca FROM recambio_ps.ps_category LEFT JOIN recambio_ps.ps_category_lang ON recambio_ps.ps_category.id_category=recambio_ps.ps_category_lang.id_category AND recambio_ps.ps_category_lang.id_lang='4' WHERE recambio_ps.ps_category.id_parent='13042' GROUP BY recambio_ps.ps_category_lang.name ORDER BY recambio_ps.ps_category_lang.name ASC");   

        return view('backend.purchase_valuation.ficha', compact('states', 'processes', 'marcas'));

    }

    public function getDataFicha($id)
    {
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
        foreach ($apply as $key => $value) {
            $process = Processes::find($value->processes_id);
            $subprocesses = SubProcesses::find($value->subprocesses_id);
            array_push($processes, ['name' => $process->name, 'subproceso' => $subprocesses->name]);
        }
        
        $data['id'] = $purchase_valuation['id'];
        $data['date'] = $purchase_valuation['date'];
        $data['brand'] = $purchase_valuation['brand'];
        $data['model'] = $purchase_valuation['model'];
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
        $data['vehicle_state_trafic'] = $purchase_management['vehicle_state_trafic'];
        $data['vehicle_state'] = $purchase_management['vehicle_state'];

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
        
        $data['link'] = url('/');
 
        return response()->json($data);

    }

    public function updateFicha(Request $request)
    {
        
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
        $purchase->update();

        if($request->documents_attached == 'on'){
            $documents_attached = 1;
        }
        if($request->non_existence_document == 'on'){
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
        $purchase_management->phone = $request->phone_management;
        $purchase_management->email = $request->email_management;
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
        $purchase_management->model = $request->model_management;
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
        $purchase_management->vehicle_state_trafic = $request->vehicle_state_trafic;
        $purchase_management->vehicle_state = $request->vehicle_state;
        $purchase_management->datos_del_mecanico = $request->datos_del_mecanico;
        $purchase_management->datos_internos = $request->datos_internos;
        $purchase_management->update();

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

            $out['message'] = 'Registro Actualizado Exitosamente. Se ha enviado al correo el documento a firmar. <br> <a href="'.url('/local/public/pdfs/').'/'.$nameFile.'" target="_blank"> Descargar Ficha </a>';
        }else{
            $out['message'] = 'Registro Actualizado Exitosamente.';
        }

    
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
        $user = PurchaseValuation::findOrFail($request->id);
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
        $purchase = PurchaseManagement::where('purchase_valuation_id', $request->id)->first();
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
}
