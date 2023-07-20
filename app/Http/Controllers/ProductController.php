<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Storage;

class ProductController extends Controller
{
    // product list
    function list() {
        $pizzas = Product::select('products.*', 'categories.name as category_name')
            ->when(request('key'), function ($query) {
                $query->where('products.name', 'like', '%' . request('key') . '%');
            })
            ->leftJoin('categories', 'products.category_id', 'categories.id', )
            ->orderBy('products.id', 'desc')
            ->paginate(3);
        $pizzas->appends(request()->all());
        return view('admin.product.pizzaList', compact('pizzas'));
    }
    // direct pizza create page
    public function createPage()
    {
        $category = Category::select('id', 'name')->get();
        return view('admin.product.create', compact('category'));
    }
    // pizza create
    public function create(Request $req)
    {
        $this->productValidationCheck($req, "create");
        $data = $this->productGetData($req);
        if ($req->hasFile('image')) {
            $fileName = uniqid() . $req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public/' . $fileName);
            $data['image'] = $fileName;

        }

        Product::create($data);
        return redirect()->route('product#list')->with(['pizza' => 'Pizza Created Success']);

    }
    // pizza delete
    public function delete($id)
    {
        Product::where('id', $id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess' => 'Pizza delete success']);
    }
    // pizza edit
    public function edit($id)
    {
        $pizzas = Product::select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.id', )
            ->where('products.id', $id)->first();
        return view('admin.product.edit', compact('pizzas'));
    }
    // pizza updatePage
    public function updatePage($id)
    {
        $pizzas = Product::where('id', $id)->first();
        $category = Category::get();
        return view('admin.product.update', compact('pizzas', 'category'));
    }
    // pizza update
    public function update(Request $req)
    {
        $this->productValidationCheck($req, "update");
        $data = $this->productGetData($req);

        if ($req->hasFile('image')) {
            $dbImage = Product::where('id', $req->pizzaId)->first();
            $dbImage = $dbImage->image;

            if ($req->file('image') != null) {
                Storage::delete('public/' . $dbImage);
            }

            $fileName = uniqid() . $req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public/' . $fileName);
            $data['image'] = $fileName;

        }

        Product::where('id', $req->pizzaId)->update($data);
        return redirect()->route('product#list');

    }

    // product validation check
    private function productValidationCheck($req, $action)
    {
        $validationRules = [
            'name' => 'required|min:5|unique:products,name',
            'price' => 'required',
            'description' => 'required',
            'category' => 'required',
            'time' => 'required',
        ];

        $validationRules['image'] = $action == "create" ? "required|mimes:jpeg,jpg,png,webp" : "mimes:jpeg,jpg,png,webp";
        $validationRules['name'] = $action == "create" ? 'required|min:5|unique:products,name,' : 'required|min:5';

        Validator::make($req->all(), $validationRules)->validate();
    }

    private function productGetData($req)
    {
        return [
            'name' => $req->name,
            'price' => $req->price,
            'description' => $req->description,
            'category_id' => $req->category,
            'waiting_time' => $req->time,
        ];
    }

}
