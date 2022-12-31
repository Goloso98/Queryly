<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function create(Request $request){
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'message' => 'required|string'
        ]);

        Contact::insert(['name' => $request->input('name'), 
                         'email' => $request->input('email'), 
                         'message' => $request->input('message')]);

        $request->session()->flash("alert-success","Your message was sent successfully!");

        return view("pages.contacts");
    }

    //Show Message
    public function showMessages() {
        $messages = Contact::all();
        return view('pages.messagesPage', ['messages' => $messages]);
    }

    //Delete Message
    public function delete(Request $request, $id)
    {
        $message = Contact::find($id);
        $message->delete();
        $request->session()->flash('alert-success', 'Message has been successfully deleted!');
        return redirect(route('admin.messages'));
    }
}