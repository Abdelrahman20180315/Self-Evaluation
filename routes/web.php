<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Organization;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\ReviewerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[HomeController::class,'index']);
Route::get('/redirects',[HomeController::class,'redirect']);


//Admin Routes
Route::get('/Adminhome',[AdminController::class,'Adminhome']);
Route::get('/searchuser',[AdminController::class,'searchuser']);
Route::get('/admin_showEvaluations',[AdminController::class,'admin_showEvaluations']);
//search for Evaluations
Route::get('/search_adminevaluation',[AdminController::class,'search_adminevaluation']);


//Route::get('/Create-Program',[AdminController::class,'CreateProgram']);
Route::get('/enter_organizationstatus',[Organization::class,'enter_organizationstatus']);
Route::post('/store_organizationstatus',[Organization::class,'store_organizationstatus']);
Route::get('/show_organizationstatus',[Organization::class,'show_organizationstatus']);
Route::get('/edit_organization/{id}',[Organization::class,'edit_organization']);
Route::post('/update_organizationstatus/{id}',[Organization::class,'update_organizationstatus']);
Route::get('/delete_organization/{id}',[Organization::class,'delete_organization']);


Route::resource('/program',ProgramController::class);
Route::resource('/group',GroupController::class);
//Route::get('/search/program',[AdminController::class,'searchprogram'])->name('program.search');
Route::get('/search/group',[GroupController::class,'searchgroup'])->name('group.search');
Route::get('/creategroups/selectedprgram/{id}',[GroupController::class,'groupselectedprogram']);

Route::get('GetgroupsRelatedToSpecificprogram/{filter_type}',[GroupController::class,'GetgroupsRelatedToSpecificprogram']);


Route::get('/question/selectedgroup/{id}',[QuestionController::class,'questionselectedgroup']);
Route::get('/editquestion/{id}',[QuestionController::class,'editquestion']);
Route::post('/updatequestion/{id}',[QuestionController::class,'updatequestion']);
Route::get('/deletequestion/{id}',[QuestionController::class,'deletequestion']);
Route::get('/deletequestion/{id}',[QuestionController::class,'deletequestion']);

Route::get('/createresults/selectedquestion/{id}',[ResultController::class,'resultselectedquestion']);
Route::get('/editresult/{id}',[ResultController::class,'editresult']);
Route::post('/updateresult/{id}',[ResultController::class,'updateresult']);
Route::get('/deleteresult/{id}',[ResultController::class,'deleteresult']);

//User Dashboard
Route::get('/userhomepage',[UserController::class,'userhomepage']);
Route::get('/evaluatetype_redirect',[UserController::class,'evaluatetype_redirect']);
Route::post('/Add_SelfEvaluation',[UserController::class,'add_SelfEvaluation']);
Route::get('/Show_UserEvaluations',[UserController::class,'Show_UserEvaluations']);
Route::post('/Add_ActualEvaluation',[UserController::class,'Add_ActualEvaluation']);
Route::get('/Show_UserActualEvaluations',[UserController::class,'Show_UserActualEvaluations']);
Route::get('GetProgramsRelatedToSpecificType/{filter_type}',[UserController::class,'GetProgramsRelatedToSpecificType']);
Route::get('/make_self_evalreport/{userid}/{programid}',[UserController::class,'make_self_evalreport']);
Route::get('/make_actual_evalreport/{userid}/{programid}',[UserController::class,'make_actual_evalreport']);

Route::get('/make_self_wordevalreport/{userid}/{programid}',[UserController::class,'make_self_wordevalreport']);
Route::get('/make_actual_wordevalreport/{userid}/{programid}',[UserController::class,'make_actual_wordevalreport']);





//Reviewer Controller
Route::get('/Reviewer_showActualEvaluations',[ReviewerController::class,'Reviewer_showActualEvaluations']);
Route::get('/Reviewer_showSelfEvaluations',[ReviewerController::class,'Reviewer_showSelfEvaluations']);
Route::get('/Add_Score/{userid}/{programid}',[ReviewerController::class,'Add_Score']);
Route::get('/Add_SelfEvalScore/{userid}/{programid}',[ReviewerController::class,'Add_SelfEvalScore']);
Route::post('/Reviewer_StoreActualEvaluation',[ReviewerController::class,'Reviewer_StoreActualEvaluation']);
Route::post('/Reviewer_StoreSelfEvaluation',[ReviewerController::class,'Reviewer_StoreSelfEvaluation']);
Route::get('/Send_ActualResult/{userid}/{programid}',[ReviewerController::class,'Send_ActualResult']);
Route::get('/Send_ActualReport/{userid}/{programid}',[ReviewerController::class,'Send_ActualReport']);
Route::get('/Send_SelfResult/{userid}/{programid}',[ReviewerController::class,'Send_SelfResult']);
Route::get('/Send_SelfReport/{userid}/{programid}',[ReviewerController::class,'Send_SelfReport']);
Route::get('/Make_ActualReport/{userid}/{programid}',[ReviewerController::class,'Make_ActualReport']);
Route::get('/Make_SelfReport/{userid}/{programid}',[ReviewerController::class,'Make_SelfReport']);

Route::get('/View_SelfWordReport/{userid}/{programid}',[ReviewerController::class,'View_SelfWordReport']);
Route::get('users/word-export/{userid}',[ReviewerController::class,'wordExport']);
Route::get('try/{userid}',[ReviewerController::class,'try']);
Route::get('users/{userid}',[ReviewerController::class,'wordusers']);
Route::get('users/word-export/{userid}',[ReviewerController::class,'wordexport']);





Route::get('/Make_SelfWordReport/{userid}/{programid}',[ReviewerController::class,'Make_SelfWordReport']);

Route::get('/Make_ActualWordReport/{userid}/{programid}',[ReviewerController::class,'Make_ActualWordReport']);




//search for Evaluations
Route::get('/search_userevaluation',[UserController::class,'search_userevaluation']);


//Ajax Requests returns Json Data from DB
Route::get('GetVoltsRelatedToSpecificType/{type}/{z}',[UserController::class,'GetVoltsRelatedToSpecificType']);
Route::get('GetResultsRelatedTonumber/{type}/{z}',[UserController::class,'GetResultsRelatedTonumber']);
Route::get('GetResultsRelatedTotext/{type}/{z}',[UserController::class,'GetResultsRelatedTotext']);

Route::get('GetactualyesnodataRelatedToSelction/{type}/{z}',[UserController::class,'GetactualyesnodataRelatedToSelction']);
Route::get('GetactualnumberdataRelatedToSelction/{type}/{z}',[UserController::class,'GetactualnumberdataRelatedToSelction']);
Route::get('GetactualtextdataRelatedToSelction/{type}/{z}',[UserController::class,'GetactualtextdataRelatedToSelction']);




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
