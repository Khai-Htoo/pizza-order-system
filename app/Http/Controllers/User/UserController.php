<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Storage;

class UserController extends Controller
{

//    user home page
    public function home()
    {
        $pizza = Product::orderBy('id', 'desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $history = Order::where('user_id', Auth::user()->id)->get();
        return view('user.main.home', compact('pizza', 'category', 'cart', 'history'));
    }
//  user change password page
    public function changePasswordPage()
    {
        return view('user.password.change');
    }
//  user change pass
    public function changePassword(Request $req)
    {

        $this->passwordValidationCheck($req);
        $currentId = Auth::user()->id;
        $user = User::select('password')->where('id', $currentId)->first();
        $dbPassword = $user->password;
        if (Hash::check($req->oldPassword, $dbPassword)) {
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($req->newPassword),
            ]);
            return back()->with(['change' => 'Password change success!']);
            Auth::logoutOtherDevices($dbPassword);
        }
        return back()->with(['notMatch' => 'The old password not Match,Try again!']);

    }
// account change page
    public function accountChangePage()
    {
        return view('user.profile.account');
    }
// user account change
    public function accountChange($id, Request $req)
    {
        $this->accountValidationCheck($req);
        $data = $this->getUserData($req);

// for image
        if ($req->hasFile('image')) {
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;

            if ($dbImage != null) {
                Storage::delete('public/', $dbImage);
            }

            $fileName = uniqid() . $req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        User::where('id', $id)->update($data);
        return back()->with(['updateSuccess' => 'profile updated Success']);

    }
// filter pizza
    public function filter($id)
    {
        $pizza = Product::where('category_id', $id)->orderBy('id', 'desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $history = Order::where('user_id', Auth::user()->id)->get();

        return view('user.main.home', compact('pizza', 'category', 'cart', 'history'));
    }
// pizza details
    public function details($id)
    {
        $pizza = Product::where('id', $id)->first();
        $list = Product::get();
        return view('user.main.details', compact('pizza', 'list'));
    }
// cart list
    function list() {
        $cartlist = Cart::select('carts.*', 'products.name as pizza_name', 'products.price as pizza_price', 'products.image as image')
            ->leftjoin('products', 'products.id', 'carts.product_id')
            ->where('carts.user_id', Auth::user()->id)
            ->get();

        $total = 0;
        foreach ($cartlist as $c) {
            $total += $c->pizza_price * $c->qty;
        }
        return view('user.main.cart', compact('cartlist', 'total'));
    }
// user history
    public function history()
    {
        $order = Order::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->paginate(4);
        return view('user.main.history', compact('order'));
    }

// get user data
    private function getUserData($req)
    {
        return [
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'address' => $req->address,
            'gender' => $req->gender,
            'updated_at' => Carbon::now(),
        ];
    }
// accont validation check
    private function accountValidationCheck($req)
    {
        Validator::make($req->all(), [
            'name' => 'required',
            'gender' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp',

        ])->validate();
    }
// password validation check
    private function passwordValidationCheck($req)
    {
        Validator::make($req->all(), [
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword',
        ])->validate();
    }

}
