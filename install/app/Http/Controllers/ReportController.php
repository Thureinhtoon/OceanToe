<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Search;
use App\Seller;
use App\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MehediIitdu\CoreComponentRepository\CoreComponentRepository;

class ReportController extends Controller
{
    public function stock_report(Request $request)
    {
        $sort_by =null;
        $products = Product::orderBy('created_at', 'desc');
        if ($request->has('category_id')){
            $sort_by = $request->category_id;
            $products = $products->where('category_id', $sort_by);
        }
        $products = $products->paginate(15);
        return view('backend.reports.stock_report', compact('products','sort_by'));
    }

    // public function in_house_sale_report(Request $request)
    // {
    //     $sort_by =null;
    //     $products = Product::orderBy('num_of_sale', 'desc')->where('added_by', 'admin');
    //     if ($request->has('category_id')){
    //         $sort_by = $request->category_id;
    //         $products = $products->where('category_id', $sort_by);
    //     }
    //     $products = $products->paginate(15);
    //     return view('backend.reports.in_house_sale_report', compact('products','sort_by'));
    // }
    public function in_house_sale_report(Request $request)
    {
        $sort_by =null;
        $orderme = OrderDetail::leftJoin('products', function ($join) {
                        $join->on('products.id', '=', 'order_details.product_id');
                            })
                        ->where('order_details.payment_status', 'paid')
                        ->select(
                            DB::raw('SUM(order_details.quantity) as quantity'),
                            'products.name as name',
                            'order_details.price as price'
                        )
                        ->groupBy('order_details.product_id')
                        ->get();
// dd($orders[0]);

CoreComponentRepository::instantiateShopRepository();

$date = $request->date;
$sort_search = null;
$orders = Order::orderBy('code', 'desc');
if ($request->has('search')) {
    $sort_search = $request->search;
    $orders = $orders->where('code', 'like', '%' . $sort_search . '%');
}
if ($date != null) {
    $orders = $orders->where('created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])));
}
$orders = $orders->paginate(15);
// return view('backend.sales.all_orders.index', compact('orders', 'sort_search', 'date'));





        // $orders = DB::table('orders')->where('payment_status','paid')->get();
        $bb = Product::all();
        $products = Product::orderBy('num_of_sale', 'desc')->where('added_by', 'admin');
        if ($request->has('category_id')){
            $sort_by = $request->category_id;
            $products = $products->where('category_id', $sort_by);
        }
        $products = $products->paginate(15);
        for($i=0;$i<count($orderme);$i++){
            $tot=$orderme[$i]->price * $orderme[$i]->quantity;
            $orderme[$i]->tot=$tot;
        //    dd($orderme[$i]->name);
            // dd($bb);
        }
        // return $orderme->product_id;
        return view('backend.reports.in_house_sale_report', compact('bb','orders','sort_by','orderme', 'sort_search', 'date','products'));
    }

    public function seller_sale_report(Request $request)
    {
        $sort_by =null;
        $sellers = Seller::orderBy('created_at', 'desc');
        if ($request->has('verification_status')){
            $sort_by = $request->verification_status;
            $sellers = $sellers->where('verification_status', $sort_by);
        }
        $sellers = $sellers->paginate(10);
        return view('backend.reports.seller_sale_report', compact('sellers','sort_by'));
    }

    public function wish_report(Request $request)
    {
        $sort_by =null;
        $products = Product::orderBy('created_at', 'desc');
        if ($request->has('category_id')){
            $sort_by = $request->category_id;
            $products = $products->where('category_id', $sort_by);
        }
        $products = $products->paginate(10);
        return view('backend.reports.wish_report', compact('products','sort_by'));
    }

    public function user_search_report(Request $request){
        $searches = Search::orderBy('count', 'desc')->paginate(10);
        return view('backend.reports.user_search_report', compact('searches'));
    }
}
