<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Materials;
use App\Http\Requests;

class MaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view = getPermission('Materiales', 'record-view');

        if(!$view) return Redirect::to('/')->with('error', 'Usted no posee permisos!');

        $haspermision = getPermission('Materiales', 'record-create');
        return view('backend.materials.index', compact('haspermision'));
    }

    public function getMaterials()
    {
       
        $materials = Materials::get();
 
        $edit = getPermission('Materiales', 'record-edit');
        $delete = getPermission('Materiales', 'record-delete');

        $data = array(); 
        foreach($materials as $key => $value){  

            $row = array();      
            $row['id'] = $value->id;
            $row['LER'] = $value->LER;
            $row['code'] = $value->code;
            $row['description'] = $value->description;
            $row['valorization'] = $value->valorization;             
            $row['unit_of_measurement'] = $value->unit_of_measurement;
            $row['percent_formula'] = $value->percent_formula;           
            $row['type'] = $value->type;           
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
        $validator = \Validator::make($request->all(), ['code' => 'required|min:3', 'valorization' => 'required', 'description' => 'required', 'unit_of_measurement' => 'required', 'percent_formula' => 'required', 'type' => 'required']);

        if ($validator->fails()) {
            $out['code'] = 422;
            $out['message'] = 'Campos requeridos';
            $out['response'] = $validator->errors();
      
        } else {
            $materials = Materials::create($request->all());
            $out['code'] = 200;
            $out['message'] = 'Datos registrados exitosamente.';
            $out['response'] = $materials;
                 
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
        $material = Materials::find($id);
        return response()->json($material);
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
        $material = Materials::find($id);

        $validator = \Validator::make($request->all(), ['code' => 'required|min:3', 'valorization' => 'required', 'description' => 'required', 'unit_of_measurement' => 'required', 'percent_formula' => 'required', 'type' => 'required']);


        if ($validator->fails()) {
            $out['code'] = 422;
            $out['message'] = 'Campos requeridos';
            $out['response'] = $validator->errors();
      
        } else {
            $material->update($request->all());
            $out['code'] = 200;
            $out['message'] = 'Registro actualizado exitosamente.';
            $out['response'] = $material;
      
            
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
        $material = Materials::findOrFail($id);
        if(isset($material)){
            Materials::destroy($id);
            $out['code'] = 200;
            $out['message'] = 'Registro eliminado exitosamente';
        }
        else{
            $out['code'] = 422;
            $out['message'] = 'Material no encontrado! No se pudo eliminar.';
        }
        return response()->json($out);
    }
}
