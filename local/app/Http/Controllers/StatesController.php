<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\States;
use App\Email;
use Redirect;
use App\Http\Requests;

class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = States::all();
        $emails = Email::all();
        return view('backend.states.index', compact('states', 'emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $emails = Email::all();
        return view('backend.states.create', compact('emails'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        $validator = \Validator::make($request->all(), ['name' => 'required', 'email_id' => 'required']);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $state = States::create($request->all());
            $email = Email::where('id', $state->email_id)->first();
            
            $data = [
                'id' => $state->id,
                'name' => $state->name,
                'description' => $state->description,
                'email' => $email->name,
                'status' => $state->status,
            ];
            return response()->json($data);
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
        $state = States::find($id);
        return response()->json($state);
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
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'email_id' => 'required'
        ]);
            
        $state = States::find($id);
        $state->name = $request->name;
        $state->description = $request->description;
        $state->email_id = $request->email_id;
        $state->save();

        $email = Email::where('id', $state->email_id)->first();
        $data = [

            'id' => $state->id,
            'name' => $state->name,
            'description' => $state->description,
            'email' => $email->name,
            'status' => $state->status,
        ];

        return response()->json($data);
        // return Redirect::to('/states')->with('notification', 'Estado modificado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state = States::destroy($id);
        return response()->json($state);
        // return Redirect::to('/states')->with('notification', 'Registro eliminado exitosamente!');
    }
 
}
