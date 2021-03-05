<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

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
        return view('welcome');
    }

    public function getModel(Request $request) {
        // SELECT ps_category.*,ps_category_lang.name marca FROM ps_category LEFT JOIN ps_category_lang ON ps_category.id_category=ps_category_lang.id_category AND ps_category_lang.id_lang='4' WHERE ps_category.id_parent='$id' ORDER BY ps_category_lang.name ASC
        
        $model = DB::table('ps_category')
                ->leftJoin('ps_category_lang', function($join)
                {
                    $join->on('ps_category_lang.id_category', '=', 'ps_category_lang.id_category')
                    ->on('ps_category_lang.id_lang', '=', '4');
                })
                ->select('ps_category.*,ps_category_lang.name marca')
                ->where('ps_category.id_parent', $request->id)
                ->orderBy('ps_category_lang.name', 'asc')
                ->get();

        if( $request->ajax() ) {
            return response()->json([
                'model' => $model
            ]);
        }
    }
}
