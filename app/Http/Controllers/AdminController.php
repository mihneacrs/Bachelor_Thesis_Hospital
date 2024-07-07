<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Exports\UsersExport;
use App\Imports\DoctorsImport;
use App\Exports\DoctorsExport;
use App\Imports\AppointmentsImport;
use App\Exports\AppointmentsExport;
use App\Notifications\SendEmailNotification;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Product;
use Notification;



class AdminController extends Controller
{
    public function addview(){

        return view ('admin.add_doctor');
    }

    public function upload(Request $request){

        $doctor=new doctor;

        $image=$request->file;

        $imagename=time().'.'.$image->getClientoriginalExtension();

        $request->file->move('doctorimage',$imagename);

        $doctor->image=$imagename;

        $doctor->name=$request->name;

        $doctor->phone=$request->number;

        $doctor->room=$request->room;

        $doctor->specialty=$request->specialty;

        $doctor->save();

        return redirect()->back()->with('message', 'Doctor Added Succesfully');

    }

    public function showappointment(){

        $data=appointment::all();

        return view ('admin.showappointment',compact('data'));

    }
    public function approved($id){

        $data=appointment::find($id);

        $data->status='approved';

        $data->save();

        return redirect()->back();

    }

    public function cancelled($id){

        $data=appointment::find($id);

        $data->status='cancelled';

        $data->save();

        return redirect()->back();

    }
    public function showdoctor(){

        $data=doctor::paginate(5);

        return view('admin.showdoctor',compact('data'));

    }

    public function deletedoctor($id){
        
        $data=doctor::find($id);

        $data->delete();

        return redirect()->back();

    }

    public function updatedoctor($id){

        $data = doctor::find($id);

        return view('admin.update_doctor',compact('data'));
    }

    public function editdoctor(Request $request, $id){

        $doctor = doctor::find($id);

        $doctor->name = $request->name;

        $doctor->phone = $request->phone;

        $doctor->specialty = $request->specialty;

        $doctor->room = $request->room;

        $image=$request->file;

        if($image){

        $imagename=time().'.'.$image->getClientOriginalExtension();

        $request->file->move('doctorimage',$imagename);

        $doctor->image=$imagename;

        }

        $doctor->save();

        return redirect()->back()->with('message','Doctor Details Updated Succesfully');
    }

    public function emailview($id){

        $data=appointment::find($id);

        return view('admin.email_view',compact('data'));
    }

    public function sendemail(Request $request, $id){

        $data=appointment::find($id);

        $details=[
            'greeting'=> $request->greeting,

            'body'=> $request->body,

            'actiontext'=> $request->actiontext,

            'actionurl'=> $request->actionurl,

            'endpart'=> $request->endpart

        ];

        Notification::send($data, new SendEmailNotification($details));

        return redirect()->back();

    }

    public function view(){

        return view('admin.importexportview');
    }

    public function importuser(){

        Excel::Import(new UsersImport, request()->file('file') );

        return redirect()->back();
    }

    public function exportuser(){

        return Excel::download(new UsersExport, 'Licenta_Export_Date_Users.xlsx' );

        
    }

    public function importdoctor(){

        Excel::Import(new DoctorsImport, request()->file('file') );

        return redirect()->back();
    }

    public function exportdoctor(){

        return Excel::download(new DoctorsExport, 'Licenta_Export_Date_Doctors.xlsx' );

        
    }

    public function importappointment(){

        Excel::Import(new AppointmentsImport, request()->file('file') );

        return redirect()->back();
    }

    public function exportappointment(){

        return Excel::download(new AppointmentsExport, 'Licenta_Export_Date_Appointments.xlsx' );

        
    }

    public function addviewproduct(){

        return view ('admin.add_product');
    }

    public function showproduct(){

        $data=product::all();

        return view('admin.showproduct',compact('data'));

    }

    public function deleteproduct($id){
        
        $data=product::find($id);

        $data->delete();

        return redirect()->back();

    }

    public function updateproduct($id){

        $data = product::find($id);

        return view('admin.update_product',compact('data'));
    }

    public function editproduct(Request $request, $id){

        $product = product::find($id);

        $product->name = $request->name;

        $product->description = $request->description;

        $product->quantity = $request->quantity;

        $product->measurement = $request->measurement;

        $image=$request->file;

        if($image){

        $imagename=time().'.'.$image->getClientOriginalExtension();

        $request->file->move('productimage',$imagename);

        $product->image=$imagename;

        }

        $product->save();

        return redirect()->back()->with('message','Doctor Details Updated Succesfully');
    }

    public function uploadproduct(Request $request){

        $product=new product;

        $image=$request->file;

        $imagename=time().'.'.$image->getClientoriginalExtension();

        $request->file->move('productimage',$imagename);

        $product->image=$imagename;

        $product->name=$request->name;

        $product->description=$request->description;

        $product->quantity=$request->quantity;

        $product->measurement=$request->measurement;

        $product->save();

        return redirect()->back()->with('message', 'Medicine Added Succesfully');

    }

    public function searchDoctor(Request $request) {

        $data = Doctor::query();

        $where = [];

        if ($request->has('search') && $request->get('search')) {
            $where[] = ['name', 'like', "%" . $request->get('search') . "%"];
        }

        if (count($where))
            $data->where($where);

        $data = $data->paginate(15);

        foreach ($request->collect() as $key => $param) {
            if ($key != "page")
                $data->appends($key, $param);
        }

        return view('admin.showdoctor', ['data' => $data]);
    }
    
}
