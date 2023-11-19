<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function Adminhome()
    {
        $users = User::all();
        return view('Admins.adminhome',compact('users'));
    }
    public function searchuser(Request $request)
    {
        $users = User::where('name','LIKE','%'.$request->searchuser.'%')->get();
        return view('Admins.adminhome',compact('users'));
    }
    // public function CreateProgram()
    // {
    //     return view('Admins.Create_program');
    // }
    public function admin_showEvaluations()
    {
        $evaluations = Evaluation::all();
        return view('Admins.admin_showEvaluations',compact('evaluations'));
    }
    public function search_adminevaluation(Request $request)
    {
        $search = $request->search;
        if($search == 'ذاتي'){
            $search = 1;
        }else{
            $search = 2;
        }
        $evaluations = Evaluation::whereHas('program', function($categoryQuery) use ($search){
            $categoryQuery->where('program_name', 'LIKE', '%'.$search.'%' );
        })->orwhereHas('user', function($categoryQuery) use ($search){
           $categoryQuery->where('name', 'LIKE', '%'.$search.'%' );
       })->orWhere('created_at','LIKE', '%'.$search.'%')->orWhere('evaluate_id','=', $search)->get();
        return view('Admins.admin_showEvaluations',compact('evaluations'));
    }
}
