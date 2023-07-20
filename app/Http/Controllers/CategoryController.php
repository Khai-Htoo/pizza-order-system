<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // direct category list page
    function list() {
        $categories = Category::
            when(request('key'), function ($query) {
            $query->where('name', 'like', '%' . request('key') . '%');
        })
            ->orderBy('id', 'desc')
            ->paginate(4);
        return view('admin.category.list', compact('categories'));

    }
    // direct create page
    public function createPage()
    {
        return view('admin.category.create');
    }
    // category create
    public function create(Request $req)
    {
        $this->categoryValidationCheck($req);
        $data = $this->getData($req);
        Category::create($data);
        return redirect()->route('category#list')->with(['create' => 'Category Created']);
    }
    // category delete
    public function delete($id)
    {
        Category::where('id', $id)->delete();
        return back()->with(['delete' => 'Category Deleted']);
    }
    // category edit
    public function edit($id)
    {
        $category = Category::where('id', $id)->first();
        return view('admin.category.edit', compact('category'));
    }
    // category update
    public function update(Request $req)
    {
        $this->categoryValidationCheck($req);
        $data = $this->getData($req);
        Category::where('id', $req->categoryId)->update($data);
        return redirect()->route('category#list');
    }
    // private get data
    private function getData($req)
    {
        return [
            'name' => $req->categoryName,
        ];
    }
    // category create validation check
    private function categoryValidationCheck($req)
    {
        Validator::make($req->all(), [
            'categoryName' => 'required|unique:categories,name,' . $req->categoryId,
        ])->validate();
    }
}
