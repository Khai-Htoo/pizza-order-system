<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\OrderList;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    //get all product list
    public function productList()
    {
        $product = Product::get();
        $user = User::get();
        $data = [
            'product' => $product,
            'user' => $user,
        ];
        return response()->json($data, 200);
    }
    // get all category list
    public function categoryList()
    {
        $category = Category::get();
        return response()->json($category, 200);
    }
    // get all contact list
    public function contactList()
    {
        $contact = Contact::get();
        return response()->json($contact, 200);
    }
    // get all order list
    public function orderList()
    {
        $contact = OrderList::get();
        return response()->json($contact, 200);
    }
    // create category
    public function categoryCreate(Request $req)
    {
        $data = [
            'name' => $req->name,
            'updated_at' => Carbon::now(),
        ];

        $response = Category::create($data);
        return response()->json($response, 200);
    }
    // create contact
    public function contactCreate(Request $req)
    {
        $data = [
            'name' => $req->name,
            'email' => $req->email,
            'message' => $req->message,
            'updated_at' => Carbon::now(),
        ];

        $response = Contact::create($data);
        return response()->json($response, 200);
    }
    // delete category
    public function delete($id, Request $req)
    {
        $data = Category::where('id', $id)->first();
        if (isset($data)) {
            Category::where('id', $id)->delete();
            return response()->json(['status' => true, 'message' => 'delete success'], 200, );

        }
        return response()->json(['status' => false, 'message' => 'There is no category'], 200, );

    }
    // delete category
    public function details(Request $req)
    {
        $data = Category::where('id', $req->id)->first();
        if (isset($data)) {

            return response()->json(['status' => true, 'category' => $data], 200, );

        }
        return response()->json(['status' => false, 'message' => 'There is no category'], 500, );

    }
    // update category
    public function update(Request $req)
    {
        $data = $this->getData($req);
        $dbsource = Category::where('id', $req->id)->first();
        if (isset($dbsource)) {
            $data = $this->getData($req);
            $response = Category::where('id', $req->id)->update($data);
            return response()->json(['status' => true, 'category' => $response], 200, );
        }
        return response()->json(['status' => false, 'message' => 'There is no category'], 500, );

    }
    // get data
    private function getData($req)
    {
        return [
            'name' => $req->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

}
