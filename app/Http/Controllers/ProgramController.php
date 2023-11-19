<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::all();
        return view('Admins.admin_show_programs',compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organizations = Organization::all();
        return view('Admins.Create_program',compact('organizations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'program_name' => 'required|unique:programs',
                'organization_status' => 'required'
            ],
            [
                'program_name.required' => 'من فضلك ادخل اسم البرنامج',
                'program_name.unique' => 'تم استخدام هذا الاسم مسبقا' ,
                'organization_status.required' => 'من فضلك قم بإختيار حالة المنظمة او الشركة'
            ]
        );
        Program::create([
            'program_name' => $request->program_name,
            'organization_status' => $request->organization_status
        ]);
        Session::flash('message','تم إنشاء البرنامج بنجاح');
        return redirect()->back();
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
        $program = Program::find($id);
        return view('Admins.update_program',compact('program'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        $validatedData = $request->validate(
            [
                'program_name' => 'required'
            ],
            [
                'program_name.required' => 'من فضلك ادخل اسم البرنامج'
            ]
        );
        $program->update([
            'program_name' => $request->program_name
        ]);
        Session::flash('update','تم تعديل البرنامج بنجاح');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        $program->delete();
        Session::flash('delete','تم حذف البرنامج بنجاح');
        return redirect()->back();
    }
}
