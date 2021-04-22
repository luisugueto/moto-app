<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DocumentsPurchaseValuation;
use App\Http\Requests;

class DocumentsPurchaseValuationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = DocumentsPurchaseValuation::all();
        $haspermision = getPermission('Empleados', 'record-create');
        return view('backend.documents_purchase_valuation.index', compact('haspermision'));
    }

    public function getDocumentsPurchaseValuations()
    {
        $purchases = DocumentsPurchaseValuation::all();

        $view = getPermission('Empleados', 'record-view');
        $edit = getPermission('Empleados', 'record-edit');
        $delete = getPermission('Empleados', 'record-delete');
        
        $data = array();
        foreach($purchases as $value){ 
            $row = array();        

            $row['id'] = $value['id'];
            $row['purchase_valuation_id'] = $value['purchase_valuation_id'];
            $row['name'] = $value['name'];
            $row['view'] = $view;
            $row['edit'] = $edit;
            $row['delete'] = $delete;
            $data[] = $row;
        }

        $json_data = array('data'=> $data);
        $json_data= collect($json_data);  

        return response()->json($json_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $documentFind = DocumentsPurchaseValuation::find($id);
        unlink(public_path().'/documents_purchase/'.$documentFind->name);
        $document = DocumentsPurchaseValuation::destroy($id);
        
        return response()->json($id);
    }
}
