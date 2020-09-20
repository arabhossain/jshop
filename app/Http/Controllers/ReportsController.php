<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;

        $shops = Shop::addSelect(['total' => Sale::selectRaw('sum(qty)')
            ->whereColumn('shop', 'shops.id')
        ]);

        if (!empty($keyword)) {
            $shops = $shops->whereHas('sales', function($q) use ($keyword){
                $q->whereHas('product', function($r) use ($keyword){
                    $r->whereHas('category', function($s) use ($keyword){
                        $s->where('name', 'LIKE', "%$keyword%");
                    });
                 });
            });
        }

        $shops = $shops
            ->orderBy('total', 'DESC')
            ->orderBy('shop_name', 'DESC')
            ->paginate($perPage);

        return view('client_list', compact('shops'));
    }


    public function saleDetails(Request $request){
        if(!$request->has('shop')){
            return response()->json(['message' => 'shop is required']);
        }

        $sales = Sale::where('shop', $request->shop)->orderBy('qty', 'DESC')->get();
        $salesSorted = [];
        foreach($sales as $sale){
            $product = $sale->product()->first();
            $salesSorted[] = [
                'product'   => $product->name,
                'Category'   => $product->category()->first()->name,
                'sale_count'   => $sale->qty,
                'total_price'   => number_format(((int) $sale->qty * (double) $product->price), 2),
            ];
        }

        return response()->json(['rows' => $salesSorted]);
    }

}
