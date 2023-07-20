<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    // pizzaList
    public function pizzaList(Request $req)
    {

        if ($req->status == 'desc') {
            $data = Product::orderBy('id', 'desc')->get();
        } else if ($req->status == 'asc') {
            $data = Product::orderBy('id', 'asc')->get();
        }

        return $data;
    }
    //  Add to cart
    public function pizzaCart(Request $req)
    {
        $data = $this->getData($req);
        Cart::create($data);
        $response = [
            'message' => 'add to cart complete',
            'status' => 'success',
        ];
        return response()->json($response, 200);
    }
    // order
    public function order(Request $req)
    {
        $total = 0;
        foreach ($req->all() as $r) {
            $data = OrderList::create([
                'user_id' => $r['user_id'],
                'product_id' => $r['product_id'],
                'qty' => $r['qty'],
                'total' => $r['total'],
                'order_code' => $r['order_code'],
            ]);
            $total += $data->total;
        }
        Cart::where('user_id', Auth::user()->id)->delete();
        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total + 2000,
        ]);
        return response()->json([
            'status' => 'true',
        ], 200);

    }
    // cart clear
    public function clear()
    {
        Cart::where('user_id', Auth::user()->id)->delete();
    }
    // remove button
    public function remove(Request $req)
    {
        Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $req->productId)
            ->where('id', $req->id)
            ->delete();
    }
    // increase view count
    public function view(Request $req)
    {
        $pizza = Product::where('id', $req->productId)->first();
        $view = [
            'view_count' => $pizza->view_count + 1,
        ];
        Product::where('id', $req->productId)->update($view);
    }
    // private get data
    private function getData($req)
    {
        return [
            'user_id' => $req->userId,
            'product_id' => $req->pizzaId,
            'qty' => $req->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
