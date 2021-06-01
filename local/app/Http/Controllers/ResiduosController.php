<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Exports\EnviosQuincenalesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests;
use PurchaseManagement;
use DB;

class ResiduosController extends Controller
{
    
    public function enviosQuincenales()
    {
       return view ('backend.residuos.envios_quincenales');
       
    }

    public function getEnviosQuincenalesSinGestionar()
    {
        $purchases = DB::table('purchase_management')
        ->join('apply_sub_process_and_processes AS apply', 'apply.purchase_valuation_id', '=' ,'purchase_management.purchase_valuation_id')
        ->select('purchase_management.*', 'apply.processes_id', 'apply.subprocesses_id')
        ->where('apply.processes_id', '=', 5)
        ->orWhere(function($query)
        {
            $query->where('apply.subprocesses_id', '=', 5);
        })
        // ->where(DB::raw('WEEK(purchase_management.current_year + 1) DIV 2'))
        ->get();
      
        $view = getPermission('Envíos Quincenales', 'record-view');
        $edit = getPermission('Envíos Quincenales', 'record-edit');
        $delete = getPermission('Envíos Quincenales', 'record-delete');
        
        $data = array();
        foreach($purchases as $value){  

            $row = array();      
            $row['id'] = $value->id;
            $row['model'] = $value->model;
            $row['registration_number'] = $value->registration_number;
            $row['registration_date'] = $value->registration_date;
            $row['frame_no'] = $value->frame_no;
            $row['vehicle_state_trafic'] = $value->vehicle_state_trafic;
            $row['weight'] = round($value->weight, 2);
            $row['titular'] = $value->name. ' '. $value->firts_surname . ' '. $value->second_surtname;
            $row['dni'] = $value->dni;
            $row['birthdate'] = $value->birthdate;
            $row['direction'] = $value->street.' '. $value->nro_street;
            $row['postal_code'] = $value->postal_code;
            $row['municipality'] = $value->municipality;
            $row['province'] = $value->province;
            $row['vehicle_state'] = $value->vehicle_state;
            $row['current_year'] = $value->current_year;
            $row['certificate_destruction_date'] = $value->current_year;
            $row['collection_contract_date'] = $value->collection_contract_date;
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
        $purchases = DB::table('purchase_management')
        ->join('apply_sub_process_and_processes AS apply', 'apply.purchase_valuation_id', '=' ,'purchase_management.purchase_valuation_id')
        ->select('purchase_management.*', 'apply.processes_id', 'apply.subprocesses_id')
        ->where('apply.processes_id', '=', 5)
        ->orWhere(function($query)
        {
            $query->where('apply.subprocesses_id', '=', 5);
        })
        // ->where(DB::raw('WEEK(purchase_management.current_year + 1) DIV 2'))
        ->get();
        
        $view = getPermission('Envíos Quincenales', 'record-view');
        $edit = getPermission('Envíos Quincenales', 'record-edit');
        $delete = getPermission('Envíos Quincenales', 'record-delete');
        
        $data = array();
        foreach($purchases as $value){ 
 

            $row = array();      
            $row['id'] = $value->id;
            $row['model'] = $value->model;
            $row['registration_number'] = $value->registration_number;
            $row['registration_date'] = $value->registration_date;
            $row['frame_no'] = $value->frame_no;
            $row['vehicle_state_trafic'] = $value->vehicle_state_trafic;
            $row['weight'] = '';
            $row['titular'] = $value->name. ' '. $value->firts_surname . ' '. $value->second_surtname;
            $row['dni'] = $value->dni;
            $row['birthdate'] = $value->birthdate;
            $row['direction'] = $value->street.' '. $value->nro_street;
            $row['postal_code'] = $value->postal_code;
            $row['municipality'] = $value->municipality;
            $row['province'] = $value->province;
            $row['vehicle_state'] = $value->vehicle_state;
            $row['current_year'] = $value->current_year;
            $row['certificate_destruction_date'] = $value->current_year;
            $row['collection_contract_date'] = $value->collection_contract_date;
            $row['edit'] = $edit;
            $row['delete'] = $delete;
            $data[] = $row;
        }

        $json_data = array('data'=> $data);
        $json_data= collect($json_data);  

        return response()->json($json_data);
    }

    public function exportEnviosQuincenales(){

        $purchases = DB::table('purchase_management')
        ->select('purchase_management.*')
        ->groupBy(DB::raw('WEEK(purchase_management.current_year + 1) DIV 2'))
        // ->toSql();
        ->get();
        
        $data = array();
        foreach($purchases as $value){  

            $row = array();      
            $row['Modelo'] = $value->model;
            $row['Matricula'] = $value->registration_number;
            $row['Fecha Matriculación'] = $value->registration_date;
            $row['Bastidor'] = $value->frame_no;
            $row['Estado en tráfico'] = $value->vehicle_state_trafic;
            $row['Peso (kg)'] = '';
            $row['Titular'] = $value->name. ' '. $value->firts_surname . ' '. $value->second_surtname;
            $row['Dni'] = $value->dni;
            $row['Fecha de Nacimiento'] = $value->birthdate;
            $row['Dirección'] = $value->street.' '. $value->nro_street;
            $row['Codigo Postal'] = $value->postal_code;
            $row['Población'] = $value->municipality;
            $row['Provincia'] = $value->province;
            $row['Estado Moto'] = $value->vehicle_state;
            $row['Fecha de Baja'] = $value->current_year;
            $row['N° Certificado de Destrucción'] = $value->purchase_valuation_id;
            $row['Fecha Certificado de Destrucció'] = $value->current_year;
            $row['Fecha de Descontaminacion'] = $value->collection_contract_date;
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
        $purchases = DB::table('purchase_management')
        ->select('purchase_management.*')
        ->groupBy('purchase_management.id',DB::raw('MONTH(purchase_management.current_year)>6'))
        // ->where('status', 1)
        // ->toSql();
        ->get();
  
        $view = getPermission('Envíos Semestrales', 'record-view');
        $edit = getPermission('Envíos Semestrales', 'record-edit');
        $delete = getPermission('Envíos Semestrales', 'record-delete');
        
        $data = array();
        foreach($purchases as $value){  

            $row = array();      
            $row['id'] = $value->id;
            $row['model'] = $value->model;
            $row['registration_number'] = $value->registration_number;
            $row['registration_date'] = $value->registration_date;
            $row['frame_no'] = $value->frame_no;
            $row['vehicle_state_trafic'] = $value->vehicle_state_trafic;
            $row['weight'] = '';
            $row['titular'] = $value->name. ' '. $value->firts_surname . ' '. $value->second_surtname;
            $row['dni'] = $value->dni;
            $row['birthdate'] = $value->birthdate;
            $row['direction'] = $value->street.' '. $value->nro_street;
            $row['postal_code'] = $value->postal_code;
            $row['municipality'] = $value->municipality;
            $row['province'] = $value->province;
            $row['vehicle_state'] = $value->vehicle_state;
            $row['current_year'] = $value->current_year;
            $row['certificate_destruction_date'] = $value->current_year;
            $row['collection_contract_date'] = $value->collection_contract_date;
            $row['edit'] = $edit;
            $row['delete'] = $delete;
            $data[] = $row;
        }

        $json_data = array('data'=> $data);
        $json_data= collect($json_data);  

        return response()->json($json_data);
    }

    public function exportEnviosSemestrales(){

        $purchases = DB::table('purchase_management')
        ->select('purchase_management.*')
        ->groupBy(DB::raw('MONTH(purchase_management.current_year)>6'))
        ->toSql();
        // ->get();
        
        $data = array();
        foreach($purchases as $value){  

            $row = array();      
            $row['Modelo'] = $value->model;
            $row['Matricula'] = $value->registration_number;
            $row['Fecha Matriculación'] = $value->registration_date;
            $row['Bastidor'] = $value->frame_no;
            $row['Estado en tráfico'] = $value->vehicle_state_trafic;
            $row['Peso (kg)'] = '';
            $row['Titular'] = $value->name. ' '. $value->firts_surname . ' '. $value->second_surtname;
            $row['Dni'] = $value->dni;
            $row['Fecha de Nacimiento'] = $value->birthdate;
            $row['Dirección'] = $value->street.' '. $value->nro_street;
            $row['Codigo Postal'] = $value->postal_code;
            $row['Población'] = $value->municipality;
            $row['Provincia'] = $value->province;
            $row['Estado Moto'] = $value->vehicle_state;
            $row['Fecha de Baja'] = $value->current_year;
            $row['N° Certificado de Destrucción'] = $value->purchase_valuation_id;
            $row['Fecha Certificado de Destrucció'] = $value->current_year;
            $row['Fecha de Descontaminacion'] = $value->collection_contract_date;
            $data[] = $row;
        }
        // $json_data = array('data'=> $row);
        
        Excel::create('envios_semestrales', function($excel) use($data) {
        
            $excel->sheet('Hoja1', function($sheet) use($data) {
        
                $sheet->fromArray($data);
        
            });
        
        })->export('xls');
    }
}
