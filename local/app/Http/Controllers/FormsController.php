<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Forms;
use Redirect;
use App\Http\Requests;

class FormsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $create = auth()->user()->can('record-create');
        return view('backend.forms.index', compact('create'));
    }

    public function getForms()
    {
        $forms = Forms::select(['id','name','form_original','form_display','status']);
        return Datatables::of($forms)
 
            ->make(true);
 
        // $view = auth()->user()->can('record-view');
        // $edit = auth()->user()->can('record-edit');
        // $delete = auth()->user()->can('record-delete');    
            
        // $row = [];  
      
        // foreach($forms as $key => $value){  
                    
        //     $row['id'] = $value->id;
        //     $row['name'] = $value->name;
        //     $row['status'] = $value->status;
        //     // $row['view'] = $view;
        //     // $row['edit'] = $edit;
        //     // $row['delete'] = $delete;
        //     $data[] = $row;
        // }
        
        // $json_data = array('data'=> $data);        
        // return response()->json($json_data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.forms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $validator = \Validator::make($request->all(), ['name' => 'required']);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $input = $request->all();
            $input['name'] = $input['name'];
            $input['form_original'] = ($input['form_original']);
            $input['form_display'] = ($input['form']);

            $form = Forms::create($input);
            return response()->json($form);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $form = Forms::find($id);
        $json_data = array(
            "id_form" => $form->id,
            "form_original" => utf8_encode($form->form_original),
        );
        return response()->json($json_data);
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
        $form = Forms::find($id);
        $validator = \Validator::make($request->all(), ['name' => 'required']);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $form->name = $request->name;
            $form->form_original = $request->form_original;
            $form->form_display = $request->form;
            $form->save();
            return response()->json($form);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $form = Forms::destroy($id);
        return response()->json($form);
    }
}
