<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests;
use Redirect;
use App\Email;


class EmailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $haspermision = auth()->user()->can('record-create');
        return view('backend.emails.index', compact('haspermision'));
    }
    
    public function getEmails()
    {
        $emails = Email::select(['id','name','subject','content'])->get();
        $view = auth()->user()->can('record-view');
        $edit = auth()->user()->can('record-edit');
        $delete = auth()->user()->can('record-delete');

        
        $row = [];  
        foreach($emails as $value){  
                 
            $row['id'] = $value['id'];
            $row['name'] = $value['name'];
            $row['subject'] = $value['subject'];
            $row['content'] = $value['content'];
            $row['view'] = $view;
            $row['edit'] = $edit;
            $row['delete'] = $delete;
            $data[] = $row;
        }

        $json_data = array('data'=> $data);
        return response()->json($json_data);
      
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.emails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), ['name' => 'required|string|min:5|max:100', 'subject' => 'required|string','content' => 'required|string|min:5']);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $email = Email::create($request->all());
            
            return response()->json($email);
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
        $email = Email::find($id);
        return response()->json($email);
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
        $email = Email::find($id);
        $email->update($request->all());
        return response()->json($email);
        // return Redirect::to('/emails')->with('notification', 'Correo editado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $email = Email::findOrFail($id);
        if(isset($email)){
            Email::destroy($id);
            return response()->json($email);
            // return Redirect::to('/emails')->with('notification', 'Correo eliminado exitosamente!');
        }
        else{
            return response()->json('Correo no encontrado! No se pudo eliminar', 422);
            // return Redirect::to('/emails')->with('notification', 'Correo no encontrado! No se pudo eliminar');
        }
    }

    public function view($id)
    {
       
    }
}
