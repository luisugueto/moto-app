<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $invoices = DB::connection('recambio_ps')->table('ps_category_lang')->offset(0)->limit(10)->get();        
        return view('welcome', compact('invoices'));

    }

    public function getModel(Request $request) {
        // SELECT ps_category.*,ps_category_lang.name marca FROM ps_category LEFT JOIN ps_category_lang ON ps_category.id_category=ps_category_lang.id_category AND ps_category_lang.id_lang='4' WHERE ps_category.id_parent='$id' ORDER BY ps_category_lang.name ASC
        
        // $model = DB::connection('recambio_ps')->table('ps_category')
        //         ->leftJoin('ps_category_lang', function($join)
        //         {
        //             $join->on('ps_category_lang.id_category', '=', 'ps_category_lang.id_category')
        //             ->on('ps_category_lang.id_lang', '=', '4');
        //         })
        //         ->select('ps_category.*,ps_category_lang.name as marca')
        //         ->where('ps_category.id_parent', $request->id)
        //         ->orderBy('ps_category_lang.name', 'asc')
        //         ->get();

        $model = DB::connection('recambio_ps')->table('ps_category')
                ->leftJoin('ps_category_lang', function($join)
                {
                    $join->on('ps_category_lang.id_category', '=', 'ps_category_lang.id_category');
                })
                ->select('ps_category.*', 'ps_category_lang.name as marca')
                ->where('ps_category.id_parent', '=', $request->id)
                ->where('ps_category_lang.id_lang', '=', '4')
                ->orderBy('ps_category_lang.name', 'asc')
                ->groupBy('ps_category_lang.name')
                ->get();

        if( $request->ajax() ) {
            return response()->json([
                'model' => $model
            ]);
        }
    }
}
