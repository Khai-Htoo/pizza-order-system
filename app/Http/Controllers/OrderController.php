<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // order list page
    public function order()
    {
        $order = Order::when(request('key'), function ($query) {
            $query->orWhere('user_id', 'like', '%' . request('key') . '%')
                ->orWhere('name', 'like', '%' . request('key') . '%')
                ->orWhere('order_code', 'like', '%' . request('key') . '%')
                ->orWhere('total_price', 'like', '%' . request('key') . '%');
        })
            ->orderBy('id', 'desc')->select('orders.*', 'users.name as name')
            ->leftjoin('users', 'users.id', 'orders.user_id')
            ->get();
        return view('admin.order.orderList', compact('order'));
    }
    // orderlist show
    public function orderList($orderCode)
    {
        $orderTotal = Order::where('order_code', $orderCode)->first();
        $order = OrderList::select('order_lists.*', 'users.name as name', 'products.name as productname', 'products.image as image')
            ->leftjoin('users', 'users.id', 'order_lists.user_id')
            ->leftjoin('products', 'products.id', 'order_lists.product_id')
            ->where('order_code', $orderCode)
            ->get();
        return view('admin.order.orderShow', compact('order', 'orderTotal'));
    }

    // ajax status
    public function status(Request $req)
    {

        // $req->status = $req->status == null ? "" : $req->status;
        // ->get();
        // orwhere('orders.status', $req->status)

        $order = Order::orderBy('id', 'desc')->select('orders.*', 'users.name as name')
            ->leftjoin('users', 'users.id', 'orders.user_id');

        if ($req->status == null) {
            $order = $order->get();
        } else {
            $order = $order->orwhere('orders.status', $req->status)->get();
        }

        return view('admin.order.orderList', compact('order'));

    }
    // ajax change status
    public function changestatus(Request $req)
    {
        Order::where('id', $req->orderId)->update([
            'status' => $req->status,
        ]);
    }
}
