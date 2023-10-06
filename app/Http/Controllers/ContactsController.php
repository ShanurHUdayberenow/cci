<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Informations;

class ContactsController extends Controller
{
    public function __invoke()
    {
        $address = Informations::get();
        $contacts = Contact::get();
        $title = __('main.controllers.contacts');

//        \Storage::disk('google')->put('test.txt', 'Test');

        return view('org.contacts', compact('title', 'address', 'contacts'));
    }
}
