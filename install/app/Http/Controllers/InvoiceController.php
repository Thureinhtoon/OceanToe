<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use App\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    //downloads customer invoice
    public function customer_invoice_download($id)
    {
        $order = Order::findOrFail($id);
        $pdf = PDF::setOptions([
                        'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
                        'logOutputFile' => storage_path('logs/log.htm'),
                        'tempDir' => storage_path('logs/')
                    ])->loadView('backend.invoices.customer_invoice', compact('order'));
        return $pdf->download('order-'.$order->code.'.pdf');
    }
public function inhouse_invoice_download()
    {
//         $orderme = OrderDetail::leftJoin('products', function ($join) {
//     $join->on('products.id', '=', 'order_details.product_id');
// })
//     ->where('order_details.payment_status', 'paid')
//     ->get();
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

 
for($i=0;$i<count($orderme);$i++){
            $tot=$orderme[$i]->price * $orderme[$i]->quantity;
            $orderme[$i]->tot=$tot;
}
        $pdf = PDF::setOptions([
                        'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
                        'logOutputFile' => storage_path('logs/log.htm'),
                        'tempDir' => storage_path('logs/')
                    ])->loadView('backend.invoices.inhouse_report',compact('orderme'));
        return $pdf->download('inhouse-invoice'.'.pdf');
        
        
    }

    //downloads seller invoice
    public function seller_invoice_download($id)
    {
        $order = Order::findOrFail($id);
        $pdf = PDF::setOptions([
                        'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
                        'logOutputFile' => storage_path('logs/log.htm'),
                        'tempDir' => storage_path('logs/')
                    ])->loadView('backend.invoices.seller_invoice', compact('order'));
        return $pdf->download('order-'.$order->code.'.pdf');
    }

    //downloads admin invoice
    public function admin_invoice_download($id)
    {
        $order = Order::findOrFail($id);
        $pdf = PDF::setOptions([
                        'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
                        'logOutputFile' => storage_path('logs/log.htm'),
                        'tempDir' => storage_path('logs/')
                    ])->loadView('backend.invoices.admin_invoice', compact('order'));
        return $pdf->download('order-'.$order->code.'.pdf');
    }
}
