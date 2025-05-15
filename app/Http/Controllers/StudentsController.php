<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\Students;
use Illuminate\Http\Request;
use App\Mail\NewStudentNotification;
use Illuminate\Support\Facades\Mail;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     */
    //The $request->validate([...]) line applies server-side validation before saving data to the database.
    public function store(Request $request)
    {

        //dd($request->full_name);

        //validations (@,$,!,%,*,#,?,&,.)
        $request->validate([
            'full_name' => 'required|string',
            'user_name' => 'required|unique:students,user_name',
            'phone' => 'required',
            'whatsapp' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:students,email',
            'password' => ['required', 'confirmed', 'min:8', 'regex:/[0-9]/', 'regex:/[@$!%*#?&.]/'],
            'user_image' => 'nullable|image'
        ], [
            'password.min' => 'Password must be at least 8 characters long.',
            'password.regex' => 'Password must contain at least one number and one special character (@,$,!,%,*,#,?,&,.).',
            'password.confirmed' => 'Password confirmation does not match.'
        ]);
        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('user_image')) {
            $imagePath = $request->file('user_image')->store('uploads', 'public');
        }

        // Store the user
        $user = new Students();
        $user->full_name = $request->full_name;
        $user->user_name = $request->user_name;
        $user->phone = $request->phone;
        $user->whatsapp = $request->whatsapp;
        $user->address = $request->address;
        $user->email = $request->email;
        //$user->password = bcrypt($request->password); // Hashing the password
        $user->password = Hash::make($request->password);
        $user->user_image = $imagePath;

        $user->save();

        // the email will be sent to this email (put your email to try to recieve email)
        Mail::to("reekoahmed114@gmail.com")->send(new NewStudentNotification($user->user_name));

        //dd('User saved!', $user);

        return redirect()->back()->with('success', 'Registration successful!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Students $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Students $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Students $users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Students $users)
    {
        //
    }




public function checkUsername(Request $request){
$username = $request->input('username');  //The 'username' refers to the name of the POST parameter being sent from the AJAX request.
$isTaken = Students::where('user_name', $username)->exists();
return response($isTaken ? 'taken' : 'available');
}

}