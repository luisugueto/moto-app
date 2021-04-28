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
use App\Emails;
use App\DocumentsPurchaseValuation;
use App\LinksRegister;
use App\Forms;
use Yajra\Datatables\Datatables;

class PurchaseValuationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $haspermision = getPermission('Empleados', 'record-create');
        $states = States::all();
        $processes = Processes::all();
        
        $marcas = DB::connection('recambio_ps')->select("SELECT recambio_ps.ps_category.*,recambio_ps.ps_category_lang.name marca FROM recambio_ps.ps_category LEFT JOIN recambio_ps.ps_category_lang ON recambio_ps.ps_category.id_category=recambio_ps.ps_category_lang.id_category AND recambio_ps.ps_category_lang.id_lang='4' WHERE recambio_ps.ps_category.id_parent='13042' GROUP BY recambio_ps.ps_category_lang.name ORDER BY recambio_ps.ps_category_lang.name ASC");
   
        return view('backend.purchase_valuation.index', compact('states', 'processes', 'marcas', 'haspermision'));
    }

    public function getPurchaseValuations()
    {
        $purchases = PurchaseValuation::where('states_id', 1)->get();

        $view = getPermission('Empleados', 'record-view');
        $edit = getPermission('Empleados', 'record-edit');
        $delete = getPermission('Empleados', 'record-delete');
        
        $data = array();
        foreach($purchases as $value){ 
            $row = array();        

            $row['id'] = $value['id'];
            $row['date'] = $value['date'];
            $row['brand'] = $value['brand'];
            $row['model'] = $value['model'];
            $row['year'] = $value['year'];
            $row['km'] = $value['km'];
            $row['email'] = $value['email'];
            $row['name'] = $value['name'];
            $row['lastname'] = $value['lastname'];
            $row['phone'] = $value['phone'];
            $row['province'] = $value['province'];
            $row['status_trafic'] = $value['status_trafic'];
            $row['g_del'] = $value['g_del'];
            $row['g_tras'] = $value['g_tras'];
            $row['av_elec'] = $value['av_elec'];
            $row['av_mec'] = $value['av_mec'];
            $row['old'] = $value['old'];
            $row['price_min'] = $value['price_min'];
            $row['observations'] = $value['observations'];
            $row['states_id'] = $value['states_id'];
            $row['processes_id'] = $value['processes_id'];
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
        $purchases = PurchaseValuation::where('states_id', 3)->get();
        $view = getPermission('Empleados', 'record-view');
        $edit = getPermission('Empleados', 'record-edit');
        $delete = getPermission('Empleados', 'record-delete');
        
        $data = array();
        foreach($purchases as $value){ 

            $row = array();      
            $row['id'] = $value['id'];
            $row['date'] = $value['date'];
            $row['brand'] = $value['brand'];
            $row['model'] = $value['model'];
            $row['year'] = $value['year'];
            $row['km'] = $value['km'];
            $row['email'] = $value['email'];
            $row['name'] = $value['name'];
            $row['lastname'] = $value['lastname'];
            $row['phone'] = $value['phone'];
            $row['province'] = $value['province'];
            $row['status_trafic'] = $value['status_trafic'];
            $row['g_del'] = $value['g_del'];
            $row['g_tras'] = $value['g_tras'];
            $row['av_elec'] = $value['av_elec'];
            $row['av_mec'] = $value['av_mec'];
            $row['old'] = $value['old'];
            $row['price_min'] = $value['price_min'];
            $row['observations'] = $value['observations'];
            $row['states_id'] = $value['states_id'];
            $row['processes_id'] = $value['processes_id'];
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
        $purchases = PurchaseValuation::where('states_id', 2)->get();
        $view = getPermission('Empleados', 'record-view');
        $edit = getPermission('Empleados', 'record-edit');
        $delete = getPermission('Empleados', 'record-delete');
        
        $data = array();
        foreach($purchases as $value){ 

            $row = array();  
                 
            $row['id'] = $value['id'];
            $row['date'] = $value['date'];
            $row['brand'] = $value['brand'];
            $row['model'] = $value['model'];
            $row['year'] = $value['year'];
            $row['km'] = $value['km'];
            $row['email'] = $value['email'];
            $row['name'] = $value['name'];
            $row['lastname'] = $value['lastname'];
            $row['phone'] = $value['phone'];
            $row['province'] = $value['province'];
            $row['status_trafic'] = $value['status_trafic'];
            $row['g_del'] = $value['g_del'];
            $row['g_tras'] = $value['g_tras'];
            $row['av_elec'] = $value['av_elec'];
            $row['av_mec'] = $value['av_mec'];
            $row['old'] = $value['old'];
            $row['price_min'] = $value['price_min'];
            $row['observations'] = $value['observations'];
            $row['states_id'] = $value['states_id'];
            $row['processes_id'] = $value['processes_id'];
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
        $purchase_valuation = PurchaseValuation::where('states_id', 2)->get();
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
        $purchase = new PurchaseValuation($request->all());
        $purchase->date = date('Y-m-d');
        $purchase->states_id = 1; // En Revisión
        $purchase->processes_id = 1; // Default
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

        return Redirect::to('/motos-que-nos-ofrecen')->with('notification', 'Tasación creada exitosamente!');

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
        $data['g_del'] = $purchase_valuation['g_del'];
        $data['g_tras'] = $purchase_valuation['g_tras'];
        $data['av_elec'] = $purchase_valuation['av_elec'];
        $data['av_mec'] = $purchase_valuation['av_mec'];
        $data['old'] = $purchase_valuation['old'];
        $data['price_min'] = $purchase_valuation['price_min'];
        $data['observations'] = $purchase_valuation['observations'];
        $data['form_display'] = htmlspecialchars_decode($forms->form_display);
        $data['data_serialize'] = utf8_encode($purchase_valuation['data_serialize']);
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
        //dd($request->all());
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
            'observations' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $purchase = PurchaseValuation::find($id);
            $input = $request->all();
            $purchase->update($input);

            return response()->json($purchase);
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
        $purchase = PurchaseValuation::destroy($id);
        
        return response()->json($purchase);
    }

    public function applyState(Request $request)
    {
        $state = States::find($request->applyState);

        foreach($request->apply as $purchase){

            $purchase_model = PurchaseValuation::find($purchase);
            $purchase_model->states_id = $request->applyState;
            $purchase_model->update();

            $token = create_token();

            if($request->applyState == 3){ // CHECK IF IS INTERESTED
                $linksRegister = new LinksRegister();
                $linksRegister->token = $token;
                $linksRegister->purchase_valuation_id = $purchase;
                $linksRegister->save();
            }


            // ENVIAR CORREO
            Mail::send('backend.emails.template', ['purchase' => $purchase_model, 'state' => $state, 'token' => $token], function ($message) use ($state, $purchase_model)
            {
                $message->from('ugueto.luis19@gmail.com', 'MotOstion');

                // SE ENVIARA A
                $message->to($purchase_model->email)->subject($state->name);
            });
        }

        return Redirect::back()->with('notification','Estado Cambiado Exitosamente!');
    }

    public function applyProcesses(Request $request)
    {
        $processes = Processes::find($request->applyProcess);

        foreach($request->apply as $purchase){

            $purchase_model = PurchaseValuation::find($purchase);
            $purchase_model->processes_id = $request->applyProcess;
            $purchase_model->update();
        }
        
        return Redirect::back()->with('notification','Proceso Cambiado Exitosamente!');
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
        }

        $projectImage = new DocumentsPurchaseValuation();
        $projectImage->purchase_valuation_id = $request->id;
        $projectImage->name = $fileNameToStore;
        $projectImage->save();
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
        $purchase_management = PurchaseManagement::where('purchase_valuation_id', $id)->first();
        $forms = Forms::select(['form_display'])->where('name', 'Complemento motos que nos ofrecen')->first();

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
        $data['g_del'] = $purchase_valuation['g_del'];
        $data['g_tras'] = $purchase_valuation['g_tras'];
        $data['av_elec'] = $purchase_valuation['av_elec'];
        $data['av_mec'] = $purchase_valuation['av_mec'];
        $data['old'] = $purchase_valuation['old'];
        $data['price_min'] = $purchase_valuation['price_min'];
        $data['observations'] = $purchase_valuation['observations'];
        $data['form_display'] = htmlspecialchars_decode($forms->form_display);
        $data['data_serialize'] = utf8_encode($purchase_valuation['data_serialize']);


        //Datos Purchase Management
        $data['file_no'] = $purchase_management['file_no'];
        $data['current_year'] = $purchase_management['current_year'];
        $data['collection_contract_date'] = $purchase_management['collection_contract_date'];
        $data['documents_attached'] = $purchase_management['documents_attached'];
        $data['non_existence_document'] = $purchase_management['non_existence_document'];
        $data['vehicle_delivers'] = $purchase_management['vehicle_delivers'];
        $data['firts_name'] = $purchase_management['name'];
        $data['firts_surname'] = $purchase_management['firts_surname'];
        $data['second_surtname'] = $purchase_management['second_surtname'];
        $data['dni'] = $purchase_management['dni'];
        $data['birthdate'] = $purchase_management['birthdate'];
        $data['phone'] = $purchase_management['phone'];
        $data['email'] = $purchase_management['email'];
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
 
        return response()->json($data);

    }

    public function updateFicha(Request $request, $id)
    {
         
    }
}
