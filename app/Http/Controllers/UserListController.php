<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserListController extends Controller
{
    //User list Page
    function list() {
        $user = User::when(request('key'), function ($query) {
            $query->orWhere('name', 'like', '%' . request('key') . '%')
                ->orWhere('email', 'like', '%' . request('key') . '%')
                ->orWhere('gender', 'like', '%' . request('key') . '%')
                ->orWhere('phone', 'like', '%' . request('key') . '%')
                ->orWhere('address', 'like', '%' . request('key') . '%');
        })
            ->where('role', 'user')->paginate(3);
        return view('admin.userlist.userlist', compact('user'));
    }
    // delete Admin Account
    public function delete($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['accdelete' => 'Account deleted success']);
    }
    // user ajax change status
    public function changeUserStatus(Request $req)
    {
        User::where('id', $req->userId)->update([
            'role' => $req->role,
        ]);
    }

}
