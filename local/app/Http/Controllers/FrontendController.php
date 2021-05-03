<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests;
use App\PurchaseValuation;
use App\ImagesPurchase;
use DB;
 

class FrontendController extends Controller
{
    public function index(){
        
        $purchases = DB::select('SELECT p.*, i.name AS imagen FROM purchase_valuation AS p LEFT JOIN images_purchase AS i ON i.id =( SELECT pi.id FROM images_purchase AS pi WHERE pi.purchase_valuation_id = p.id ORDER BY pi.id ASC LIMIT 1 ) WHERE p.publish = 1 ORDER BY p.id ASC LIMIT 3');
        return view('index', compact('purchases'));
    }

    public function motos(Request $request){

        $purchases = DB::select('SELECT p.*, i.name AS imagen FROM purchase_valuation AS p LEFT JOIN images_purchase AS i ON i.id =( SELECT pi.id FROM images_purchase AS pi WHERE pi.purchase_valuation_id = p.id ORDER BY pi.id ASC LIMIT 1 ) WHERE p.publish = 1 ');

        $purchases = $this->arrayPaginator($purchases, $request); 
        
        $purchases_last = DB::select('SELECT p.*, i.name AS imagen FROM purchase_valuation AS p LEFT JOIN images_purchase AS i ON i.id =( SELECT pi.id FROM images_purchase AS pi WHERE pi.purchase_valuation_id = p.id ORDER BY pi.id DESC LIMIT 1 ) WHERE p.publish = 1 ');

        return view('motos', compact('purchases'));
    }

    public function carrito(){
        return view('cart');
    }

    public function contacto(){
        return view('contacto');
    }

    public function arrayPaginator($array, $request)
    {
        $page = \Request::get('page', 1);
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);
    }
}
