<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactForm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function ProfileContact(){
        $contacts= Contact::all();
        return view('admin.contact.index',compact('contacts'));
    }

    public function AddContact(){
        return view('admin.contact.create');
    }

    public function StoreContact(Request $request){

        Contact::insert([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('profile.contact')->with('success', 'New Contact Inserted');
    }

    public function EditContact($id)
    {
        $contact = Contact::find($id);
        return view('admin.contact.edit', compact('contact'));
    }

    public function UpdateContact(Request $request, $id)
    {
        $validated = $request->validate(
            [
                'address' => 'required|min:5',
                'email' => 'required',
                'phone' => 'required|max:12',
            ]
        );
        Contact::find($id)->Update([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('profile.contact')->with('success', 'Contact Content Updated Successfully');
    }

    public function DeleteContact($id)
    {
        Contact::find($id)->delete();
        return Redirect()->back()->with('success', 'Contact Content Deleted Successfully');
    }

    public function MessageContact(){
        $messages= ContactForm::all();
        return view('admin.contact.messages',compact('messages'));
    }
    public function DeleteMessage($id){
        ContactForm::find($id)->delete();
        return Redirect()->back()->with('success', 'Message Deleted Successfully');
    }
    ///////////////////////HOME CONTACT PAGE////////////////////////////
    public function ContactPage(){
        $contacts =DB::table('contacts')->first();
        return view('pages.contact',compact('contacts'));
    }

    public function FormContact(Request $request){
        $validated = $request->validate(
            [
                'name' => 'required|min:5',
                'email' => 'required',
                'subject' => 'required|min:10',
                'message' => 'required|min:10',
            ]
        );
        ContactForm::insert([
            'name'=> $request->name,
            'email'=> $request->email,
            'subject'=> $request->subject,
            'message'=> $request->message,
            'created_at'=> Carbon::now(),
        ]);

        return Redirect()->route('contact')->with('success', 'Your Message has been Sent');
    }

}
