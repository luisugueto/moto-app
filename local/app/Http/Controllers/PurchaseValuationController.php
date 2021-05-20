<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\PurchaseValuation;
use App\PurchaseManagement;
use App\ImagesPurchase;
use Redirect;
use Storage;
use DB;
use Mail;
use App\States;
use App\Processes;
use App\SubProcesses;
use App\Emails;
use App\DocumentsPurchaseValuation;
use App\LinksRegister;
use App\Forms;
use Yajra\Datatables\Datatables;

class PurchaseValuationController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => [
            'create', 'store'
        ]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $haspermision = getPermission('Motos que nos ofrecen', 'record-create');
        $states = States::all();
        $processes = Processes::all();
        $marcas = DB::connection('recambio_ps')->select("SELECT recambio_ps.ps_category.*,recambio_ps.ps_category_lang.name marca FROM recambio_ps.ps_category LEFT JOIN recambio_ps.ps_category_lang ON recambio_ps.ps_category.id_category=recambio_ps.ps_category_lang.id_category AND recambio_ps.ps_category_lang.id_lang='4' WHERE recambio_ps.ps_category.id_parent='13042' GROUP BY recambio_ps.ps_category_lang.name ORDER BY recambio_ps.ps_category_lang.name ASC");
   
        return view('backend.purchase_valuation.index', compact('states', 'processes', 'marcas', 'haspermision'));
    }

    public function getPurchaseValuations()
    {
        $purchases = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status')
        ->where('purchase_valuation.states_id', '=', 1)
        ->get();

        $view = getPermission('Motos que nos ofrecen', 'record-view');
        $edit = getPermission('Motos que nos ofrecen', 'record-edit');
        $delete = getPermission('Motos que nos ofrecen', 'record-delete');
        
        $data = array();
        foreach($purchases as $value){ 
            $row = array();        

            $row['id'] = $value->id;
            $row['date'] = $value->date;
            $row['brand'] = $value->brand;
            $row['model'] = $value->model;
            $row['year'] = $value->year;
            $row['km'] = $value->km;
            $row['email'] = $value->email;
            $row['name'] = $value->name;
            $row['lastname'] = $value->lastname;
            $row['phone'] = $value->phone;
            $row['province'] = $value->province;
            $row['status_trafic'] = $value->status_trafic;
            $row['motocycle_state'] = $value->motocycle_state;
            $row['price_min'] = $value->price_min;
            $row['observations'] = $value->observations;
            $row['states_id'] = $value->states_id;
            $row['subprocesses_id'] = $value->subprocesses_id;
            $row['status_ficha'] = $value->status;
            $row['view'] = $view;
            $row['edit'] = $edit;
            $row['delete'] = $delete;
            $data[] = $row;
        }

        $json_data = array('data'=> $data);
        $json_data= collect($json_data);  
       
        return response()->json($json_data);
    }

    public function getPurchaseValuationsInterested()
    {
        $purchases = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status')
        ->where('purchase_valuation.states_id', '=', 3)
        ->get();
        
        $view = getPermission('Motos que nos ofrecen', 'record-view');
        $edit = getPermission('Motos que nos ofrecen', 'record-edit');
        $delete = getPermission('Motos que nos ofrecen', 'record-delete');
        
        $data = array();
        foreach($purchases as $value){ 
 

            $row = array();      
            $row['id'] = $value->id;
            $row['date'] = $value->date;
            $row['brand'] = $value->brand;
            $row['model'] = $value->model;
            $row['year'] = $value->year;
            $row['km'] = $value->km;
            $row['email'] = $value->email;
            $row['name'] = $value->name;
            $row['lastname'] = $value->lastname;
            $row['phone'] = $value->phone;
            $row['province'] = $value->province;
            $row['status_trafic'] = $value->status_trafic;
            $row['motocycle_state'] = $value->motocycle_state;
            $row['price_min'] = $value->price_min;
            $row['observations'] = $value->observations;
            $row['states_id'] = $value->states_id;
            $row['subprocesses_id'] = $value->subprocesses_id;
            $row['status_ficha'] = $value->status;
            $row['view'] = $view;
            $row['edit'] = $edit;
            $row['delete'] = $delete;
            $data[] = $row;
        }

        $json_data = array('data'=> $data);
        $json_data= collect($json_data);  

        return response()->json($json_data);
    }

    public function getPurchaseValuationsNoInterested()
    {
        $purchases = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status')
        ->where('purchase_valuation.states_id', '=', 2)
        ->get();
        $view = getPermission('Motos que nos ofrecen', 'record-view');
        $edit = getPermission('Motos que nos ofrecen', 'record-edit');
        $delete = getPermission('Motos que nos ofrecen', 'record-delete');
        
        $data = array();
        foreach($purchases as $value){ 

            $row = array();  
                 
            $row['id'] = $value->id;
            $row['date'] = $value->date;
            $row['brand'] = $value->brand;
            $row['model'] = $value->model;
            $row['year'] = $value->year;
            $row['km'] = $value->km;
            $row['email'] = $value->email;
            $row['name'] = $value->name;
            $row['lastname'] = $value->lastname;
            $row['phone'] = $value->phone;
            $row['province'] = $value->province;
            $row['status_trafic'] = $value->status_trafic;
            $row['motocycle_state'] = $value->motocycle_state;
            $row['price_min'] = $value->price_min;
            $row['observations'] = $value->observations;
            $row['states_id'] = $value->states_id;
            $row['subprocesses_id'] = $value->subprocesses_id;
            $row['status_ficha'] = $value->status;
            $row['view'] = $view;
            $row['edit'] = $edit;
            $row['delete'] = $delete;
            $data[] = $row;
        }

        $json_data = array('data'=> $data);
        $json_data= collect($json_data);  
        return response()->json($json_data);
    }

    public function getPurchaseValuationsScrapping()
    {
        $purchases = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status')
        ->where('purchase_valuation.states_id', '=', 4)
        ->get();
        $view = getPermission('Motos que nos ofrecen', 'record-view');
        $edit = getPermission('Motos que nos ofrecen', 'record-edit');
        $delete = getPermission('Motos que nos ofrecen', 'record-delete');
        
        $data = array();
        foreach($purchases as $value){ 

            $row = array();  
                 
            $row['id'] = $value->id;
            $row['date'] = $value->date;
            $row['brand'] = $value->brand;
            $row['model'] = $value->model;
            $row['year'] = $value->year;
            $row['km'] = $value->km;
            $row['email'] = $value->email;
            $row['name'] = $value->name;
            $row['lastname'] = $value->lastname;
            $row['phone'] = $value->phone;
            $row['province'] = $value->province;
            $row['status_trafic'] = $value->status_trafic;
            $row['motocycle_state'] = $value->motocycle_state;
            $row['price_min'] = $value->price_min;
            $row['observations'] = $value->observations;
            $row['states_id'] = $value->states_id;
            $row['subprocesses_id'] = $value->subprocesses_id;
            $row['status_ficha'] = $value->status;
            $row['view'] = $view;
            $row['edit'] = $edit;
            $row['delete'] = $delete;
            $data[] = $row;
        }

        $json_data = array('data'=> $data);
        $json_data= collect($json_data);  
        return response()->json($json_data);
    }

    public function getPurchaseValuationsSale()
    {
        $purchases = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status')
        ->where('purchase_valuation.states_id', '=', 5)
        ->get();
        $view = getPermission('Motos que nos ofrecen', 'record-view');
        $edit = getPermission('Motos que nos ofrecen', 'record-edit');
        $delete = getPermission('Motos que nos ofrecen', 'record-delete');
        
        $data = array();
        foreach($purchases as $value){ 

            $row = array();  
                 
            $row['id'] = $value->id;
            $row['date'] = $value->date;
            $row['brand'] = $value->brand;
            $row['model'] = $value->model;
            $row['year'] = $value->year;
            $row['km'] = $value->km;
            $row['email'] = $value->email;
            $row['name'] = $value->name;
            $row['lastname'] = $value->lastname;
            $row['phone'] = $value->phone;
            $row['province'] = $value->province;
            $row['status_trafic'] = $value->status_trafic;
            $row['motocycle_state'] = $value->motocycle_state;
            $row['price_min'] = $value->price_min;
            $row['observations'] = $value->observations;
            $row['states_id'] = $value->states_id;
            $row['subprocesses_id'] = $value->subprocesses_id;
            $row['status_ficha'] = $value->status;
            $row['view'] = $view;
            $row['edit'] = $edit;
            $row['delete'] = $delete;
            $data[] = $row;
        }

        $json_data = array('data'=> $data);
        $json_data= collect($json_data);  
        return response()->json($json_data);
    }

    public function getPurchaseValuationsAuction()
    {
        $purchases = DB::table('purchase_valuation')
        ->leftjoin('purchase_management', 'purchase_valuation.id', '=', 'purchase_management.purchase_valuation_id')
        ->select('purchase_valuation.*', 'purchase_management.status')
        ->where('purchase_valuation.states_id', '=', 6)
        ->get();
        $view = getPermission('Motos que nos ofrecen', 'record-view');
        $edit = getPermission('Motos que nos ofrecen', 'record-edit');
        $delete = getPermission('Motos que nos ofrecen', 'record-delete');
        
        $data = array();
        foreach($purchases as $value){ 

            $row = array();  
            
            $row['id'] = $value->id;
            $row['date'] = $value->date;
            $row['brand'] = $value->brand;
            $row['model'] = $value->model;
            $row['year'] = $value->year;
            $row['km'] = $value->km;
            $row['email'] = $value->email;
            $row['name'] = $value->name;
            $row['lastname'] = $value->lastname;
            $row['phone'] = $value->phone;
            $row['province'] = $value->province;
            $row['status_trafic'] = $value->status_trafic;
            $row['motocycle_state'] = $value->motocycle_state;
            $row['price_min'] = $value->price_min;
            $row['observations'] = $value->observations;
            $row['states_id'] = $value->states_id;
            $row['subprocesses_id'] = $value->subprocesses_id;
            $row['status_ficha'] = $value->status;
            $row['publish'] = $value->publish;
            $row['view'] = $view;
            $row['edit'] = $edit;
            $row['delete'] = $delete;
            $data[] = $row;
        }

        $json_data = array('data'=> $data);
        $json_data= collect($json_data);  
        return response()->json($json_data);
    }

    public function noInterested()
    {
        $purchase_valuation =  PurchaseValuation::where('states_id', 2)->get();
        $states = States::all();
        $processes = Processes::all();
        $marcas = DB::connection('recambio_ps')->select("SELECT recambio_ps.ps_category.*,recambio_ps.ps_category_lang.name marca FROM recambio_ps.ps_category LEFT JOIN recambio_ps.ps_category_lang ON recambio_ps.ps_category.id_category=recambio_ps.ps_category_lang.id_category AND recambio_ps.ps_category_lang.id_lang='4' WHERE recambio_ps.ps_category.id_parent='13042' GROUP BY recambio_ps.ps_category_lang.name ORDER BY recambio_ps.ps_category_lang.name ASC");
   
        return view('backend.purchase_valuation.no_interested', compact('purchase_valuation', 'states', 'processes', 'marcas'));
    }

    public function interested()
    {
        $purchase_valuation = PurchaseValuation::where('states_id', 3)->get();
        $states = States::all();
        $processes = Processes::all();
        $marcas = DB::connection('recambio_ps')->select("SELECT recambio_ps.ps_category.*,recambio_ps.ps_category_lang.name marca FROM recambio_ps.ps_category LEFT JOIN recambio_ps.ps_category_lang ON recambio_ps.ps_category.id_category=recambio_ps.ps_category_lang.id_category AND recambio_ps.ps_category_lang.id_lang='4' WHERE recambio_ps.ps_category.id_parent='13042' GROUP BY recambio_ps.ps_category_lang.name ORDER BY recambio_ps.ps_category_lang.name ASC");
   
        return view('backend.purchase_valuation.interested', compact('purchase_valuation', 'states', 'processes', 'marcas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = DB::connection('recambio_ps')->select("SELECT recambio_ps.ps_category.*,recambio_ps.ps_category_lang.name marca FROM recambio_ps.ps_category LEFT JOIN recambio_ps.ps_category_lang ON recambio_ps.ps_category.id_category=recambio_ps.ps_category_lang.id_category AND recambio_ps.ps_category_lang.id_lang='4' WHERE recambio_ps.ps_category.id_parent='13042' GROUP BY recambio_ps.ps_category_lang.name ORDER BY recambio_ps.ps_category_lang.name ASC");

        return view('backend.purchase_valuation.create', compact('marcas'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $purchase = new PurchaseValuation($request->all());
        $purchase->date = date('Y-m-d');
        $purchase->states_id = 1; // En Revisión
        $purchase->subprocesses_id = 0; // Default
        $purchase->save();

        foreach($request->images as $file){
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            

            $image_resize = \Image::make($file->getRealPath());
            $img = \Image::make($file->getRealPath())->widen(250, function ($constraint) {
                $constraint->upsize();
            });

            $img->stream();

            Storage::disk('images_purchase')->put($fileNameToStore, $img);
            // Storage::disk('images_purchase')->put($fileNameToStore,  \File::get($file));

            $images_purchase = new ImagesPurchase();
            $images_purchase->purchase_valuation_id = $purchase->id;
            $images_purchase->name = $fileNameToStore;
            $images_purchase->save();
        }

        return Redirect::to('https://motostion.com/');
        // return Redirect::to('/motos-que-nos-ofrecen')->with('notification', 'Tasación creada exitosamente!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchase_valuation = PurchaseValuation::find($id);
        $forms = Forms::select(['form_display'])->where('name', 'Complemento motos que nos ofrecen')->first();
        $images = ImagesPurchase::where('purchase_valuation_id', $purchase_valuation->id)->get();  

        $data['id'] = $purchase_valuation['id'];
        $data['date'] = $purchase_valuation['date'];
        $data['brand'] = $purchase_valuation['brand'];
        $data['model'] = $purchase_valuation['model'];
        $data['year'] = $purchase_valuation['year'];
        $data['km'] = $purchase_valuation['km'];
        $data['email'] = $purchase_valuation['email'];
        $data['name'] = $purchase_valuation['name'];
        $data['lastname'] = $purchase_valuation['lastname'];
        $data['phone'] = $purchase_valuation['phone'];
        $data['province'] = $purchase_valuation['province'];
        $data['status_trafic'] = $purchase_valuation['status_trafic'];
        $data['motocycle_state'] = $purchase_valuation['motocycle_state'];
        $data['price_min'] = $purchase_valuation['price_min'];
        $data['observations'] = $purchase_valuation['observations'];
        $data['form_display'] = htmlspecialchars_decode($forms->form_display);
        $data['data_serialize'] = utf8_encode($purchase_valuation['data_serialize']);
        $data['images_purchase_valuation'] = $images;
        $data['link'] = url('/');
        // dd(htmlspecialchars_decode($forms->form_display));

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase = PurchaseValuation::find($id);
        $images = ImagesPurchase::where('purchase_valuation_id', $purchase->id)->get();     
        $marcas = DB::connection('recambio_ps')->select("SELECT recambio_ps.ps_category.*,recambio_ps.ps_category_lang.name marca FROM recambio_ps.ps_category LEFT JOIN recambio_ps.ps_category_lang ON recambio_ps.ps_category.id_category=recambio_ps.ps_category_lang.id_category AND recambio_ps.ps_category_lang.id_lang='4' WHERE recambio_ps.ps_category.id_parent='13042' GROUP BY recambio_ps.ps_category_lang.name ORDER BY recambio_ps.ps_category_lang.name ASC");

        return view('backend.purchase_valuation.edit', compact('purchase', 'marcas', 'images'));  
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
        // dd($request->all());
        $validator = \Validator::make($request->all(),[
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required', 
            'km' => 'required', 
            'email' => 'required', 
            'name' => 'required', 
            'lastname' => 'required', 
            'phone' => 'required', 
            'province' => 'required', 
            'price_min' => 'required', 
            'observations' => 'required',
        ]);

        if ($validator->fails()) {
            $out['code'] = 422;
            $out['response'] = $validator->errors();
            $out['message'] = 'Errores de validacion';            
            
        }
        if (!$validator->fails()) {
            $purchase = PurchaseValuation::find($id);
            $input = $request->all();
            $purchase->update($input);

            $out['code'] = 200;
            $out['response'] = $purchase;
            $out['message'] = 'Registro Actualizado Exitosamente';
            
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
        $purchase = PurchaseValuation::destroy($id);
        
        return response()->json($purchase);
    }

    public function applyState(Request $request)
    {
        $state = States::find($request->applyState);
        $motos = explode(",", $request->apply);
       
        $out['code'] = 204;
        $out['message'] = 'Hubo un error';

        foreach($motos as $purchase) {
             
            $purchase_model = PurchaseValuation::find($purchase);
            $purchase_model->states_id = $request->applyState;
            $purchase_model->update();

            $token = create_token();

            if($request->applyState == 3){ // CHECK IF IS INTERESTED
                $linksRegister = new LinksRegister();
                $linksRegister->token = $token;
                $linksRegister->purchase_valuation_id = $purchase_model->id;
                $linksRegister->status = 0;
                $linksRegister->save();
               
                $purchase_management = new PurchaseManagement();
                $purchase_management->purchase_valuation_id = $purchase_model->id;
                $purchase_management->file_no = $purchase_model->id;
                $purchase_management->current_year = $purchase_model->date;
                $purchase_management->collection_contract_date = date('Y-m-d');
                $purchase_management->documents_attached = '';
                $purchase_management->non_existence_document = '';
                $purchase_management->vehicle_delivers = '';
                $purchase_management->name = $purchase_model->name;
                $purchase_management->firts_surname = $purchase_model->lastname;
                $purchase_management->second_surtname = '';
                $purchase_management->dni = '';
                $purchase_management->birthdate = '';
                $purchase_management->phone = $purchase_model->phone;
                $purchase_management->email = $purchase_model->email;
                $purchase_management->street = '';
                $purchase_management->nro_street = '';
                $purchase_management->stairs = '';
                $purchase_management->floor = '';
                $purchase_management->letter = '';
                $purchase_management->municipality = '';
                $purchase_management->postal_code = '';
                $purchase_management->province = '';
                $purchase_management->iban = '';
                $purchase_management->sale_amount = $purchase_model->price_min;
                $purchase_management->name_representantive = '';
                $purchase_management->firts_surname_representative = '';
                $purchase_management->second_surtname_representantive = '';
                $purchase_management->dni_representative = '';
                $purchase_management->birthdate_representative = '';
                $purchase_management->phone_representantive = '';
                $purchase_management->email_representative = '';
                $purchase_management->representation_concept = '';
                $purchase_management->brand = $purchase_model->brand;
                $purchase_management->model = $purchase_model->model;
                $purchase_management->version = '';
                $purchase_management->type = '';
                $purchase_management->kilometres = $purchase_model->km;
                $purchase_management->color = '';
                $purchase_management->fuel = '';
                $purchase_management->registration_number = '';
                $purchase_management->registration_date = '';
                $purchase_management->registration_country = '';
                $purchase_management->frame_no = '';
                $purchase_management->motor_no = '';
                $purchase_management->vehicle_state_trafic = $purchase_model->status_trafic;
                $purchase_management->vehicle_state = '';
                $purchase_management->save();
            }

            $subprocesses = [];
            // ENVIAR CORREO
            Mail::send('backend.emails.template', ['purchase' => $purchase_model, 'state' => $state, 'token' => $token, 'subprocesses' => $subprocesses], function ($message) use ($state, $purchase_model)
            {
                $message->from('ugueto.luis19@gmail.com', 'MotOstion');

                // SE ENVIARA A
                $message->to($purchase_model->email)->subject($state->name);
            });
            $out['code'] = 200;
            $out['data'] = $purchase;
            $out['message'] = 'Estado Actualizado Exitosamente';
        }
        
        return response()->json($out);
    }

    public function applyProcesses(Request $request)
    {
        // $processes = Processes::find($request->applyProcess);
        // $motos = explode(",", $request->apply);

        // $out['code'] = 204;
        // $out['message'] = 'Hubo un error';
        
        // foreach($motos as &$purchase) {

        //     $purchase_model = PurchaseValuation::find($purchase);
        //     // $purchase_model->processes_id = $request->applyProcess;
        //     $purchase_model->update();

        //     $out['code'] = 200;
        //     $out['data'] = $purchase;
        //     $out['message'] = 'Estado Actualizado Exitosamente';
        // }
        $subprocesses = SubProcesses::find($request->subprocesses_id);
        $purchase = PurchaseValuation::find($request->purchase_id);
        $purchase->subprocesses_id = $request->subprocesses_id;
        $purchase->update();

        $state = [];
        $token = '';

        if($subprocesses->email->id != 7){ // SINO ES PLANTILLA DEFAULT ENVIA CORREO
            Mail::send('backend.emails.template', ['purchase' => $purchase, 'subprocesses' => $subprocesses, 'state' => $state, 'token' => $token], function ($message) use ($subprocesses, $purchase)
                {
                    $message->from('ugueto.luis19@gmail.com', 'MotOstion');

                    // SE ENVIARA A
                    $message->to($purchase->email)->subject($subprocesses->name);
                });
        }

        $out['code'] = 200;
        $out['data'] = $purchase;
        $out['message'] = 'Se ha aplicado el proceso Exitosamente';

        return response()->json($out);
    }

    public function showImages(Request $request)
    {
        $data = $request->id;
       
        $images = ImagesPurchase::where('purchase_valuation_id', $data)->get();        
        return response()->json(['success'=> 200, 'data' => $images]);
    }

    public function uploadDocument(Request $request)
    {
        $path = public_path().'/documents_purchase/';
        $files = $request->file('file');
        foreach($files as $file){
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $file->move($path, $fileNameToStore);

            $projectImage = new DocumentsPurchaseValuation();
            $projectImage->purchase_valuation_id = $request->id;
            $projectImage->name = $fileNameToStore;
            $projectImage->save();
        }
    }

    public function uploadImage(Request $request)
    {
        $path = public_path().'/img_app/images_purchase/';
        $files = $request->file('file');
        foreach($files as $file){
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $file->move($path, $fileNameToStore);

            $images_purchase = new ImagesPurchase();
            $images_purchase->purchase_valuation_id = $request->id;
            $images_purchase->name = $fileNameToStore;
            $images_purchase->save();
        }
    }

    public function showFicha()
    {
        $states = States::all();
        $processes = Processes::all();
        $marcas = DB::connection('recambio_ps')->select("SELECT recambio_ps.ps_category.*,recambio_ps.ps_category_lang.name marca FROM recambio_ps.ps_category LEFT JOIN recambio_ps.ps_category_lang ON recambio_ps.ps_category.id_category=recambio_ps.ps_category_lang.id_category AND recambio_ps.ps_category_lang.id_lang='4' WHERE recambio_ps.ps_category.id_parent='13042' GROUP BY recambio_ps.ps_category_lang.name ORDER BY recambio_ps.ps_category_lang.name ASC");   

        return view('backend.purchase_valuation.ficha', compact('states', 'processes', 'marcas'));

    }

    public function getDataFicha($id)
    {
        $purchase_valuation = PurchaseValuation::find($id);
        $documents_purchase_valuation = DocumentsPurchaseValuation::where('purchase_valuation_id', $id)->get();
        $images_purchase_valuation = ImagesPurchase::where('purchase_valuation_id', $id)->get();
        $purchase_management = PurchaseManagement::where('purchase_valuation_id', $id)->first();
        $forms = Forms::select(['form_display'])->where('name', 'Complemento motos que nos ofrecen')->first(); 
        $subprocesses_id = $purchase_valuation['subprocesses_id'];
        
        $processes = DB::table('processes')
        ->join('subprocesses', 'processes.id', '=', 'subprocesses.processes_id')
        ->select('processes.name', 'subprocesses.name as subproceso')
        ->where(function ($query) use ($subprocesses_id) {
                $query->where('subprocesses.id', '=' , $subprocesses_id);
        })
        ->groupBy(DB::raw('processes.id'))
        ->get();
        
        $data['id'] = $purchase_valuation['id'];
        $data['date'] = $purchase_valuation['date'];
        $data['brand'] = $purchase_valuation['brand'];
        $data['model'] = $purchase_valuation['model'];
        $data['year'] = $purchase_valuation['year'];
        $data['km'] = $purchase_valuation['km'];
        $data['email'] = $purchase_valuation['email'];
        $data['name'] = $purchase_valuation['name'];
        $data['lastname'] = $purchase_valuation['lastname'];
        $data['phone'] = $purchase_valuation['phone'];
        $data['province'] = $purchase_valuation['province'];
        $data['status_trafic'] = $purchase_valuation['status_trafic'];
        $data['motocycle_state'] = $purchase_valuation['motocycle_state'];
        $data['price_min'] = $purchase_valuation['price_min'];
        $data['observations'] = $purchase_valuation['observations'];
        $data['form_display'] = htmlspecialchars_decode($forms->form_display);
        $data['data_serialize'] = ($purchase_valuation['data_serialize']);
        $data['states_id'] = $purchase_valuation['states_id'];
        $data['processes'] = $processes;

        //Datos Purchase Management
        $data['file_no'] = $purchase_management['file_no'];
        $data['current_year'] = date('Y-m-d');
        $data['collection_contract_date'] = $purchase_management['collection_contract_date'];
        $data['documents_attached'] = $purchase_management['documents_attached'];
        $data['non_existence_document'] = $purchase_management['non_existence_document'];
        $data['vehicle_delivers'] = $purchase_management['vehicle_delivers'];
        $data['firts_name'] = $purchase_management['name'];
        $data['firts_surname'] = $purchase_management['firts_surname'];
        $data['second_surtname'] = $purchase_management['second_surtname'];
        $data['dni'] = $purchase_management['dni'];
        $data['birthdate'] = $purchase_management['birthdate'];
        $data['phone_management'] = $purchase_management['phone'];
        $data['email_management'] = $purchase_management['email'];
        $data['street'] = $purchase_management['street'];
        $data['nro_street'] = $purchase_management['nro_street'];
        $data['stairs'] = $purchase_management['stairs'];
        $data['floor'] = $purchase_management['floor'];
        $data['letter'] = $purchase_management['letter'];
        $data['municipality'] = $purchase_management['municipality'];
        $data['postal_code'] = $purchase_management['postal_code'];
        $data['province_management'] = $purchase_management['province'];
        $data['iban'] = $purchase_management['iban'];
        $data['sale_amount'] = $purchase_management['sale_amount'];
        $data['name_representantive'] = $purchase_management['name_representantive'];
        $data['firts_surname_representative'] = $purchase_management['firts_surname_representative'];
        $data['second_surtname_representantive'] = $purchase_management['second_surtname_representantive'];
        $data['dni_representative'] = $purchase_management['dni_representative'];
        $data['birthdate_representative'] = $purchase_management['birthdate_representative'];
        $data['phone_representantive'] = $purchase_management['phone_representantive'];
        $data['email_representative'] = $purchase_management['email_representative'];
        $data['representation_concept'] = $purchase_management['representation_concept'];
        $data['brand_management'] = $purchase_management['brand'];
        $data['model_management'] = $purchase_management['model'];
        $data['version'] = $purchase_management['version'];
        $data['type'] = $purchase_management['type'];
        $data['kilometres'] = $purchase_management['kilometres'];
        $data['color'] = $purchase_management['color'];
        $data['fuel'] = $purchase_management['fuel'];
        $data['registration_number'] = $purchase_management['registration_number'];
        $data['registration_date'] = $purchase_management['registration_date'];
        $data['registration_country'] = $purchase_management['registration_country'];
        $data['frame_no'] = $purchase_management['frame_no'];
        $data['motor_no'] = $purchase_management['motor_no'];
        $data['vehicle_state_trafic'] = $purchase_management['vehicle_state_trafic'];
        $data['vehicle_state'] = $purchase_management['vehicle_state'];

        //
        $data['documents_purchase_valuation'] = $documents_purchase_valuation;
        $data['images_purchase_valuation'] = $images_purchase_valuation;

        // GET DOCS FORM MAIL INTERESTED
        $data['dni_doc'] = $purchase_management['dni_doc'];
        $data['per_circulacion'] = $purchase_management['per_circulacion'];
        $data['ficha_tecnica'] = $purchase_management['ficha_tecnica'];
        $data['other_docs'] = $purchase_management['other_docs'];        
        
        $data['link'] = url('/');
 
        return response()->json($data);

    }

    public function updateFicha(Request $request)
    {
        $purchase = PurchaseValuation::find($request->purchase_id);
        $purchase->date = $request->date;
        $purchase->brand = $request->brand;
        $purchase->model = $request->model;
        $purchase->year = $request->year;
        $purchase->km = $request->km;
        $purchase->email = $request->email;
        $purchase->name = $request->name;
        $purchase->lastname = $request->lastname;
        $purchase->phone = $request->phone;
        $purchase->province = $request->province;
        $purchase->status_trafic = $request->status_trafic;
        $purchase->motocycle_state = $request->motocycle_state;
        $purchase->price_min = $request->price_min;
        $purchase->observations = $request->observations;
        $purchase->data_serialize = $request->data_serialize;
        $purchase->update();

        if($request->documents_attached == 'on'){
            $documents_attached = 1;
        }
        if($request->non_existence_document == 'on'){
            $non_existence_document = 1;
        }

        $purchaseM = PurchaseManagement::where('purchase_valuation_id', $purchase->id)->first();
        
        $purchase_management = PurchaseManagement::find($purchaseM->id);
        $purchase_management->file_no = $request->file_no;
        $purchase_management->current_year = $request->current_year;
        $purchase_management->collection_contract_date = $request->collection_contract_date;
        $purchase_management->documents_attached = $documents_attached;
        $purchase_management->non_existence_document = $non_existence_document;     
        $purchase_management->vehicle_delivers = $request->vehicle_delivers;
        $purchase_management->name = $request->firts_name;
        $purchase_management->firts_surname = $request->firts_surname;
        $purchase_management->second_surtname = $request->second_surtname;
        $purchase_management->dni = $request->dni;
        $purchase_management->birthdate = $request->birthdate;
        $purchase_management->phone = $request->phone_management;
        $purchase_management->email = $request->email_management;
        $purchase_management->street = $request->street;
        $purchase_management->nro_street = $request->nro_street;
        $purchase_management->stairs = $request->stairs;
        $purchase_management->floor = $request->floor;
        $purchase_management->letter = $request->letter;
        $purchase_management->municipality = $request->municipality;
        $purchase_management->postal_code = $request->postal_code;
        $purchase_management->province = $request->province;
        $purchase_management->iban = $request->iban;
        $purchase_management->sale_amount = $request->sale_amount;
        $purchase_management->name_representantive = $request->name_representantive;
        $purchase_management->firts_surname_representative = $request->firts_surname_representative;
        $purchase_management->second_surtname_representantive = $request->second_surtname_representantive;
        $purchase_management->dni_representative = $request->dni_representative;
        $purchase_management->birthdate_representative = $request->birthdate_representative;
        $purchase_management->phone_representantive = $request->phone_representantive;
        $purchase_management->email_representative = $request->email_representative;
        $purchase_management->representation_concept = $request->representation_concept;
        $purchase_management->brand = $request->brand;
        $purchase_management->model = $request->model_management;
        $purchase_management->version = $request->version;
        $purchase_management->type = $request->type;
        $purchase_management->kilometres = $request->kilometres;
        $purchase_management->color = $request->color;
        $purchase_management->fuel = $request->fuel;
        $purchase_management->registration_number = $request->registration_number;
        $purchase_management->registration_date = $request->registration_date;
        $purchase_management->registration_country = $request->registration_country;
        $purchase_management->frame_no = $request->frame_no;
        $purchase_management->motor_no = $request->motor_no;
        $purchase_management->vehicle_state_trafic = $request->vehicle_state_trafic;
        $purchase_management->vehicle_state = $request->vehicle_state;
        $purchase_management->update();

        // CREATE PDF
        $view =  \View::make('pdf.ficha', compact('purchase', 'purchase_management'))->render(); // send data to view
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        $output = $pdf->output();
        $nameFile ='Ficha'.date('y-m-d-h-i-s').'.pdf';
        file_put_contents( public_path().'/pdfs/'.$nameFile, $output);


        $json_data = array('data'=> $purchase_management);
        $json_data= collect($json_data);  

        $out['code'] = 200;
        $out['data'] = $json_data;
        $out['message'] = 'Registro Actualizado Exitosamente. <br> <a href="'.url('/local/public/pdfs/').'/'.$nameFile.'" target="_blank"> Descargar Ficha </a>';

        return response()->json($out);
    }

    public function PublishMotocycle(Request $request)
    {
        $user = PurchaseValuation::findOrFail($request->id);
        $status = '';
        $mensaje = '';
        if ($user->publish == 0) {
            $status = 1;
            $mensaje = 'Moto publicada exitosamente. !';
        }
        if ($user->publish == 1) {
            $status = 0;
            $mensaje = 'Moto despublicada exitosamente. !';
        }

        $user->publish = $status;
        $user->save();

        $data['code']    = 200;
        $data['message'] = $mensaje;

        return response()->json($data);
    }

    public function verifyFicha(Request $request)
    {
        $purchase = PurchaseManagement::where('purchase_valuation_id', $request->id)->first();
        $purchase->status = 2;
        $purchase->update();

        $data['code']    = 200;
        $data['message'] = "Ficha de la Moto VERIFICADA!";

        return response()->json($data);
    }
    

    public function document($fileName){
        $path = public_path().'/documents_purchase/'.$fileName;
        return \Response::download($path);        
    }

    public function image($fileName){
        $path = public_path().'/images_purchase/'.$fileName;
        return \Response::download($path);        
    }
}
