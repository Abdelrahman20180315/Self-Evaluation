<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Organization;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::user()){
            return redirect('/redirects');
        }
        return redirect()->route('login');
    }
    public function redirect()
    {
        if(Auth::user()){

            if(Auth::user()->usertype === 'User'){
                $organizations = Organization::all();
                return view('User.userhome_page',compact('organizations'));
            }
            else if(Auth::user()->usertype === 'Admin'){

                $users = User::all();
                return view('Admins.adminhome',compact('users'));
            }
            else if(Auth::user()->usertype === 'Reviewer'){
                $evaluations = Evaluation::where('evaluate_id','2')->get()->unique('program_id');
                return view('Reviewer.Reviewer_homepage',compact('evaluations'));
            }
            else{
                return redirect()->route('login');
            }
        }
        else{
            return redirect()->route('login');
        }
    }
}
