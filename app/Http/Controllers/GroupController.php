<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::all();
        return view('Admins.admin_show_groups',compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programs = Program::all();
        return view('Admins.Create_group',compact('programs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ValidateData = $request->validate([
            'program_id' => 'required',
            'group_name' => 'required',
            'group_score' => 'required|int'
        ],
        [
            'program_id.required' => 'من فضلك أختار برنامج',
            'group_name.required' => 'من فضلك ادخل اسم المجموعة',
            'group_score.required' => 'من فضلك ادخل وزن المجموعة'
        ]);
        //$group = Group::where('program_id',$request->program_id)->get();
        //$doesnt_Exist = Group::select("*")->where("program_id", $request->program_id)->doesntExist();
        $group = Group::where('program_id',$request->program_id)->get();
        $registerd_score = $group->sum('group_score');
        if( $group == Null && $request->group_score <= 100){
            Group::create([
                'program_id' => $request->program_id,
                'group_name' => $request->group_name,
                'group_score' => $request->group_score
            ]);
            Session::flash('message','تم إضافة المجموعة بنجاح');
            return redirect()->back();
        }else{
            if(100 - ($request->group_score + $registerd_score) >= 0){
                Group::create([
                    'program_id' => $request->program_id,
                    'group_name' => $request->group_name,
                    'group_score' => $request->group_score
                ]);
                Session::flash('message','تم إضافة المجموعة بنجاح');
                return redirect()->back();
            }else{
                Session::flash('failure','%عفوا! مجموع أوزان المجموعات لهذا البرنامج يتخطي 100');
                return redirect()->back();
            }
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
        $group = Group::find($id);
        return view('Admins.update_groups',compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $ValidateData = $request->validate([
            'program_id' => 'required',
            'group_name' => 'required',
            'group_score' => 'required|int'
        ],
        [
            'program_id.required' => 'من فضلك أختار برنامج',
            'group_name.required' => 'من فضلك ادخل اسم المجموعة',
            'group_score.required' => 'من فضلك ادخل وزن المجموعة'
        ]);
        $group_program = Group::where('program_id',$request->program_id)->get();
        $registerd_score = $group_program->sum('group_score');
        if(100 - ($request->group_score + $registerd_score) >= 0){
            $group->update([
                'program_id' => $request->program_id,
                'group_name' => $request->group_name,
                'group_score' => $request->group_score
            ]);
            Session::flash('update','تم تعديل المجموعة بنجاح');
            return redirect()->back();
        }else{
            Session::flash('failure','%عفوا! مجموع أوزان المجموعات لهذا البرنامج يتخطي 100');
            return redirect()->back();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->delete();
        Session::flash('delete','تم حذف المجموعة بنجاح');
        return redirect()->back();
    }

    public function searchgroup(Request $request)
    {
        $groups = Group::where('group_name','LIKE','%'.$request->searchgroup.'%')
        ->orWhere('group_score','LIKE','%'.$request->searchgroup.'%')->get();
        return view('Admins.admin_show_groups',compact('groups'));
    }

    public function groupselectedprogram($id)
    {
        $program_id = $id ;
        $program = Program::find($id);
        return view('Admins.groupsrelatedprogram',compact('program_id','program'));
    }
    
    public function GetgroupsRelatedToSpecificprogram($filter_type)
    {
        echo json_encode(DB::table('groups')->where('program_id', $filter_type)->get());
    }
}
