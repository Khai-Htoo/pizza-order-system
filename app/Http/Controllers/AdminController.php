<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Storage;

class AdminController extends Controller
{
    // direct change password page
    public function changePasswordPage()
    {
        return view('admin.account.change');
    }
    // change password
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
    // direct account details page
    public function details()
    {
        return view('admin.account.details');
    }
    // direct edit Page
    public function edit()
    {
        return view('admin.account.edit');
    }
    // update account
    public function update($id, Request $req)
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
        return redirect()->route('admin#details')->with(['imageSuccess' => 'Image updated Success']);
    }

    // admin List
    function list() {
        $admin = User::when(request('key'), function ($query) {
            $query->orWhere('name', 'like', '%' . request('key') . '%')
                ->orWhere('email', 'like', '%' . request('key') . '%')
                ->orWhere('gender', 'like', '%' . request('key') . '%')
                ->orWhere('phone', 'like', '%' . request('key') . '%')
                ->orWhere('address', 'like', '%' . request('key') . '%');
        })
            ->where('role', 'admin')->paginate(3);

        return view('admin.account.list', compact('admin'));
    }
    // delete Admin Account
    public function delete($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['accdelete' => 'Account deleted success']);
    }
    // change role Page
    public function changeRole($id)
    {
        $account = User::where('id', $id)->first();
        return view('admin.account.changeRole', compact('account'));
    }
    // change Role
    public function change(Request $req, $id)
    {
        $data = $this->changeData($req);
        User::where('id', $id)->update($data);
        return redirect()->route('admin#list');
    }
    // change role data
    private function changeData($req)
    {
        return [
            'role' => $req->role,
        ];
    }
    // admin ajax change status
    public function changeStatus(Request $req)
    {
        User::where('id', $req->userId)->update([
            'role' => $req->role,
        ]);
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
            'image' => 'mimes:png,jpg,jpeg,WEBP',

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
