<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\PurchaseValuation;
use App\ImagesPurchase;
use Redirect;
use Storage;
use DB;
use Mail;
use App\States;
use App\Processes;
use App\Emails;
use App\DocumentsPurchaseValuation;
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
        $states = States::all();
        $processes = Processes::all();
        $marcas = DB::connection('recambio_ps')->select("SELECT recambio_ps.ps_category.*,recambio_ps.ps_category_lang.name marca FROM recambio_ps.ps_category LEFT JOIN recambio_ps.ps_category_lang ON recambio_ps.ps_category.id_category=recambio_ps.ps_category_lang.id_category AND recambio_ps.ps_category_lang.id_lang='4' WHERE recambio_ps.ps_category.id_parent='13042' GROUP BY recambio_ps.ps_category_lang.name ORDER BY recambio_ps.ps_category_lang.name ASC");
   
        return view('backend.purchase_valuation.index', compact('states', 'processes', 'marcas'));
    }

    public function getPurchaseValuations()
    {
        $purchases = PurchaseValuation::where('states_id', 0)->get();

        // return Datatables::of($purchases)
 
        // ->make(true);
        $view = auth()->user()->can('record-view');
        $edit = auth()->user()->can('record-edit');
        $delete = auth()->user()->can('record-delete');
        

        $row = [];  
        foreach($purchases as $value){    
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
        
       
        return response()->json($json_data);
    }

    public function getPurchaseValuationsInterested()
    {
        $purchases = PurchaseValuation::where('states_id', 2)->get();
        $view = auth()->user()->can('record-view');
        $edit = auth()->user()->can('record-edit');
        $delete = auth()->user()->can('record-delete');
        
        $row = [];  
        foreach($purchases as $value){  
                 
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
        return response()->json($json_data);
    }

    public function getPurchaseValuationsNoInterested()
    {
        $purchases = PurchaseValuation::where('states_id', 1)->get();
        $view = auth()->user()->can('record-view');
        $edit = auth()->user()->can('record-edit');
        $delete = auth()->user()->can('record-delete');
        
        $row = [];  
        foreach($purchases as $value){  
                 
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
        return response()->json($json_data);
    }

    public function noInterested()
    {
        $purchase_valuation = PurchaseValuation::where('states_id', 1)->get();
        $states = States::all();
        $processes = Processes::all();
        $marcas = DB::connection('recambio_ps')->select("SELECT recambio_ps.ps_category.*,recambio_ps.ps_category_lang.name marca FROM recambio_ps.ps_category LEFT JOIN recambio_ps.ps_category_lang ON recambio_ps.ps_category.id_category=recambio_ps.ps_category_lang.id_category AND recambio_ps.ps_category_lang.id_lang='4' WHERE recambio_ps.ps_category.id_parent='13042' GROUP BY recambio_ps.ps_category_lang.name ORDER BY recambio_ps.ps_category_lang.name ASC");
   
        return view('backend.purchase_valuation.no_interested', compact('purchase_valuation', 'states', 'processes', 'marcas'));
    }

    public function interested()
    {
        $purchase_valuation = PurchaseValuation::where('states_id', 2)->get();
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
        $purchase->states_id = 0; // En Revisión
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

        return Redirect::to('/purchase_valuation')->with('notification', 'Tasación creada exitosamente!');

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

            // ENVIAR CORREO
            Mail::send('backend.emails.template', ['purchase' => $purchase_model, 'state' => $state], function ($message) use ($state, $purchase_model)
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
}
