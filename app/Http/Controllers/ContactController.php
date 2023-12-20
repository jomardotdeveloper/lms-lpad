<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Department;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->getTitle();
        $contacts = Contact::all();

        if(isset($_GET['is_student'])) {
          $contacts = Contact::student()->get();
        } else if(isset($_GET['is_teacher'])) {
          $contacts = Contact::teacher()->get();
        } else if(isset($_GET['is_admin'])) {
          $contacts = Contact::admin()->get();
        }

        return view('contact.index', compact('contacts' , 'title'));
    }

    private function getTitle(){
        if(isset($_GET['is_student'])) {
            return "Students";
        } else if(isset($_GET['is_teacher'])) {
            return "Teachers";
        } else if(isset($_GET['is_admin'])) {
            return "Admins";
        }
        return "Contacts";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->getTitle();
        $sections = Section::all();
        $departments = Department::all();
        return view('contact.create', compact('sections', 'departments' , 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
          'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          'email' => 'required|email|unique:users,email',
          'password' => 'required|min:8',
        ]);
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $user = User::create([
          'email' => $data['email'],
          'password' => $data['password'],
        ]);

        $data['user_id'] = $user->id;

        // check if data has is_admin key
        if(isset($data['is_admin'])) {
            $data['is_admin'] = true;
        } else {
            $data['is_admin'] = false;
        }

        // check if data has is_student key

        if(isset($data['is_student'])) {
            $data['is_student'] = true;
        } else {
            $data['is_student'] = false;
        }

        // check if data has is_teacher key

        if(isset($data['is_teacher'])) {
            $data['is_teacher'] = true;
        } else {
            $data['is_teacher'] = false;
        }

        $params = "";

        if($data['is_student']) {
            $params .= "is_student";
        }

        if($data['is_teacher']) {
            $params .= "is_teacher";
        }

        if($data['is_admin']) {
            $params .= "is_admin";
        }




        if($request->hasFile('profile_picture')) {
            $path = $this->uploadFile($request, 'profile_picture', 'profile-pictures');
            $data['profile_picture'] = $path;
        }
        $contact = Contact::create($data);
        if(auth()->user()->contact->is_admin)
            $this->createLog("Created a new contact", auth()->user(), true);
        return redirect()->route('contacts.index', [$params => true])->with('success', 'Contact created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        $departments = Department::all();
        $sections = Section::all();
        $title = $this->getTitle();
        return view('contact.show', compact('contact' , 'title' , 'departments' , 'sections'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $title = $this->getTitle();
        $sections = Section::all();
        $departments = Department::all();
        return view('contact.edit', compact('contact', 'sections', 'departments' , 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {

        $request->validate([
          'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          'email' => 'required|email|unique:users,email,'.$contact->user->id,
          'password' => 'nullable|min:8',
        ]);
        $data = $request->all();

        if($request->hasFile('profile_picture')) {
            $path = $this->uploadFile($request, 'profile_picture', 'profile-pictures');
            $data['profile_picture'] = $path;
        }
        //update user meail
        $contact->user->update(['email' => $data['email']]);
        $contact->update($data);

        $params = "";

        if($contact->is_student) {
            $params .= "is_student";
        }

        if($contact->is_teacher) {
            $params .= "is_teacher";
        }

        if($contact->is_admin) {
            $params .= "is_admin";
        }

        if(auth()->user()->contact->is_admin)
            $this->createLog("Updated a contact", auth()->user(), true);



        return redirect()->route('contacts.index' ,[$params => true])->with('success', 'Contact updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        if(auth()->user()->contact->is_admin)
            $this->createLog("Deleted a contact", auth()->user(), true);
    }

    public function activate (Contact $contact)
    {
        $user = $contact->user;
        $user->update(['is_activated' => true]);

        $params = "";

        if($contact->is_student) {
            $params .= "is_student";
        }

        if($contact->is_teacher) {
            $params .= "is_teacher";
        }

        if($contact->is_admin) {
            $params .= "is_admin";
        }
        if(auth()->user()->contact->is_admin)
            $this->createLog("Activated a contact", auth()->user(), true);


        return redirect()->route('contacts.index', [$params => true])->with('success', 'Contact activated successfully.');
    }

    public function deactivate (Contact $contact)
    {
        $user = $contact->user;
        $user->update(['is_activated' => false]);
        $params = "";

        if($contact->is_student) {
            $params .= "is_student";
        }

        if($contact->is_teacher) {
            $params .= "is_teacher";
        }

        if($contact->is_admin) {
            $params .= "is_admin";
        }

        if(auth()->user()->contact->is_admin)
            $this->createLog("Deactivated a contact", auth()->user(), true);


        return redirect()->route('contacts.index', [$params => true])->with('success', 'Contact deactivated successfully.');
    }
}
