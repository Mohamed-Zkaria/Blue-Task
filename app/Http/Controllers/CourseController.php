<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('log')->only('index');

        $this->middleware('is_admin')->except(['index', "show"]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.coursecreate");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:courses|max:150',
            'description' => 'required|max:500',
        ]);

        if ($validator->fails()) {
            return redirect('courses/create')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $course = new Course;
            $course->name = $request->name;
            $course->description = $request->description;
            $course->save();
            return redirect("courses/create")->with("success", "Course added");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view("admin.courseedit")->with("course", Course::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:150',
            'description' => 'required|max:500',
        ]);

        if ($validator->fails()) {
            return redirect('courses/'.$id.'/edit/')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $course = Course::find($id);
            $course->name = $request->name;
            $course->description = $request->description;
            $course->save();
            return redirect('courses/' . $id . '/edit/')->with("success", "Course updated");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->is_admin){
            $course = Course::find($id);
            $course->delete();
    
            return back()->with("success", "Removed");
        } else {
            return back()->with("error", "Unauthorized");
        }
 
    }
}
