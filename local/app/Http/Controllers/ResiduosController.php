<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;
use App\Http\Requests;
use App\PurchaseManagement;
use App\PurchaseValuation;
use App\Processes;
use App\SubProcesses;
use App\ApplySubProcessAndProcess;
use App\Materials;
use App\MaterialsCompanie;
use DB;
use Redirect;
use App\Residuos;
use App\CertificatesPurchaseValuation;
use Chumper\Zipper\Zipper;

class ResiduosController extends Controller
{

    public function enviosQuincenales()
    {
        $view = getPermission('Envíos Quincenales', 'record-view');

        if(!$view) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $subprocesses = SubProcesses::where('processes_id' , '=', 5)->get();
        return view ('backend.residuos.envios_quincenales', compact('subprocesses'));

    }

    public function getEnviosQuincenalesSinDescargar(Request $request)
    {
        $view = getPermission('Envíos Quincenales', 'record-view');

        if(!$view) return Redirect::to('/')->with('error', 'Usted no posee permisos!');
         
        if($request->from != '' && $request->to != ''){
            $purchases = DB::table('purchase_valuation AS pv')
            ->leftjoin('purchase_management AS pm', 'pm.purchase_valuation_id', '=', 'pv.id')
            ->join('apply_sub_process_and_processes AS apply', 'apply.purchase_valuation_id', '=' ,'pv.id')
            ->select('pv.id AS id_pv', 'pv.model AS model1','pv.name AS pvname', 'pv.lastname', 'pv.status_trafic', 'pm.*', 'apply.processes_id', 'apply.subprocesses_id', 'apply.created_at AS destruction_date')
            ->where('apply.processes_id', '=', 5)
            ->where('apply.subprocesses_id', '=', 5)
            ->where('pm.status', '=', 2)
            ->where('pm.download_certificate', '=', 0)
            ->whereDate('apply.created_at', '>=', $request->from)->whereDate('apply.created_at', '<=', $request->to)
            ->get();
        }else{
            $purchases = DB::table('purchase_valuation AS pv')
            ->leftjoin('purchase_management AS pm', 'pm.purchase_valuation_id', '=', 'pv.id')
            ->join('apply_sub_process_and_processes AS apply', 'apply.purchase_valuation_id', '=' ,'pv.id')
            ->select('pv.id AS id_pv', 'pv.model AS model1','pv.name AS pvname', 'pv.lastname', 'pv.status_trafic', 'pm.*', 'apply.processes_id', 'apply.subprocesses_id', 'apply.created_at AS destruction_date')
            ->where('apply.processes_id', '=', 5)
            ->where('apply.subprocesses_id', '=', 5)
            ->where('pm.status', '=', 2)
            ->where('pm.download_certificate', '=', 0)
            ->get();
        }
        
        
        $view = getPermission('Envíos Quincenales', 'record-view');
        $edit = getPermission('Envíos Quincenales', 'record-edit');
        $delete = getPermission('Envíos Quincenales', 'record-delete');

        $data = array();
        foreach($purchases as $value){

            $apply = ApplySubProcessAndProcess::where('purchase_valuation_id', $value->id_pv)
            ->where('processes_id', '=', 11)
            ->where('subprocesses_id', '=', 32)
            ->get();

            $row = array();
            $row['id'] = $value->id_pv;
            $row['model'] = $value->model1;
            $row['registration_number'] = $value->registration_number;
            $row['registration_date'] = $value->registration_date;
            $row['frame_no'] = $value->frame_no;
            $row['vehicle_state_trafic'] = $value->vehicle_state_trafic;
            $row['weight'] = round($value->weight, 2);
            $row['titular'] = $value->pvname. ' '. $value->lastname;
            $row['dni'] = $value->dni;
            $row['birthdate'] = $value->birthdate;
            $row['direction'] = $value->street.' '. $value->nro_street;
            $row['postal_code'] = $value->postal_code;
            $row['municipality'] = $value->municipality;
            $row['province'] = $value->province;
            $row['vehicle_state'] = $value->status_trafic;
            $row['current_year'] = date('d-m-Y', strtotime($value->destruction_date));
            $row['certificate_destruction_date'] = date('d-m-Y', strtotime($value->destruction_date));
            $row['collection_contract_date'] = '';
            foreach($apply as $key){
                $row['collection_contract_date'] = date('d-m-Y', strtotime($key->created_at));
            }
            $row['edit'] = $edit;
            $row['delete'] = $delete;
            $data[] = $row;
        }

        $json_data = array('data'=> $data);
        $json_data= collect($json_data);

        return response()->json($json_data);
    }

    public function getEnviosQuincenalesDescargados()
    {
        $view = getPermission('Envíos Quincenales', 'record-view');

        if(!$view) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $purchases = DB::table('purchase_valuation AS pv')
        ->leftjoin('purchase_management AS pm', 'pm.purchase_valuation_id', '=', 'pv.id')
        ->join('apply_sub_process_and_processes AS apply', 'apply.purchase_valuation_id', '=' ,'pv.id')
        ->select('pv.id AS id_pv', 'pv.model AS model1','pv.name AS pvname', 'pv.lastname', 'pv.status_trafic', 'pm.*', 'apply.processes_id', 'apply.subprocesses_id', 'apply.created_at AS destruction_date')
        ->where('apply.processes_id', '=', 5)
        ->where('apply.subprocesses_id', '=', 5)
        ->where('pm.status', '=', 2)
        ->where('pm.download_certificate', '=', 1)
        ->get();
        // dd($purchases);
        $view = getPermission('Envíos Quincenales', 'record-view');
        $edit = getPermission('Envíos Quincenales', 'record-edit');
        $delete = getPermission('Envíos Quincenales', 'record-delete');

        $data = array();
        foreach($purchases as $value){

            $apply = ApplySubProcessAndProcess::where('purchase_valuation_id', $value->id_pv)
            ->where('processes_id', '=', 11)
            ->where('subprocesses_id', '=', 32)
            ->get();

            $row = array();
            $row['id'] = $value->id_pv;
            $row['model'] = $value->model1;
            $row['registration_number'] = $value->registration_number;
            $row['registration_date'] = $value->registration_date;
            $row['frame_no'] = $value->frame_no;
            $row['vehicle_state_trafic'] = $value->vehicle_state_trafic;
            $row['weight'] = round($value->weight, 2);
            $row['titular'] = $value->pvname. ' '. $value->lastname;
            $row['dni'] = $value->dni;
            $row['birthdate'] = $value->birthdate;
            $row['direction'] = $value->street.' '. $value->nro_street;
            $row['postal_code'] = $value->postal_code;
            $row['municipality'] = $value->municipality;
            $row['province'] = $value->province;
            $row['vehicle_state'] = $value->status_trafic;
            $row['current_year'] = date('d-m-Y', strtotime($value->destruction_date));
            $row['certificate_destruction_date'] = date('d-m-Y', strtotime($value->destruction_date));
            $row['collection_contract_date'] = '';
            foreach($apply as $key){
                $row['collection_contract_date'] = date('d-m-Y', strtotime($key->created_at));
            }
            $row['edit'] = $edit;
            $row['delete'] = $delete;
            $data[] = $row;
        }

        $json_data = array('data'=> $data);
        $json_data= collect($json_data);

        return response()->json($json_data);
    }

    public function exportEnviosQuincenalesSinDescargar(Request $request){
        $view = getPermission('Envíos Quincenales', 'record-view');
        $create = getPermission('Envíos Quincenales', 'record-create');

        if(!$view || !$create) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $validator = \Validator::make($request->all(),[
            'start_at' => 'required|date|date_format:Y-m-d',
            'end_at' => 'required|date|date_format:Y-m-d'
        ]);  

        if ($validator->fails()) {
            return Redirect::back()->with('error', 'Ha ocurrido un error!')->withInput();
        }

        if(strtotime($request->start_at) <= strtotime($request->end_at)){}
        else{
            return Redirect::back()->with('error', 'La fecha "Desde" tiene que ser menor que la fecha "Hasta"!')->withInput();
        }

        if(!empty($request->apply)){
            $apply = array();
            foreach(explode(",", $request->apply) as $id) array_push($apply, $id);

            $data = DB::table('purchase_valuation AS pv')
            ->leftjoin('purchase_management AS pm', 'pm.purchase_valuation_id', '=', 'pv.id')
            ->join('apply_sub_process_and_processes AS apply', 'apply.purchase_valuation_id', '=' ,'pv.id')
            ->select('pv.id AS id_pv', 'pv.model AS model1','pv.name AS pvname', 'pv.lastname', 'pv.status_trafic', 'pm.*', 'apply.processes_id', 'apply.subprocesses_id', 'apply.created_at AS destruction_date')
            ->where('apply.processes_id', '=', 5)
            ->where('apply.subprocesses_id', '=', 5)
            ->where('pm.status', '=', 2)
            ->where('pm.download_certificate', '=', 0)
            ->whereDate('apply.created_at', '>=', $request->start_at)->whereDate('apply.created_at', '<=', $request->end_at)
            ->whereIn('pv.id', $apply)
            ->get();   
        }else{
            $data = DB::table('purchase_valuation AS pv')
            ->leftjoin('purchase_management AS pm', 'pm.purchase_valuation_id', '=', 'pv.id')
            ->join('apply_sub_process_and_processes AS apply', 'apply.purchase_valuation_id', '=' ,'pv.id')
            ->select('pv.id AS id_pv', 'pv.model AS model1','pv.name AS pvname', 'pv.lastname', 'pv.status_trafic', 'pm.*', 'apply.processes_id', 'apply.subprocesses_id', 'apply.created_at AS destruction_date')
            ->where('apply.processes_id', '=', 5)
            ->where('apply.subprocesses_id', '=', 5)
            ->where('pm.status', '=', 2)
            ->where('pm.download_certificate', '=', 0)
            ->whereDate('apply.created_at', '>=', $request->start_at)->whereDate('apply.created_at', '<=', $request->end_at)
            ->get();   
        }

        $apply = ApplySubProcessAndProcess::where('processes_id', '=', 11)
        ->where('subprocesses_id', '=', 32)
        ->get();
        
        if(is_array($data)){     
            
            Excel::create('LISTADO DE CERT DE DESTRUCCION QUINCENA', function($excel) use($data, $apply) {

                $excel->sheet('Hoja1', function($sheet) use($data, $apply) {

                    // $sheet->fromArray($data);
                    $sheet->loadView('excel.envios_quincenal', array('data' => $data, 'apply' => $apply));
                });

            })->export('xlsx');

        }else{
            return Redirect::back()->with('error', 'No hay datos disponibles!');
        }

    }


    public function exportEnviosQuincenalesDescargados(Request $request){
        $view = getPermission('Envíos Quincenales', 'record-view');
        $create = getPermission('Envíos Quincenales', 'record-create');

        if(!$view || !$create) {
            return Redirect::to('/home')->with('error', 'Usted no posee permisos!');
        }
        else{

            $validator = \Validator::make($request->all(),[
                'start_at' => 'required|date|date_format:Y-m-d',
                'end_at' => 'required|date|date_format:Y-m-d'
            ]);  

            if ($validator->fails()) {
                return Redirect::back()->with('error', 'Ha ocurrido un error!')->withInput();
            }

            if(strtotime($request->start_at) <= strtotime($request->end_at)){}
            else{
                return Redirect::back()->with('error', 'La fecha "Desde" tiene que ser menor que la fecha "Hasta"!')->withInput();
            }

            if(!empty($request->apply)){
                $apply = array();
                foreach(explode(",", $request->apply) as $id) array_push($apply, $id);

                $data = DB::table('purchase_valuation AS pv')
                ->leftjoin('purchase_management AS pm', 'pm.purchase_valuation_id', '=', 'pv.id')
                ->join('apply_sub_process_and_processes AS apply', 'apply.purchase_valuation_id', '=' ,'pv.id')
                ->select('pv.id AS id_pv', 'pv.model AS model1','pv.name AS pvname', 'pv.lastname', 'pv.status_trafic', 'pm.*', 'apply.processes_id', 'apply.subprocesses_id', 'apply.created_at AS destruction_date')
                ->where('apply.processes_id', '=', 5)
                ->where('apply.subprocesses_id', '=', 5)
                ->where('pm.status', '=', 2)
                ->where('pm.download_certificate', '=', 1)
                ->where('apply.created_at', '>=', $request->start_at)->where('apply.created_at', '<=', $request->end_at)
                ->whereIn('pv.id', $apply)
                ->get();  
            }else{
                $data = DB::table('purchase_valuation AS pv')
                ->leftjoin('purchase_management AS pm', 'pm.purchase_valuation_id', '=', 'pv.id')
                ->join('apply_sub_process_and_processes AS apply', 'apply.purchase_valuation_id', '=' ,'pv.id')
                ->select('pv.id AS id_pv', 'pv.model AS model1','pv.name AS pvname', 'pv.lastname', 'pv.status_trafic', 'pm.*', 'apply.processes_id', 'apply.subprocesses_id', 'apply.created_at AS destruction_date')
                ->where('apply.processes_id', '=', 5)
                ->where('apply.subprocesses_id', '=', 5)
                ->where('pm.status', '=', 2)
                ->where('pm.download_certificate', '=', 1)
                ->where('apply.created_at', '>=', $request->start_at)->where('apply.created_at', '<=', $request->end_at)
                ->get();  
            }
           
            $apply = ApplySubProcessAndProcess::where('processes_id', '=', 11)
            ->where('subprocesses_id', '=', 32)
            ->get();
 
            if(is_array($data)){     

                Excel::create('LISTADO DE CERT DE DESTRUCCION QUINCENA', function($excel) use($data, $apply) {

                    $excel->sheet('Hoja1', function($sheet) use($data, $apply) {

                        // $sheet->fromArray($data);
                        $sheet->loadView('excel.envios_quincenal', array('data' => $data, 'apply' => $apply));
                    });

                })->export('xlsx');
            }else{
                return Redirect::back()->with('error', 'No hay datos disponibles!');
            }
        }
    }

    //////
    public function enviosSemestrales()
    {
        $view = getPermission('Envíos Semestrales', 'record-view');

        if(!$view) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        return view ('backend.residuos.envios_semestrales');

    }

    public function getEnviosSemestrales()
    {
        $view = getPermission('Envíos Semestrales', 'record-view');

        if(!$view) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $residuos = DB::table('residuos AS r')
        ->leftjoin('materials_companies AS mc', 'mc.id', '=', 'r.id_materials')
        ->join('materials AS m', 'm.id', '=', 'mc.materials_id')
        ->join('waste_companies AS wc', 'wc.id', '=', 'mc.waste_companies_id')
        ->select('r.id AS id_r', 'r.delivery','r.in_installation', 'r.dcs', 'r.withdrawal_date', 'r.created_at', 'm.description AS material', 'wc.name AS companie', 'm.LER', 'm.type')
        // ->toSql();
        ->get();

        $retirados = array();
        foreach($residuos as $residuo){
            array_push($retirados, [
                'id' => $residuo->id_r,
                'type_proccess' => $residuo->type,
                'LER' => $residuo->LER,
                'material' => $residuo->material,
                'companie' => $residuo->companie,
                'delivery' => $residuo->delivery,
                'in_installation' => $residuo->in_installation,
                'dcs' => $residuo->dcs,
                'withdrawal_date' => date('d-m-Y', strtotime($residuo->withdrawal_date)),
                'created_at' => date('d-m-Y', strtotime($residuo->created_at)),
            ]);
        }

        $json_data = array('data'=> $retirados);
        $json_data= collect($json_data);

        return response()->json($json_data);
    }

    public function applySubProcesses(Request $request)
    {
        $view = getPermission('Envíos Quincenales', 'record-view');
        $edit = getPermission('Envíos Quincenales', 'record-edit');
        // dd($view,$edit);exit;
        if(!$view || !$edit) {
            return Redirect::to('/home')->with('error', 'Usted no posee permisos!');
        }else{

            $motos = explode(",", $request->apply);

            $out['code'] = 204;
            $out['message'] = 'Hubo un error';

            foreach($motos as $purchase) {
                // $subprocesses = SubProcesses::find($request->applySubProcesses);
                $purchase = PurchaseValuation::find($purchase);
                $purchase_management = PurchaseManagement::where('purchase_valuation_id', $purchase->id)->first();
                // check last process and delete
                $lastProcessApply = ApplySubProcessAndProcess::where('processes_id', 5)->where('purchase_valuation_id', $purchase->id)->first();
                $countLastProcessApply = ApplySubProcessAndProcess::where('processes_id', 5)->where('purchase_valuation_id', $purchase->id)->count();

                if($countLastProcessApply > 0)
                    $purchase_management->download_certificate = $request->applySubProcesses;
                    $purchase_management->update();

            }

            $out['code'] = 200;
            $out['data'] = $purchase;
            $out['message'] = 'Se ha aplicado el proceso Exitosamente';

            return response()->json($out);
            }

        
        
    }

    //Retiro de Residuos
    public function retiroResiduos()
    {
        $view = getPermission('Retiro de Residuos', 'record-view');

        if(!$view) return Redirect::to('/')->with('error', 'Usted no posee permisos!');
        return view ('backend.residuos.retiro');

    }

    public function getResiduos()
    {
        $view = getPermission('Residuos', 'record-view');
        if(!$view) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $materialsCompanie = array();
        $materials = MaterialsCompanie::all();

        foreach($materials as $material){
            array_push($materialsCompanie, ['id' => $material->id, 'name' => $material->material->description, 'business' => $material->waste_companie->name]);
        }
        //dd($materialsCompanie);
        $json_data = array('data'=> $materialsCompanie);
        $json_data= collect($json_data);

        return response()->json($json_data);

        // return Datatables::of($json_data)
        //     ->make(true);
    }

    public function retirarResiduos(Request $request){
        $create = getPermission('Residuos', 'record-create');
        if(!$create) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $out['code'] = 204;
        $out['message'] = 'Hubo un error';

        $residuo = new Residuos();
        $residuo->id_materials = $request->id_material;
        $residuo->delivery = $request->entrega;
        $residuo->in_installation = $request->en_instalaciones;
        $residuo->dcs = $request->dcs;
        $residuo->withdrawal_date = $request->fecha_retirada;
        $residuo->save();

        $out['code'] = 200;
        $out['data'] = $request->all();
        $out['message'] = 'Se ha retirado el residuo Exitosamente';

        return response()->json($out);
    }

    public function retirarVariosResiduos(Request $request){
        $create = getPermission('Residuos', 'record-create');
        if(!$create) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $out['code'] = 204;
        $out['message'] = 'Hubo un error';

        foreach($request->material as $key => $material){
            $residuo = new Residuos();
            $residuo->id_materials = $material;
            $residuo->delivery = $request->entrega[$key];
            $residuo->in_installation = $request->en_instalaciones[$key];
            $residuo->dcs = $request->dcs[$key];
            $residuo->withdrawal_date = $request->fecha_retirada[$key];
            $residuo->save();
        }

        $out['code'] = 200;
        $out['data'] = $request->all();
        $out['message'] = 'Se han retirado los residuos Exitosamente';

        return response()->json($out);
    }

    public function getResiduosRetirados()
    {
        $view = getPermission('Retiro de Residuos', 'record-view');

        if(!$view) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $residuos = DB::table('residuos AS r')
        ->leftjoin('materials_companies AS mc', 'mc.id', '=', 'r.id_materials')
        ->join('materials AS m', 'm.id', '=', 'mc.materials_id')
        ->join('waste_companies AS wc', 'wc.id', '=', 'mc.waste_companies_id')
        ->select('r.id AS id_r', 'r.delivery','r.in_installation', 'r.dcs', 'r.withdrawal_date', 'r.created_at', 'm.description AS material', 'wc.name AS companie')
        // ->toSql();
        ->get();

        $edit = getPermission('Retiro de Residuos', 'record-edit');
        $delete = getPermission('Retiro de Residuos', 'record-delete');

        $retirados = array();
        foreach($residuos as $residuo){
            array_push($retirados, [
                'id' => $residuo->id_r,
                'material' => $residuo->material,
                'companie' => $residuo->companie,
                'delivery' => $residuo->delivery,
                'in_installation' => $residuo->in_installation,
                'dcs' => $residuo->dcs,
                'withdrawal_date' => date('d-m-Y', strtotime($residuo->withdrawal_date)),
                'created_at' => date('d-m-Y', strtotime($residuo->created_at)),
                'edit' => $edit,
                'delete' => $delete,
            ]);
        }

        $json_data = array('data'=> $retirados);
        $json_data= collect($json_data);

        return response()->json($json_data);

    }

    public function editResiduo($id)
    {
        $edit = getPermission('Residuos', 'record-edit');
        if(!$edit) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $residuos = Residuos::find($id);
        return response()->json($residuos);
    }

    public function editarResiduo(Request $request)
    {
        $edit = getPermission('Residuos', 'record-edit');
        if(!$edit) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $residuos = Residuos::find($request->id);
        $residuos->update($request->all());

        $out['code'] = 200;
        $out['data'] = $request->all();
        $out['message'] = 'Se ha editado el residuo exitosamente!';

        return response()->json($out);
    }

    public function applyInf(Request $request)
    {
        // $validator = \Validator::make($request->all(),[
        //     'applyInf' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return Redirect::back()->with('error', 'Por favor seleccione un tipo de informe!')->withInput();
        // }
        $view = getPermission('Envíos Semestrales', 'record-view');
        $create = getPermission('Envíos Semestrales', 'record-create');

        if(!$view || !$create) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $validator = \Validator::make($request->all(),[
            'start_at' => 'required|date|date_format:Y-m-d',
            'end_at' => 'required|date|date_format:Y-m-d'
        ]);  

        if ($validator->fails()) {
            return Redirect::back()->with('error', 'Ha ocurrido un error!')->withInput();
        }

        if(strtotime($request->start_at) <= strtotime($request->end_at)){}
        else{
            return Redirect::back()->with('error', 'La fecha "Desde" tiene que ser menor que la fecha "Hasta"!')->withInput();
        }

        $arrayNp1 = array();
        $arrayNp2 = array();
        $arrayNp3 = array();
        $arrayReu = array();

        $data = Residuos::where('withdrawal_date', '>=', $request->start_at)->where('withdrawal_date', '<=', $request->end_at)->groupBy('id_materials')
            ->selectRaw('*, sum(delivery) as sum')
            ->get();

        $purchases = DB::table('purchase_valuation AS pv')
            ->leftjoin('purchase_management AS pm', 'pm.purchase_valuation_id', '=', 'pv.id')
            ->join('apply_sub_process_and_processes AS apply', 'apply.purchase_valuation_id', '=' ,'pv.id')
            ->select('pv.id AS id_pv', 'pv.model AS model1','pv.name AS pvname', 'pv.lastname', 'pv.status_trafic', 'pm.*', 'apply.processes_id', 'apply.subprocesses_id', 'apply.created_at AS destruction_date')
            ->where('apply.processes_id', '=', 5)
            ->where('apply.subprocesses_id', '=', 5)
            ->where('pm.status', '=', 2)
            ->where('pm.download_certificate', '=', 1)
            ->where('apply.created_at', '>=', $request->start_at)
            ->where('apply.created_at', '<=', $request->end_at)
            ->get();
            
        $idReutilizacion = [12, 13, 14, 15, 16];
        $materialReutilizacion = Materials::whereIn('id', $idReutilizacion)->get();

        foreach($data as $residuos){
            if(($residuos->materialC != null) && (strpos($residuos->materialC->material->type, 'NP1') !== false))
                array_push($arrayNp1, $residuos);
            if(($residuos->materialC != null) && (strpos($residuos->materialC->material->type, 'NP2') !== false))
                array_push($arrayNp2, $residuos);
            if(($residuos->materialC != null) && (strpos($residuos->materialC->material->type, 'NP3') !== false))
                array_push($arrayNp3, $residuos);
            /*if(($residuos->materialC != null) && (strpos($residuos->materialC->material->type, 'Reutilizacion') !== false))
                array_push($arrayReu, $residuos); */
        }

        Excel::create('BALANCE SEMESTRAL 2021', function($excel) use($arrayNp1, $arrayNp2, $arrayNp3, $materialReutilizacion, $purchases) {

            $excel->sheet('PROCESO NP1', function($sheet) use($arrayNp1, $purchases) {

                $sheet->loadView('excel.proceso_np1', array('data' => $arrayNp1, 'purchases' => $purchases));

            });

            $excel->sheet('PROCESO NP2', function($sheet) use($arrayNp1, $arrayNp2, $purchases) {

                $sheet->loadView('excel.proceso_np2', array('data' => $arrayNp2, 'np1' => $arrayNp1,'purchases' => $purchases));

            });

            $excel->sheet('PROCESO NP3', function($sheet) use($arrayNp3, $purchases) {

                $sheet->loadView('excel.proceso_np3', array('data' => $arrayNp3, 'purchases' => $purchases));

            });

            $excel->sheet('PROCESO DE REUTILIZACIÓN', function($sheet) use($materialReutilizacion, $purchases, $arrayNp1, $arrayNp2, $arrayNp3) {

                $sheet->loadView('excel.proceso_reutilizacion', array('data' => $materialReutilizacion, 'purchases' => $purchases, 'np1' => $arrayNp1, 'np2' => $arrayNp2, 'np3' => $arrayNp3));

            });

        })->download('xlsx');
    }

     //EXCELS

     public function balanceSemestral()
     {
        $create = getPermission('Envíos Semestrales', 'record-create');

        if(!$create) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

         $data = Residuos::where('created_at', '>=', '2021-08-16')->where('created_at', '<=', '2021-08-26')->get();

         Excel::create('BALANCE SEMESTRAL 2021', function($excel) use($data) {

             $excel->sheet('PROCESO NP1', function($sheet) use($data) {

                 $sheet->loadView('excel.proceso_np1', array('data' => $data));

             });

             $excel->sheet('PROCESO NP2', function($sheet) use($data) {

                 $sheet->loadView('excel.proceso_np2', array('data' => $data));

             });

             $excel->sheet('PROCESO NP3', function($sheet) use($data) {

                 $sheet->loadView('excel.proceso_np3', array('data' => $data));

             });

             $excel->sheet('PROCESO DE REUTILIZACIÓN', function($sheet) use($data) {

                 $sheet->loadView('excel.proceso_reutilizacion', array('data' => $data));

             });

         })->download('xlsx');
    }

    public function enviosChatarra()
    {
        $view = getPermission('Envíos Chatarra', 'record-view');
        if(!$view) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        return view ('backend.residuos.envios_chatarra');
    }

    public function getEnviosChatarraAluminio()
    {
        $view = getPermission('Envíos Chatarra', 'record-view');
        if(!$view) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $purchases = DB::table('purchase_valuation AS pv')
        ->leftjoin('purchase_management AS pm', 'pm.purchase_valuation_id', '=', 'pv.id')
        ->join('apply_sub_process_and_processes AS apply', 'apply.purchase_valuation_id', '=' ,'pv.id')
        ->select('pv.id AS id_pv', 'pv.model AS model1', 'pm.*', 'apply.processes_id', 'apply.subprocesses_id')
        ->where('apply.processes_id', '=', 5)
        ->where('apply.subprocesses_id', '=', 5)
        ->where('pv.states_id', '!=', 10)
        ->where('pm.check_chasis', '=', 'Aluminio')
        ->where('pm.send_date_chatarra', '=', 0)

        ->get();
        //dd($purchases);
        $view = getPermission('Envíos Chatarra', 'record-view');
        $edit = getPermission('Envíos Chatarra', 'record-edit');
        $delete = getPermission('Envíos Chatarra', 'record-delete');

        $data = array();
        foreach($purchases as $value){
            $row = array();
            $row['id'] = 'L'.$value->id_pv;
            $row['frame_no'] = $value->frame_no;
            $row['model'] = $value->model1;            
            $row['registration_number'] = $value->registration_number;
            $row['registration_date'] = $value->registration_date;
            
            $data[] = $row;
        }

        $json_data = array('data'=> $data);
        $json_data= collect($json_data);

        return response()->json($json_data);
    }

    public function exportEnviosChatarraAluminio(Request $request){
        $view = getPermission('Envíos Chatarra', 'record-view');
        $create = getPermission('Envíos Chatarra', 'record-create'); 
        if(!$view || !$create) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $validator = \Validator::make($request->all(),[
            'send_date_chatarra' => 'required|date|date_format:d-m-Y'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->with('error', 'Error en fecha!')->withInput();
        }

        $data = DB::table('purchase_valuation AS pv')
        ->leftjoin('purchase_management AS pm', 'pm.purchase_valuation_id', '=', 'pv.id')
        ->join('apply_sub_process_and_processes AS apply', 'apply.purchase_valuation_id', '=' ,'pv.id')
        ->select('pv.id AS id_pv', 'pv.model AS model1', 'pm.*', 'apply.processes_id', 'apply.subprocesses_id')
        ->where('apply.processes_id', '=', 5)
        ->where('apply.subprocesses_id', '=', 5)
        ->where('pv.states_id', '!=', 10)
        ->where('pm.check_chasis', '=', 'Aluminio')
        ->where('pm.send_date_chatarra', '=', 0)
        ->get();

        foreach($data as $value){
            $purchaseM = PurchaseManagement::where('purchase_valuation_id', $value->id_pv)->first();
            $purchase_management = PurchaseManagement::find($purchaseM->id);
            if($purchase_management->send_date_chatarra !== 0){
                $purchase_management->send_date_chatarra  = $request->send_date_chatarra;
                $purchase_management->update();
            }
        }
        $fecha_envio = $request->send_date_chatarra;


        Excel::create('BASTIDORES PARA CHATARRA ALUMINIO', function($excel) use($data,$fecha_envio ) {

            $excel->sheet('Entrega Aluminio', function($sheet) use($data, $fecha_envio) {

                $sheet->loadView('excel.envios_chatarra_aluminio', array('data' => $data, 'fecha_envio' => $fecha_envio));

            });

        })->export('xlsx');

        return Redirect::back()->with('notificacion', 'Informe descargado!')->withInput();
    }

    public function getEnviosChatarraHierro()
    {
        $view = getPermission('Envíos Chatarra', 'record-view');
        if(!$view) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $purchases = DB::table('purchase_valuation AS pv')
        ->leftjoin('purchase_management AS pm', 'pm.purchase_valuation_id', '=', 'pv.id')
        ->join('apply_sub_process_and_processes AS apply', 'apply.purchase_valuation_id', '=' ,'pv.id')
        ->select('pv.id AS id_pv', 'pv.model AS model1', 'pm.*', 'apply.processes_id', 'apply.subprocesses_id')
        ->where('apply.processes_id', '=', 5)
        ->where('apply.subprocesses_id', '=', 5) 
        ->where('pv.states_id', '!=', 10)
        ->where('pm.check_chasis', '=', 'Hierro')
        ->where('pm.send_date_chatarra', '=', 0)
        ->get();
        
        // dd($purchases);

        $view = getPermission('Envíos Chatarra', 'record-view');
        $edit = getPermission('Envíos Chatarra', 'record-edit');
        $delete = getPermission('Envíos Chatarra', 'record-delete');

        $data = array();
        foreach($purchases as $value){

            $row = array();
            $row['id'] = 'L'.$value->id_pv;
            $row['frame_no'] = $value->frame_no;
            $row['model'] = $value->model1;            
            $row['registration_number'] = $value->registration_number;
            $row['registration_date'] = $value->registration_date;

            $data[] = $row;
        }

        $json_data = array('data'=> $data);
        $json_data= collect($json_data);

        return response()->json($json_data);
    }

    public function exportEnviosChatarraHierro(Request $request){
        $view = getPermission('Envíos Chatarra', 'record-view');
        $create = getPermission('Envíos Chatarra', 'record-create'); 
        if(!$view || !$create) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $validator = \Validator::make($request->all(),[
            'send_date_chatarra' => 'required|date|date_format:d-m-Y'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->with('error', 'Error en fecha!')->withInput();
        }

        $data = DB::table('purchase_valuation AS pv')
        ->leftjoin('purchase_management AS pm', 'pm.purchase_valuation_id', '=', 'pv.id')
        ->join('apply_sub_process_and_processes AS apply', 'apply.purchase_valuation_id', '=' ,'pv.id')
        ->select('pv.id AS id_pv', 'pv.model AS model1', 'pm.*', 'apply.processes_id', 'apply.subprocesses_id')
        ->where('apply.processes_id', '=', 5)
        ->where('apply.subprocesses_id', '=', 5)
        ->where('pv.states_id', '!=', 10)
        ->where('pm.check_chasis', '=', 'Hierro')
        ->where('pm.send_date_chatarra', '=', 0)
        ->get();

        foreach($data as $value){
            $purchaseM = PurchaseManagement::where('purchase_valuation_id', $value->id_pv)->first();
            $purchase_management = PurchaseManagement::find($purchaseM->id);
            if($purchase_management->send_date_chatarra !== 0){
                $purchase_management->send_date_chatarra  = $request->send_date_chatarra;
                $purchase_management->update();
            }
        }
        $fecha_envio = $request->send_date_chatarra;

        Excel::create('BASTIDORES PARA CHATARRA HIERRO', function($excel) use($data, $fecha_envio) {

            $excel->sheet('Entrega Hierro', function($sheet) use($data, $fecha_envio) {

                $sheet->loadView('excel.envios_chatarra_hierro', array('data' => $data, 'fecha_envio' => $fecha_envio));

            });

        })->export('xlsx');

        return Redirect::back()->with('notificacion', 'Informe descargado!')->withInput();
    }

    public function getEnviosChatarraCamion()
    {
        $view = getPermission('Envíos Chatarra', 'record-view');
 
        if(!$view) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $purchases = DB::table('purchase_valuation AS pv')
        ->leftjoin('purchase_management AS pm', 'pm.purchase_valuation_id', '=', 'pv.id')
        ->join('apply_sub_process_and_processes AS apply', 'apply.purchase_valuation_id', '=' ,'pv.id')
        ->select('pv.id AS id_pv', 'pv.model AS model1', 'pm.*', 'apply.processes_id', 'apply.subprocesses_id')
        ->where('apply.processes_id', '=', 5)
        ->where('apply.subprocesses_id', '=', 5) 
        ->where('pv.states_id', '!=', 10)
        ->where('pm.check_chasis', '=', 'Camion')
        ->where('pm.send_date_chatarra', '=', 0)
        ->get();
        
        // dd($purchases);

        $view = getPermission('Envíos Chatarra', 'record-view');
        $edit = getPermission('Envíos Chatarra', 'record-edit');
        $delete = getPermission('Envíos Chatarra', 'record-delete');

        $data = array();
        foreach($purchases as $value){

            $row = array();
            $row['id'] = 'L'.$value->id_pv;
            $row['frame_no'] = $value->frame_no;
            $row['model'] = $value->model1;            
            $row['registration_number'] = $value->registration_number;
            $row['registration_date'] = $value->registration_date;

            $data[] = $row;
        }

        $json_data = array('data'=> $data);
        $json_data= collect($json_data);

        return response()->json($json_data);
    }

    public function exportEnviosChatarraCamion(Request $request){ 
        $view = getPermission('Envíos Chatarra', 'record-view');
        $create = getPermission('Envíos Chatarra', 'record-create'); 
        if(!$view || !$create) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $validator = \Validator::make($request->all(),[
            'send_date_chatarra' => 'required|date|date_format:d-m-Y'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->with('error', 'Error en fecha!')->withInput();
        }

        $data = DB::table('purchase_valuation AS pv')
        ->leftjoin('purchase_management AS pm', 'pm.purchase_valuation_id', '=', 'pv.id')
        ->join('apply_sub_process_and_processes AS apply', 'apply.purchase_valuation_id', '=' ,'pv.id')
        ->select('pv.id AS id_pv', 'pv.model AS model1', 'pm.*', 'apply.processes_id', 'apply.subprocesses_id')
        ->where('apply.processes_id', '=', 5)
        ->where('apply.subprocesses_id', '=', 5) 
        ->where('pv.states_id', '!=', 10)
        ->where('pm.check_chasis', '=', 'Camion')
        ->where('pm.send_date_chatarra', '=', 0)
        ->get();

        foreach($data as $value){
            $purchaseM = PurchaseManagement::where('purchase_valuation_id', $value->id_pv)->first();
            $purchase_management = PurchaseManagement::find($purchaseM->id);
            if($purchase_management->send_date_chatarra !== 0){
                $purchase_management->send_date_chatarra  = $request->send_date_chatarra;
                $purchase_management->update();
            }
            
        }
        $fecha_envio = $request->send_date_chatarra;

        Excel::create('BASTIDORES PARA CHATARRA PARA EL CAMION', function($excel) use($data, $fecha_envio) {

            $excel->sheet('Entrega Camion', function($sheet) use($data, $fecha_envio) {

                $sheet->loadView('excel.envios_chatarra_camion', array('data' => $data, 'fecha_envio' => $fecha_envio));

            });

        })->export('xlsx');

        return Redirect::back()->with('notificacion', 'Informe descargado!')->withInput();
    }

    public function getEnviosChatarraHistorico()
    {
        $view = getPermission('Envíos Chatarra', 'record-view');
        if(!$view) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $purchases = DB::table('purchase_valuation AS pv')
        ->leftjoin('purchase_management AS pm', 'pm.purchase_valuation_id', '=', 'pv.id')
        ->join('apply_sub_process_and_processes AS apply', 'apply.purchase_valuation_id', '=' ,'pv.id')
        ->select('pv.id AS id_pv', 'pv.model AS model1', 'pm.*', 'apply.processes_id', 'apply.subprocesses_id')
        ->where('apply.processes_id', '=', 5)
        ->where('apply.subprocesses_id', '=', 5)
        ->where('pv.states_id', '!=', 10)
        ->where('pm.check_chasis', '=', 'Aluminio')
        ->where('pm.send_date_chatarra', '!=', 0)
        ->orWhere(function($purchases) {   
            $purchases->where('apply.processes_id', '=', 5)
            ->where('apply.subprocesses_id', '=', 5)    
            ->where('pv.states_id', '!=', 10)    
            ->where('pm.send_date_chatarra', '!=', 0)
            ->where('pm.check_chasis', '=', 'Hierro');
        })
        ->orWhere(function($purchases) {   
            $purchases->where('apply.processes_id', '=', 5)
            ->where('apply.subprocesses_id', '=', 5)    
            ->where('pv.states_id', '!=', 10)      
            ->where('pm.send_date_chatarra', '!=', 0)
            ->where('pm.check_chasis', '=', 'Camion');
        })
        ->get();
        //dd($purchases);
        $view = getPermission('Envíos Chatarra', 'record-view');
        $edit = getPermission('Envíos Chatarra', 'record-edit');
        $delete = getPermission('Envíos Chatarra', 'record-delete');

        $data = array();
        foreach($purchases as $value){

            $row = array();
            $row['id'] = 'L'.$value->id_pv;
            $row['frame_no'] = $value->frame_no;
            $row['model'] = $value->model1;            
            $row['registration_number'] = $value->registration_number;
            $row['registration_date'] = $value->registration_date;
            $row['check_chasis'] = $value->check_chasis;
            $row['send_date'] = $value->send_date_chatarra;
            $data[] = $row;
        }

        $json_data = array('data'=> $data);
        $json_data= collect($json_data);

        return response()->json($json_data);
    }

    public function getEnviosChatarraIncidencias()
    {
        $view = getPermission('Envíos Chatarra', 'record-view');
        if(!$view) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $purchases = DB::table('purchase_valuation AS pv')
        ->leftjoin('purchase_management AS pm', 'pm.purchase_valuation_id', '=', 'pv.id')
        ->join('apply_sub_process_and_processes AS apply', 'apply.purchase_valuation_id', '=' ,'pv.id')
        ->select('pv.id AS id_pv', 'pv.model AS model1', 'pm.*', 'apply.processes_id', 'apply.subprocesses_id')
        ->where('apply.processes_id', '=', 5)
        ->where('apply.subprocesses_id', '=', 6)
        ->where('pv.states_id', '!=', 10)
        ->where('pm.check_chasis', '=', 'Aluminio')
        ->where('pm.send_date_chatarra', '=', 0)
        ->orWhere(function($purchases) {   
            $purchases->where('apply.processes_id', '=', 5)
            ->where('apply.subprocesses_id', '=', 6)    
            ->where('pv.states_id', '!=', 10)    
            ->where('pm.send_date_chatarra', '=', 0)
            ->where('pm.check_chasis', '=', 'Hierro');
        })
        ->orWhere(function($purchases) {   
            $purchases->where('apply.processes_id', '=', 5)
            ->where('apply.subprocesses_id', '=', 6)    
            ->where('pv.states_id', '!=', 10)      
            ->where('pm.send_date_chatarra', '=', 0)
            ->where('pm.check_chasis', '=', 'Camion');
        })
        ->get();
        //dd($purchases);
        $view = getPermission('Envíos Chatarra', 'record-view');
        $edit = getPermission('Envíos Chatarra', 'record-edit');
        $delete = getPermission('Envíos Chatarra', 'record-delete');
       

        $data = array();
        foreach($purchases as $value){

            $row = array();
            $row['id'] = 'L'.$value->id_pv;
            $row['frame_no'] = $value->frame_no;
            $row['model'] = $value->model1;            
            $row['registration_number'] = $value->registration_number;
            $row['registration_date'] = $value->registration_date;
            $row['check_chasis'] = $value->check_chasis;
            $row['send_date'] = $value->send_date_chatarra;
            $data[] = $row;
        }
       
        // $data['cuenta'] = $count;
        
        $json_data = array('data'=> $data);
        $json_data= collect($json_data);

        return response()->json($json_data);
    }

    public function getCountEnviosChatarraIncidencias(){
        $view = getPermission('Envíos Chatarra', 'record-view');
        if(!$view) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $purchases = DB::table('purchase_valuation AS pv')
        ->leftjoin('purchase_management AS pm', 'pm.purchase_valuation_id', '=', 'pv.id')
        ->join('apply_sub_process_and_processes AS apply', 'apply.purchase_valuation_id', '=' ,'pv.id')
        ->select('pv.id AS id_pv', 'pv.model AS model1', 'pm.*', 'apply.processes_id', 'apply.subprocesses_id')
        ->where('apply.processes_id', '=', 5)
        ->where('apply.subprocesses_id', '=', 6)
        ->where('pv.states_id', '!=', 10)
        ->where('pm.check_chasis', '=', 'Aluminio')
        ->where('pm.send_date_chatarra', '=', 0)
        ->orWhere(function($purchases) {   
            $purchases->where('apply.processes_id', '=', 5)
            ->where('apply.subprocesses_id', '=', 6)    
            ->where('pv.states_id', '!=', 10)    
            ->where('pm.send_date_chatarra', '=', 0)
            ->where('pm.check_chasis', '=', 'Hierro');
        })
        ->orWhere(function($purchases) {   
            $purchases->where('apply.processes_id', '=', 5)
            ->where('apply.subprocesses_id', '=', 6)    
            ->where('pv.states_id', '!=', 10)      
            ->where('pm.send_date_chatarra', '=', 0)
            ->where('pm.check_chasis', '=', 'Camion');
        })
        ->count();

        $out['code'] = 200;
        $out['message'] = 'Registro actualizado exitosamente.';
        $out['purchases'] = $purchases;

        return response()->json($out);
    }

    public function downloadCertificados(Request $request){

        $create = getPermission('Envíos Chatarra', 'record-create'); 
        if(!$create) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $validator = \Validator::make($request->all(),[
            'start_at' => 'required|date|date_format:Y-m-d',
            'end_at' => 'required|date|date_format:Y-m-d'
        ]);  

        if ($validator->fails()) {
            return Redirect::back()->with('error', 'Ha ocurrido un error!')->withInput();
        }

        if(strtotime($request->start_at) <= strtotime($request->end_at)){}
        else{
            return Redirect::back()->with('error', 'La fecha "Desde" tiene que ser menor que la fecha "Hasta"!')->withInput();
        }
        
        $apply = array();
        foreach(explode(",", $request->apply) as $id) array_push($apply, $id);

        $data = DB::table('purchase_valuation AS pv')
        ->leftjoin('purchase_management AS pm', 'pm.purchase_valuation_id', '=', 'pv.id')
        ->join('apply_sub_process_and_processes AS apply', 'apply.purchase_valuation_id', '=' ,'pv.id')
        ->select('pv.id AS id_pv')
        ->where('apply.processes_id', '=', 5)
        ->where('apply.subprocesses_id', '=', 5)
        ->where('pm.status', '=', 2)
        ->where('pm.download_certificate', '=', 0)
        ->whereDate('apply.created_at', '>=', $request->start_at)->whereDate('apply.created_at', '<=', $request->end_at)
        ->whereIn('pv.id', $apply)
        ->get();

        if(count($data) == 0){
            return Redirect::back()->with('error', 'No se han podido generar certificados!')->withInput();
        }

        $zipper = new \Chumper\Zipper\Zipper;
        $nameZip = public_path().'/certificados'.time().'.zip';
        $zipper->make($nameZip)->folder('certificados');

        foreach($data as $val){
            $id = $val->id_pv;

            $cert = CertificatesPurchaseValuation::where('purchase_valuation_id', $id)->first();
            
            if(!is_null($cert)){ $zipper->add(public_path().'/certificates/'.$cert->name); }
            else { 
                $content = "Moto con id: ".$id. " no ha cargado el CERTIFICADO DE DESTRUCCION";
                $fp = fopen(public_path().'/certificates/empty_'.$id.'.txt',"wb");
                fwrite($fp,$content);
                fclose($fp);

                $zipper->add(public_path().'/certificates/empty_'.$id.'.txt'); 

                $purchaseM = PurchaseManagement::where('purchase_valuation_id', $val->id_pv)->first();
                $purchase_management = PurchaseManagement::find($purchaseM->id);
                if($purchase_management->download_certificate == 0){
                    $purchase_management->download_certificate  = 1;
                    $purchase_management->update();
                }
            }           
        }

        $zipper->close();

        return \Response::download($nameZip);
    }

}
