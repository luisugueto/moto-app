<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseManagement;
use App\PurchaseValuation;
use App\ImagesPurchase;
use App\Http\Requests;
use Redirect;
use App\LinksRegister;
use Mail;


class PurchaseManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gestion = PurchaseManagement::all();
        return view('backend.purchase_management.index', compact($gestion));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($token)
    {
        $linksRegister = LinksRegister::where('token', $token)->where('status', 0)->first();
        $purchase_management = PurchaseManagement::find($linksRegister->purchase_valuation_id);
        
        if(!empty($linksRegister)){
            $purchase_valuation_id = $linksRegister->purchase_valuation_id;
            $gestion = PurchaseManagement::where('purchase_valuation_id', $purchase_valuation_id)->first();
            $purchase = PurchaseValuation::find($linksRegister->purchase_valuation_id);
            $token_purchase = $linksRegister->token;
         
            return view('backend.purchase_management.create', compact('purchase_valuation_id','gestion','purchase_management', 'purchase', 'token_purchase'));
        }
        else
            return Redirect::to('/')->with('error', 'Ha ocurrido un error!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(isset($request->vin7Digitos)){
            $this->validate($request, [
                'token_purchase' => 'required',
                // 'file_no' => 'required',
                'current_year' => 'required|date',
                // 'collection_contract_date' => 'required|date',
                'documents_attached' => 'required',
                'vehicle_delivers' => 'required',
                'name' => 'required',
                'firts_surname' => 'required',
                // 'second_surtname' => 'required',
                'dni' => 'required',
                // 'birthdate' => 'required|date',
                'phone' => ['required'],
                'email' => 'required|email',
                'street' => 'required',
                'nro_street' => 'required|numeric',
                // 'stairs' => 'required',
                // 'floor' => 'required',
                // 'letter' => 'required',
                'municipality' => 'required',
                'postal_code' => 'required',
                'province' => 'required',
                // 'iban' => 'required',
                // 'sale_amount' => 'required',
                // 'name_representantive' => 'required',
                // 'firts_surname_representative' => 'required',
                // 'second_surtname_representantive' => 'required',
                // 'dni_representative' => 'required|numeric',
                // 'birthdate_representative' => 'required|date',
                // 'phone_representantive' => ["regex:^\+[1-9]{1}[0-9]{3,14}$/"],
                // 'email_representative' => 'required|email',
                // 'representation_concept' => 'required',
                'brand' => 'required',
                'model' => 'required',
                // 'version' => 'required',
                'type' => 'required',
                'kilometres' => 'required',
                // 'color' => 'required',
                'fuel' => 'required',
                'weight' => 'required',
                'registration_number' => 'required',
                'registration_date' => 'required|date',
                'registration_country' => 'required',
                'frame_no' => ['required'],
                'type_motor' => 'required',
                'vehicle_state_trafic' => 'required',
                'vehicle_state' => 'required',
                'file-1' => 'required',
            ]);
        }else{
            $this->validate($request, [
                'token_purchase' => 'required',
                // 'file_no' => 'required',
                'current_year' => 'required|date',
                // 'collection_contract_date' => 'required|date',
                'documents_attached' => 'required',
                'vehicle_delivers' => 'required',
                'name' => 'required',
                'firts_surname' => 'required',
                // 'second_surtname' => 'required',
                'dni' => 'required',
                // 'birthdate' => 'required|date',
                'phone' => ['required'],
                'email' => 'required|email',
                'street' => 'required',
                'nro_street' => 'required|numeric',
                // 'stairs' => 'required',
                // 'floor' => 'required',
                // 'letter' => 'required',
                'municipality' => 'required',
                'postal_code' => 'required',
                'province' => 'required',
                // 'iban' => 'required',
                // 'sale_amount' => 'required',
                // 'name_representantive' => 'required',
                // 'firts_surname_representative' => 'required',
                // 'second_surtname_representantive' => 'required',
                // 'dni_representative' => 'required|numeric',
                // 'birthdate_representative' => 'required|date',
                // 'phone_representantive' => ["regex:^\+[1-9]{1}[0-9]{3,14}$/"],
                // 'email_representative' => 'required|email',
                // 'representation_concept' => 'required',
                'brand' => 'required',
                'model' => 'required',
                // 'version' => 'required',
                'type' => 'required',
                'kilometres' => 'required',
                // 'color' => 'required',
                'fuel' => 'required',
                'weight' => 'required',
                'registration_number' => 'required',
                'registration_date' => 'required|date',
                'registration_country' => 'required',
                'frame_no' => 'required|max:17',
                // 'frame_no' => ['required', "regex:/^[A-HJ-NPR-Z\\d]{8}[\\dX][A-HJ-NPR-Z\\d]{2}\\d{6}$/"],
                'type_motor' => 'required',
                'vehicle_state_trafic' => 'required',
                'vehicle_state' => 'required',
                'file-1' => 'required',
            ]);
        }
            

        if($request->documents_attached == 1){
            $documents_attached = 1;
            $non_existence_document = 0;
        }
        elseif($request->documents_attached == 2){
            $non_existence_document = 1;
            $documents_attached = 0;
        }

        $purchaseValuation = PurchaseValuation::find($request->purchase_valuation_id);
        $purchaseValuation->phone = $request->phone;
        $purchaseValuation->email = $request->email;
        $purchaseValuation->update();
         
        $gestion = PurchaseManagement::find($request->purchase_id);
        $gestion->collection_contract_date =  date('Y-m-d');
        $gestion->documents_attached = $documents_attached;
        $gestion->non_existence_document = $non_existence_document;
        $gestion->vehicle_delivers = $request->vehicle_delivers;
        $gestion->name = $request->name;
        $gestion->firts_surname = $request->firts_surname;
        $gestion->second_surtname = $request->second_surtname;
        $gestion->dni = $request->dni;
        $gestion->birthdate = $request->birthdate;
        $gestion->phone = $request->phone;
        $gestion->email = $request->email;
        $gestion->street = $request->street;
        $gestion->nro_street = $request->nro_street;
        $gestion->stairs = $request->stairs;
        $gestion->floor = $request->floor;
        $gestion->letter = $request->letter;
        $gestion->municipality = $request->municipality;
        $gestion->postal_code = $request->postal_code;
        $gestion->province = $request->province;
        $gestion->iban = $request->iban;
        // $gestion->sale_amount = $request->sale_amount;
        $gestion->name_representantive = $request->name_representantive;
        $gestion->firts_surname_representative = $request->firts_surname_representative;
        $gestion->second_surtname_representantive = $request->second_surtname_representantive;
        $gestion->dni_representative = $request->dni_representative;
        $gestion->birthdate_representative = $request->birthdate_representative;
        $gestion->phone_representantive = $request->phone_representantive;
        $gestion->email_representative = $request->email_representative;
        $gestion->representation_concept = $request->representation_concept;
        $gestion->brand = $request->brand;
        $gestion->model = $request->model;
        $gestion->version = $request->version;
        $gestion->type = $request->type;
        $gestion->kilometres = $request->kilometres;
        $gestion->color = $request->color;
        $gestion->fuel = $request->fuel;
        $gestion->weight = $request->weight;
        $gestion->registration_number = $request->registration_number;
        $gestion->registration_date = $request->registration_date;
        $gestion->registration_country = $request->registration_country;
        $gestion->frame_no = $request->frame_no;
        $gestion->type_motor = $request->type_motor;
        $gestion->motor_no = '';
        $gestion->vehicle_state_trafic = $request->vehicle_state_trafic;
        $gestion->vehicle_state = $request->vehicle_state;    

        $path_dni = public_path().'/dni/';
        $files1 = $request->file('file-1');
        $doc_dni = '';
        if(!empty($files1[0]) && count($files1) >= 2){

            foreach($files1 as $key => $file){
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $file->move($path_dni, $fileNameToStore);
                
                if($key == 0)
                    $doc_dni = $fileNameToStore;
                else
                    $doc_dni .= ','.$fileNameToStore;
            }
        }else
            return Redirect::back()->with('error_file-1', 'Por favor ingrese: (Dos archivos, cara A del DNI y Cara B del DNI)!');


        $gestion->dni_doc = $doc_dni;

        $path_circulacion = public_path().'/per_circulacion/';
        $files2 = $request->file('file-2');
        $per_circulacion = '';

        if(!empty($files2[0]) ){
            foreach($files2 as $key => $file){
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $file->move($path_circulacion, $fileNameToStore);

               if($key == 0)
                    $per_circulacion = $fileNameToStore;
                else
                    $per_circulacion .= ','.$fileNameToStore;
            }
        }

        $gestion->per_circulacion = $per_circulacion;

        $path_ficha_tecnica = public_path().'/ficha_tecnica/';
        $files3 = $request->file('file-3');
        $ficha_tecnica = '';

        if(!empty($files3[0])){
            foreach($files3 as $key => $file){
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $file->move($path_ficha_tecnica, $fileNameToStore);

                if($key == 0)
                    $ficha_tecnica = $fileNameToStore;
                else
                    $ficha_tecnica .= ','.$fileNameToStore;
            }
        }

        $gestion->ficha_tecnica = $ficha_tecnica;

        $path_docs = public_path().'/other_docs/';
        $files4 = $request->file('file-4');
        $other_docs = '';

        if(!empty($files4[0])){
            foreach($files4 as $key => $file){
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $file->move($path_docs, $fileNameToStore);

                if($key == 0)
                    $other_docs = $fileNameToStore;
                else
                    $other_docs .= ','.$fileNameToStore;
            }
        }

        $gestion->other_docs = $other_docs;
        $gestion->status = 1;

        $gestion->update();

        $link = LinksRegister::where('token', $request->token_purchase)->where('status', 0)->first();
        $link->status = 1;
        $link->update();

        return Redirect::to('/')->with('notification', '<b>Formulario registrado exitosamente. Para dirigirse a motOstion darle click al siguiente enlace <a class="class="alert-link"" href="'. url('https://motostion.com/') . '"> enlace </a></b>');

        // return Redirect::to('https://motostion.com/');
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
