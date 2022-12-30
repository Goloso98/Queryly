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

        return view("pages.contacts");
    }
}