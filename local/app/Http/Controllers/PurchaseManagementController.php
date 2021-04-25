<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseManagement;
use App\Http\Requests;
use Redirect;
use App\LinksRegister;


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
        $linksRegister = LinksRegister::where('token', $token)->first();

        if(!empty($linksRegister)){
            $purchase_valuation_id = $linksRegister->purchase_valuation_id;
            return view('backend.purchase_management.create', compact('purchase_valuation_id'));
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
       
        $this->validate($request, [
            'file_no' => 'required',
            'current_year' => 'required|date',
            'collection_contract_date' => 'required|date',
            'documents_attached' => 'required',
            'non_existence_document' => 'required',
            'vehicle_delivers' => 'required',
            'name' => 'required',
            'firts_surname' => 'required',
            'second_surtname' => 'required',
            'dni' => 'required|numeric',
            'birthdate' => 'required|date',
            'phone' => 'required',
            'email' => 'required|email',
            'street' => 'required',
            'nro_street' => 'required|numeric',
            'stairs' => 'required',
            'floor' => 'required',
            'letter' => 'required',
            'municipality' => 'required',
            'postal_code' => 'required',
            'province' => 'required',
            'iban' => 'required',
            'sale_amount' => 'required',
            'name_representantive' => 'required',
            'firts_surname_representative' => 'required',
            'second_surtname_representantive' => 'required',
            'dni_representative' => 'required|numeric',
            'birthdate_representative' => 'required|date',
            'phone_representantive' => 'required',
            'email_representative' => 'required|email',
            'representation_concept' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'version' => 'required',
            'type' => 'required',
            'kilometres' => 'required',
            'color' => 'required',
            'fuel' => 'required',
            'registration_number' => 'required|numeric',
            'registration_date' => 'required|date',
            'registration_country' => 'required',
            'frame_no' => 'required',
            'motor_no' => 'required',
            'vehicle_state_trafic' => 'required',
            'vehicle_state' => 'required'
        ]);

        $gestion = new PurchaseManagement($request->all());
       
        $gestion->save();

        return Redirect::to('/purchase_management')->with('notification', 'Gestion de compra creada exitosamente!');
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
