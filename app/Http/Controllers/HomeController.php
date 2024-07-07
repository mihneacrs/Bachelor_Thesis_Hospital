<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Post;

class HomeController extends Controller
{
    public function redirect()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype=="0")
            {
                $doctor= doctor::all();
                return view('user.home',compact('doctor'));
            }
        else 
            {
                return view('admin.home');
            }
        }
    }

    public function index(){

        if(Auth::id()){
            return redirect('home');
        }
        else{
        $doctor= doctor::all();
        return view('user.home',compact('doctor'));
        }
    }

    public function appointment(Request $request){

        $data = new appointment;
        $data -> name = $request -> name;

        $data -> email = $request -> email;

        $data -> date = $request -> date;

        $data -> phone = $request -> number;

        $data -> message = $request -> message;

        $data -> doctor = $request -> doctor;

        $data -> status = 'In Progress';

        if(Auth::id()){
        $data -> user_id = Auth::user()->id;
        }

        $data -> save();

        return redirect() ->back() -> with('message','Appointment Request Succesful. We will contact you soon.');
    }

    public function myappointment(){

        if(Auth::id()){

            $userid=Auth::user()->id;
            $appoint= appointment::where('user_id',$userid)->get();

            return view('user.my_appointment',compact('appoint')); 
        }

        else {
            return redirect()->back();
        }
    }

    public function cancel_appoint($id){

        $data = appointment::find($id);

        $data -> delete();

        return redirect()->back();

    }

    public function contactemail(Request $request)
{
    // Check if the form is submitted
    if ($request->filled('message')) {
        $subject = "Here is the subject line";
        $message = $request->input('message');
        $emailAddress = $request->input('emailAddress'); // Assuming you have an input field with name 'emailAddress'
        $fullName = $request->input('fullName'); // Assuming you have an input field with name 'fullName'

        // Send email using Laravel Mail facade
        Mail::raw($message, function($mail) use ($emailAddress, $fullName, $subject) {
            $mail->to('arknaivcactus@gmail.com');
            $mail->from($emailAddress, $fullName);
            $mail->subject($subject);
        });

        // Optionally, you can add a response or redirect after sending the email
        return response()->json(['message' => 'Email sent successfully'], 200);
    }

    // Handle case where the form is not submitted
    // You might want to return a response or redirect the user
}
    public function view(){

        return view('importexportview');
    }

    public function chat(){

        

        $post=Post::all();
        return view('user.chat',compact('post')); 
        

        
    }

    public function about(){

        
        $doctor= doctor::all();
        return view('user.about',compact('doctor'));
    }

    public function doctors(){

        
        $doctor= doctor::all();
        return view('user.doctors',compact('doctor'));
        

        
    }

    public function home1(){
        $doctor= doctor::all();
        return view('user.home1',compact('doctor'));
        
    }

    public function blog(){

        return view('user.blog');
    }

    public function contact(){

        return view('user.contact');
    }

    public function terms_and_conditions(){

        return view('user.terms_and_conditions');
    }
        
}
