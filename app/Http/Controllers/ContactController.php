<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //Contact Page
    public function contactPage()
    {
        return view('user.contact.contact');
    }
    // contact sent Page
    public function sent(Request $req)
    {
        $this->valadationCheck($req);
        $data = $this->sentData($req);
        Contact::create($data);
        return back();
    }
    // get contact data admin
    public function get()
    {
        $contact = Contact::orderBy('id', 'desc')->paginate(4);
        return view('admin.contact.contact', compact('contact'));
    }
    // delete message
    public function deleteSent($id)
    {
        Contact::where('id', $id)->delete();
        return back();
    }
    // validation check
    private function valadationCheck($req)
    {
        Validator::make($req->all(), ['name' => 'required',
            'email' => 'required',
            'message' => 'required'])->Validate();

    }
    // sent data
    private function sentData($req)
    {
        return [
            'name' => $req->name,
            'email' => $req->email,
            'message' => $req->message,
        ];
    }
}
