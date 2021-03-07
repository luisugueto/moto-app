<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\PurchaseValuation;
use App\ImagesPurchase;
use Redirect;
use Storage;
use DB;

class PurchaseValuationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchase_valuation = PurchaseValuation::all();

        

        return view('backend.purchase_valuation.index', compact('purchase_valuation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = DB::connection('recambio_ps')->table('ps_category')
                ->leftJoin('ps_category_lang', function($join)
                {
                    $join->on('ps_category_lang.id_category', '=', 'ps_category_lang.id_category');
                })
                ->select('ps_category.*', 'ps_category_lang.name as marca')
                ->where('ps_category.id_parent', '=', '13042')  
                ->where('ps_category_lang.id_lang', '=', '4')
                ->orderBy('ps_category_lang.name', 'asc')
                ->groupBy('ps_category_lang.name')
                ->limit(10)
                ->get();

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
        $purchase->save();

        foreach($request->images as $file){
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            Storage::disk('images_purchase')->put($fileNameToStore,  \File::get($file));

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
        //
    }
}
