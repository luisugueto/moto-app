<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        getPermission('Administración', 'record-view');

        $invoices = DB::connection('recambio_ps')->table('ps_category_lang')->offset(0)->limit(10)->get();        
        return view('welcome', compact('invoices'));
    }

    public function getModel(Request $request) {
        $model = DB::connection('recambio_ps')->select("SELECT recambio_ps.ps_category.*,recambio_ps.ps_category_lang.name marca FROM recambio_ps.ps_category LEFT JOIN recambio_ps.ps_category_lang ON recambio_ps.ps_category.id_category=recambio_ps.ps_category_lang.id_category AND recambio_ps.ps_category_lang.id_lang='4' WHERE recambio_ps.ps_category.id_parent=".$request->id." GROUP BY recambio_ps.ps_category_lang.name ORDER BY recambio_ps.ps_category_lang.name ASC");

        if( $request->ajax() ) {
            return response()->json([
                'model' => $model
            ]);
        }
    }

    public function proximamente()
    {
        return view('backend.proximamente.index');
    }
}
