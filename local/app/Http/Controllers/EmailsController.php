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
    public function index(Request $request)
    {       
        //dd(\Request::getRequestUri());
        $haspermision = getPermission('Mensajes', 'record-create');
        if(\Request::getRequestUri() == '/mensajes-gc')           
            return view('backend.emails.index', compact('haspermision'));
        
        if(\Request::getRequestUri() == '/mensajes')
            return view('backend.emails.index_business', compact('haspermision'));


    }
    
    public function getEmailsMotos()
    {
        $emails = Email::select(['id','name','subject','content'])->where('type', 1)->get();
        $view = getPermission('Mensajes', 'record-view');
        $edit = getPermission('Mensajes', 'record-edit');
        $delete = getPermission('Mensajes', 'record-delete');   
                           
        $data = array();  
        foreach($emails as $value){  

            $row = array();   
                 
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
        $json_data= collect($json_data);  
        return response()->json($json_data);
      
       
    }

    public function getEmailsBusiness()
    {
        $emails = Email::select(['id','name','subject','content'])->where('type', 2)->get();
        $view = getPermission('Mensajes', 'record-view');
        $edit = getPermission('Mensajes', 'record-edit');
        $delete = getPermission('Mensajes', 'record-delete');   
                           
        $data = array();  
        foreach($emails as $value){  

            $row = array();   
                 
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
            $out['code'] = 422;
            $out['message'] = 'Campos requeridos';
            $out['response'] = $validator->errors();
      
        } else {
            $email = Email::create($request->all());
            $out['code'] = 200;
            $out['message'] = 'Datos registrados exitosamente.';
            $out['response'] = $email;
        } 

        return response()->json($out);
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

        $validator = \Validator::make($request->all(), ['name' => 'required|string|min:5|max:100', 'subject' => 'required|string','content' => 'required|string|min:5']);

        if ($validator->fails()) {
            $out['code'] = 422;
            $out['message'] = 'Campos requeridos';
            $out['response'] = $validator->errors();
      
        } else {
            $email->update($request->all());
            $out['code'] = 200;
            $out['message'] = 'Registro actualizado exitosamente.';
            $out['response'] = $email;
      
            
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
        $email = Email::findOrFail($id);
        if(isset($email)){
            Email::destroy($id);
            $out['code'] = 200;
            $out['message'] = 'Registro eliminado exitosamente';
        }
        else{
            $out['code'] = 422;
            $out['message'] = 'Correo no encontrado! No se pudo eliminar.';
        }
        return response()->json($out);
    }

    public function view($id)
    {
       
    }
}
