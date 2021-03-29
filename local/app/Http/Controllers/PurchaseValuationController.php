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
        $purchase_valuation = PurchaseValuation::where('states_id', 0)->get();
        $states = States::all();
        $processes = Processes::all();
        $haspermision = auth()->user()->can('record-create');

        return view('backend.purchase_valuation.index', compact('purchase_valuation', 'states', 'processes', 'haspermision'));
    }

    public function getPurchaseValuations()
    {
        $purchases = PurchaseValuation::where('states_id', 0)->get();
        $view = auth()->user()->can('record-view');
        $edit = auth()->user()->can('record-edit');
        $delete = auth()->user()->can('record-delete');

        
        $row = [];  
        foreach($purchases as $value){  
                 
            $row['id'] = $value['id'];
            $row['date'] = $value['date'];
            $row['brand'] = $value['subject'];
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
   
        return view('backend.purchase_valuation.no_interested', compact('purchase_valuation', 'states', 'processes'));
    }

    public function interested()
    {
        $purchase_valuation = PurchaseValuation::where('states_id', 2)->get();
        $states = States::all();
        $processes = Processes::all();
   
        return view('backend.purchase_valuation.interested', compact('purchase_valuation', 'states', 'processes'));
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
        $purchase->states_id = 0; // En Revision
        $purchase->processes_id = 0; // Default
        $purchase->save();

        foreach($request->images as $file){
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            

            $image_resize = Image::make($file->getRealPath());
            $img = Image::make($file->getRealPath())->widen(250, function ($constraint) {
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
        $purchase = PurchaseValuation::find($id);
        $purchase->update($request->all());

        return Redirect::to('/purchase_valuation')->with('notification', 'Tasación editada exitosamente!');
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

        return Redirect::to('/purchase_valuation')->with('notification','Estado Cambiado Exitosamente!');
    }

    public function applyProcesses(Request $request)
    {
        $processes = Processes::find($request->applyProcess);

        foreach($request->apply as $purchase){

            $purchase_model = PurchaseValuation::find($purchase);
            $purchase_model->processes_id = $request->applyProcess;
            $purchase_model->update();
        }
        
        return Redirect::to('/purchase_valuation')->with('notification','Proceso Cambiado Exitosamente!');
    }

    public function showImages(Request $request)
    {
        $data = $request->id;
       
        $images = ImagesPurchase::where('purchase_valuation_id', $data)->get();        
        return response()->json(['success'=> 200, 'data' => $images]);
    }
}
