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

class ResiduosController extends Controller
{
    
    public function enviosQuincenales()
    {
        $view = getPermission('Envíos Quincenales', 'record-view');

        if(!$view) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $subprocesses = SubProcesses::where('processes_id' , '=', 5)->get();
        return view ('backend.residuos.envios_quincenales', compact('subprocesses'));
       
    }

    public function getEnviosQuincenalesSinGestionar()
    {
        $purchases = DB::table('purchase_valuation AS pv')
        ->leftjoin('purchase_management AS pm', 'pm.purchase_valuation_id', '=', 'pv.id')
        ->join('apply_sub_process_and_processes AS apply', 'apply.purchase_valuation_id', '=' ,'pv.id')
        ->select('pv.id AS id_pv', 'pv.model AS model1','pv.name AS pvname', 'pv.lastname', 'pv.status_trafic', 'pm.*', 'apply.processes_id', 'apply.subprocesses_id', 'apply.created_at AS destruction_date')
        ->where('apply.processes_id', '=', 5) 
        ->where('apply.subprocesses_id', '=', 6) 
        ->where('pm.check_chasis', '!=', 'NULL') 
        // ->where(DB::raw('WEEK(purchase_management.current_year + 1) DIV 2'))        
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
            $row['current_year'] = date('d-m-Y', strtotime($value->current_year));
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

    public function getEnviosQuincenalesGestionadas()
    {
        $purchases = DB::table('purchase_valuation AS pv')
        ->leftjoin('purchase_management AS pm', 'pm.purchase_valuation_id', '=', 'pv.id')
        ->join('apply_sub_process_and_processes AS apply', 'apply.purchase_valuation_id', '=' ,'pv.id')
        ->select('pv.id AS id_pv', 'pv.model AS model1','pv.name AS pvname', 'pv.lastname', 'pv.status_trafic', 'pm.*', 'apply.processes_id', 'apply.subprocesses_id', 'apply.created_at AS destruction_date')
        ->where('apply.processes_id', '=', 5) 
        ->where('apply.subprocesses_id', '=', 5) 
        ->where('pm.check_chasis', '!=', 'NULL')     
         
        // ->where(DB::raw('WEEK(purchase_management.current_year + 1) DIV 2')) 
        ->get();
        //dd($purchases);
        $view = getPermission('Envíos Quincenales', 'record-view');
        $edit = getPermission('Envíos Quincenales', 'record-edit');
        $delete = getPermission('Envíos Quincenales', 'record-delete');
        
        $data = array();
        foreach($purchases as $value){  
            $apply = ApplySubProcessAndProcess::where('purchase_valuation_id', $value->id_pv)
            ->where('processes_id', '=', 11) 
            ->where('subprocesses_id', '=', 32) 
            ->get();
            
            //dd($apply);
            
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
            $row['current_year'] = date('d-m-Y', strtotime($value->current_year));
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

    public function exportEnviosQuincenalesSinGestionar(){

        $purchases = DB::table('purchase_valuation AS pv')
        ->leftjoin('purchase_management AS pm', 'pm.purchase_valuation_id', '=', 'pv.id')
        ->join('apply_sub_process_and_processes AS apply', 'apply.purchase_valuation_id', '=' ,'pv.id')
        ->select('pv.id AS id_pv', 'pv.model AS model1','pv.name AS pvname', 'pv.lastname', 'pv.status_trafic', 'pm.*', 'apply.processes_id', 'apply.subprocesses_id','apply.created_at AS destruction_date')
        ->where('apply.processes_id', '=', 5) 
        ->where('apply.subprocesses_id', '=', 6) 
        ->where('pm.check_chasis', '!=', 'NULL') 
        // ->where(DB::raw('WEEK(purchase_management.current_year + 1) DIV 2')) 
        // ->toSQL();
  
        ->get();
        
        $data = array();
        foreach($purchases as $value){  

            $apply = ApplySubProcessAndProcess::where('purchase_valuation_id', $value->id_pv)
            ->where('processes_id', '=', 11) 
            ->where('subprocesses_id', '=', 32) 
            ->get();

            $row = array();      
            $row['id'] = $value->id_pv;
            $row['Modelo'] = $value->model1;
            $row['Matricula'] = $value->registration_number;
            $row['Fecha Matriculación'] = $value->registration_date;
            $row['Bastidor'] = $value->frame_no;
            $row['Estado en tráfico'] = $value->vehicle_state_trafic;
            $row['Peso (kg)'] = round($value->weight, 2);
            $row['Titular'] = $value->pvname. ' '. $value->lastname;
            $row['Dni'] = $value->dni;
            $row['Fecha de Nacimiento'] = $value->birthdate;
            $row['Dirección'] = $value->street.' '. $value->nro_street;
            $row['Codigo Postal'] = $value->postal_code;
            $row['Población'] = $value->municipality;
            $row['Provincia'] = $value->province;
            $row['Estado Moto'] = $value->status_trafic;
            $row['Fecha de Baja'] = date('d-m-Y', strtotime($value->current_year));
            $row['N° Certificado de Destrucción'] = 'CATV/MD/12173/'.$value->purchase_valuation_id;
            $row['Fecha Certificado de Destrucción'] = date('d-m-Y', strtotime($value->destruction_date));
            $row['Fecha de Descontaminacion'] = '';
            foreach($apply as $key){          
                $row['Fecha de Descontaminacion'] = date('d-m-Y', strtotime($key->created_at));                      
            }
            $data[] = $row;
        }
        // $json_data = array('data'=> $row);
        
        Excel::create('envios_quincenales', function($excel) use($data) {
        
            $excel->sheet('Hoja1', function($sheet) use($data) {
        
                $sheet->fromArray($data);
        
            });
        
        })->export('xls');
    }


    public function exportEnviosQuincenalesGestionadas(){

        $purchases = DB::table('purchase_valuation AS pv')
        ->leftjoin('purchase_management AS pm', 'pm.purchase_valuation_id', '=', 'pv.id')
        ->join('apply_sub_process_and_processes AS apply', 'apply.purchase_valuation_id', '=' ,'pv.id')
        ->select('pv.id AS id_pv', 'pv.model AS model1','pv.name AS pvname', 'pv.lastname', 'pv.status_trafic', 'pm.*', 'apply.processes_id', 'apply.subprocesses_id', 'apply.created_at AS destruction_date')
        ->where('apply.processes_id', '=', 5) 
        ->where('apply.subprocesses_id', '=', 5) 
        ->where('pm.check_chasis', '!=', 'NULL') 
        // ->where(DB::raw('WEEK(purchase_management.current_year + 1) DIV 2')) 
        ->get();
        
        $data = array();
        foreach($purchases as $value){  

            $apply = ApplySubProcessAndProcess::where('purchase_valuation_id', $value->id_pv)
            ->where('processes_id', '=', 11) 
            ->where('subprocesses_id', '=', 32) 
            ->get();

            $row = array();      
            $row['id'] = $value->id_pv;
            $row['Modelo'] = $value->model1;
            $row['Matricula'] = $value->registration_number;
            $row['Fecha Matriculación'] = $value->registration_date;
            $row['Bastidor'] = $value->frame_no;
            $row['Estado en tráfico'] = $value->vehicle_state_trafic;
            $row['Peso (kg)'] = round($value->weight, 2);
            $row['Titular'] = $value->pvname. ' '. $value->lastname;
            $row['Dni'] = $value->dni;
            $row['Fecha de Nacimiento'] = $value->birthdate;
            $row['Dirección'] = $value->street.' '. $value->nro_street;
            $row['Codigo Postal'] = $value->postal_code;
            $row['Población'] = $value->municipality;
            $row['Provincia'] = $value->province;
            $row['Estado Moto'] = $value->status_trafic;
            $row['Fecha de Baja'] = date('d-m-Y', strtotime($value->current_year));
            $row['N° Certificado de Destrucción'] = 'CATV/MD/12173/'.$value->purchase_valuation_id;
            $row['Fecha Certificado de Destrucción'] = date('d-m-Y', strtotime($value->destruction_date));
            $row['Fecha de Descontaminacion'] = '';
            foreach($apply as $key){          
                $row['Fecha de Descontaminacion'] = date('d-m-Y', strtotime($key->created_at));                      
            }
            $data[] = $row;
        }
        // $json_data = array('data'=> $row);
        Excel::create('envios_quincenales', function($excel) use($data) {
        
            $excel->sheet('Hoja1', function($sheet) use($data) {
        
                $sheet->fromArray($data);
        
            });
        
        })->export('xls');
    }

    //////
    public function enviosSemestrales()
    {
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
                'withdrawal_date' => $residuo->withdrawal_date,
                'created_at' => $residuo->created_at
            ]);
        }
        
        $json_data = array('data'=> $retirados);
        $json_data= collect($json_data);  

        return response()->json($json_data);
    }

    public function applySubProcesses(Request $request)
    {
        
        $motos = explode(",", $request->apply);
       
        $out['code'] = 204;
        $out['message'] = 'Hubo un error';

        foreach($motos as $purchase) {
            $subprocesses = SubProcesses::find($request->applySubProcesses);
            $purchase = PurchaseValuation::find($purchase);
            // check last process and delete
            $lastProcessApply = ApplySubProcessAndProcess::where('processes_id', 5)->where('purchase_valuation_id', $purchase->id)->first();
            $countLastProcessApply = ApplySubProcessAndProcess::where('processes_id', 5)->where('purchase_valuation_id', $purchase->id)->count();

            if($countLastProcessApply > 0)
                $lastProcessApply->subprocesses_id = $subprocesses->id;
                $lastProcessApply->update();

        } 
         
        $out['code'] = 200;
        $out['data'] = $purchase;
        $out['message'] = 'Se ha aplicado el proceso Exitosamente';

        return response()->json($out);
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
                'withdrawal_date' => $residuo->withdrawal_date,
                'created_at' => $residuo->created_at,
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
        $residuos = Residuos::find($id);
        return response()->json($residuos);
    }

    public function editarResiduo(Request $request)
    {
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

        $validator = \Validator::make($request->all(),[
            'start_at' => 'required|date|date_format:Y-m-d|before:end_at',
            'end_at' => 'required|date|date_format:Y-m-d|after:start_at'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->with('error', 'La fecha "Desde" tiene que ser menor que la fecha "Hasta"!')->withInput();
        }

        $data = Residuos::where('created_at', '>=', $request->start_at)->where('created_at', '<=', $request->end_at)->get();

        $arrayNp1 = array();
        $arrayNp2 = array();
        $arrayNp3 = array();
        $arrayReu = array();

        foreach(Residuos::where('created_at', '>=', $request->start_at)->where('created_at', '<=', $request->end_at)->get() as $residuos){
            if(($residuos->materialC != null) && $residuos->materialC->material->type == 'NP1')
                array_push($arrayNp1, $residuos);
            elseif(($residuos->materialC != null) && $residuos->materialC->material->type == 'NP2')
                array_push($arrayNp2, $residuos);
            elseif(($residuos->materialC != null) && $residuos->materialC->material->type == 'NP3')
                array_push($arrayNp3, $residuos);
            elseif(($residuos->materialC != null) && $residuos->materialC->material->type == 'Reutilizacion')
                array_push($arrayReu, $residuos);
            
        }

        Excel::create('BALANCE SEMESTRAL 2021', function($excel) use($arrayNp1, $arrayNp2, $arrayNp3, $arrayReu) {
         
            $excel->sheet('PROCESO NP1', function($sheet) use($arrayNp1) {
         
                $sheet->loadView('excel.proceso_np1', array('data' => $arrayNp1));
         
            });
 
            $excel->sheet('PROCESO NP2', function($sheet) use($arrayNp2) {
         
                $sheet->loadView('excel.proceso_np2', array('data' => $arrayNp2));
         
            });
 
            $excel->sheet('PROCESO NP3', function($sheet) use($arrayNp3) {
         
                $sheet->loadView('excel.proceso_np3', array('data' => $arrayNp3));
         
            });
 
            $excel->sheet('PROCESO DE REUTILIZACIÓN', function($sheet) use($arrayReu) {
         
                $sheet->loadView('excel.proceso_reutilizacion', array('data' => $arrayReu));
         
            });
         
        })->download('xlsx');
    }

     //EXCELS   

     public function balanceSemestral()
     {
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
    
}
