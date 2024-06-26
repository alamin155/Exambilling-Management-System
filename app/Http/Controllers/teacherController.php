<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Teacher;
use App\Models\Department;
use App\Models\Staff;
use App\Models\Courses;
use App\Models\Examcommitteebilling;
use App\Models\Committee;
use DB;
use Auth;
use Session;
session_start();

class teacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private function getMyBling() {
    $data = Teacher::orderBy('id', 'asc')
        ->where('created_by', Auth::user()->id)
        ->pluck('id'); // Use pluck() to get only the 'id' column

    $data2 = Committee::select('committees.exam_id')
        ->join('teachers', 'committees.tech_id', '=', 'teachers.id')
        ->where('teachers.email', Auth::user()->email)
        ->pluck('committees.exam_id'); // Use pluck() to get only the 'exam_id' column

    return array_merge($data->toArray(), $data2->toArray()); // Merge both arrays
}
    public function index()
    {
        $ids = $this->getMyBling(); // Retrieve IDs from the method
    //Session::put('ids', $ids); // Store the IDs in the session variable without quotes around 'ids'

        $data = Teacher::whereIn('id', $ids)->orderBy('id', 'asc')->get();
       // $data=Teacher::orderBy('id','asc')->get();
        return view('admin.teacher.index',['data'=>$data]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data=Department::orderBy('id','desc')->get();
        return view('admin.teacher.create',['departments'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'teacher_name'=>'required',
            'teacher_designation'=>'required',
            'teacher_address'=>'required',
            'teacher_type'=>'required',
            'teacher_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'mobile' => ['required', 'numeric', 'digits:11'],
            'email'=>'required',
            'bankaccount'=>'required',
            'bankname'=>'required',
            'receivedno'=>'required',
            'Branchname'=>'required',
        ]);

        $photo=$request->file('teacher_image');
        $renamePhoto = time() . '.' . $photo->getClientOriginalExtension();
        $dest=public_path('/image');
        $photo->move($dest,$renamePhoto);

        $data=new Teacher();
        $data->teacher_name=$request->teacher_name;
        $data->teacher_designation=$request->teacher_designation;
        $data->teacher_address=$request->teacher_address;
        $data->teacher_type=$request->teacher_type;
        $data->teacher_image=$renamePhoto;
        $data->mobile=$request->mobile;
        $data->email=$request->email;
        $data->bankaccount=$request->bankaccount;
        $data->bankname=$request->bankname;
        $data->receivedno=$request->receivedno;
        $data->Branchname=$request->Branchname;
        $data->dept_id =$request->depart;
        $data->created_by=Auth::user()->id;
        $data->save();
        
        return redirect('teacher/create')->with('msg','Teacher created Successfuly!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data=Teacher::find($id);
        return view ('admin.teacher.show',['data'=>$data]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $departs=Department::orderBy('id','desc')->get();
        $data=Teacher::find($id);
        return view('admin.teacher.edit',['departs'=>$departs,'data'=>$data]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'teacher_name'=>'required',
            'teacher_designation'=>'required',
            'teacher_address'=>'required',
            'teacher_type'=>'required',
            'mobile'=>'required',
            'email'=>'required',
            'bankaccount'=>'required',
            'bankname'=>'required',
            'receivedno' =>'required',
            'Branchname'=>'required',
        ]);
        if($request->hasFile('teacher_image'))
        {
            $photo=$request->file('teacher_image');
            $renamePhoto = time() . '.' . $photo->getClientOriginalExtension();
            $dest=public_path('/image');
            $photo->move($dest,$renamePhoto); 
        }
        else
        {
            $renamePhoto=$request->prev_photo;

        }
        
        $data=Teacher::find($id);
        $data->teacher_name=$request->teacher_name;
        $data->teacher_designation=$request->teacher_designation;
        $data->teacher_address=$request->teacher_address;
        $data->teacher_image=$renamePhoto;
        $data->teacher_type=$request->teacher_type;
        $data->mobile=$request->mobile;
        $data->email=$request->email;
        $data->bankaccount=$request->bankaccount;
        $data->bankname=$request->bankname;
        $data->receivedno=$request->receivedno;
        $data->Branchname=$request->Branchname;
        $data->dept_id =$request->depart;
        $data->update();
        return redirect('teacher/'.$id.'/edit')->with('msg','Teacher updated Successfuly!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Teacher::where('id',$id)->delete();
        return redirect('/addteacher')->with('msg','Teacher Remove Successfuly!');
    }
    //Total Number of teacher
    public function teacherlist()
    {
        //$data=Teacher::orderBy('id','asc')->get();
        $teachers = Teacher::all();
        $departments = Department::all();
        $staffs=Staff::all();
        $courses=Courses::all();
        return view('home', [
            'teachers' => $teachers,
            'departments' => $departments,
            'staffs' => $staffs,
            'courses'=> $courses,
        ]);
        return view('home',['data'=>$data]);
    }
}
