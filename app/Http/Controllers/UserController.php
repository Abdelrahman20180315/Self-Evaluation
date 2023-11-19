<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Group;
use App\Models\Organization ;
use App\Models\Program;
use App\Models\Question;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;


class UserController extends Controller
{
    public function userhomepage()
    {
        $organizations = Organization::all();
        return view('User.userhome_page',compact('organizations'));

    }
    public function evaluatetype_redirect(Request $request)
    {
        $evaluatetype = $request->evaluatetype;
        $programtype = $request->programtype;
        $organization_status = $request->organization_status;
        $groups = Group::where('program_id',$programtype)->get();
        $user_id = Auth::id();
        $group_id = [];
        $status = 1;
        $evaluations = Evaluation::where('user_id',$user_id)
        ->where('evaluate_id',$evaluatetype)->where('program_id',$programtype)->count();
        foreach($groups as $group){
            $group_id[] = $group->id;
            $questions = Question::whereIn('group_id',$group_id)->whereHas('result', function($categoryQuery) use ($status){
                $categoryQuery->where('result_statusvalue',$status);
            })->get();
        }
        //dd($group_id);
        if($evaluations > 0){
            Session::flash('failure','عفوا ! لقد قمت بإجراء تقييم في هذا البرنامج من قبل');
            return redirect('/userhomepage');
           
        }
        else{
            return view('User.evaluation_questionpage',compact('evaluatetype','group_id','groups','programtype','questions','user_id','organization_status'));

        }
        
    }

    public function GetProgramsRelatedToSpecificType($filter_type)
    {
        
        echo json_encode(DB::table('programs')->where('organization_status',$filter_type)->get());

    }

    public function GetVoltsRelatedToSpecificType()
    {
        $type = $_GET['type'];
        $questionid = $_GET['z'];
        // if($type == 1){
        //     $result_yesorno = 'نعم';
        // }else{
        //     $result_yesorno = 'لا';
        // }
        echo json_encode(DB::table('results')->where('question_id', $questionid)->where('result_value',$type)->get());
    }
    public function GetactualyesnodataRelatedToSelction()
    {
        $type = $_GET['type'];
        $questionid = $_GET['z'];
        
        echo json_encode(DB::table('results')->where('question_id', $questionid)->where('result_value',$type)->get());
    }

    public function GetResultsRelatedTonumber()
    {
        $type = $_GET['type'];
        $questionid = $_GET['z'];
        echo json_encode(DB::table('results')->where('question_id', $questionid)->where('min_value','<=',$type)->where('max_value','>=',$type)->get());

    }
    public function GetactualnumberdataRelatedToSelction()
    {
        $type = $_GET['type'];
        $questionid = $_GET['z'];
        echo json_encode(DB::table('results')->where('question_id', $questionid)->where('min_value','<=',$type)->where('max_value','>=',$type)->get());

    }

    



    public function GetResultsRelatedTotext()
    {
        $type = $_GET['type'];
        $questionid = $_GET['z'];
        //$result = Result::find($type);
        //echo json_encode($result);
        echo json_encode(DB::table('results')->where('result_value',$type)->where('question_id', $questionid)->get());

    
    }

    public function GetactualtextdataRelatedToSelction()
    {
        $type = $_GET['type'];
        $questionid = $_GET['z'];
        
        echo json_encode(DB::table('results')->where('result_value',$type)->where('question_id', $questionid)->get());

    
    }

    
    public function add_SelfEvaluation(Request $request)
    {
        $selfEvaluation = new Evaluation();
        $user_id = $request->user_id;
        $program_id = $request->programtype;
        $evaluate_id = $request->evaluatetype; 
        $evaluate_numyesno = $request->evaluate_numyesno;
        $evaluate_numnumber = $request->evaluate_numnumber;
        $evaluate_numtext = $request->evaluate_numtext;
        $organization_status = $request->organization_status;
        $question_id = $request->question_id;
        $result_value = $request->result_value;
        $evaluate_num = $request->evaluate_num;
        $evaluate_text = $request->evaluate_text;
        $total_score = [];
       
        // $countyesno = 0;
        // $countnum= 0;
        // $counttext = 0;
        $countt = 0;
        // for($i=0 ;$i < count($evaluate_numyesno) ;$i++ ){
        //     $total_score[] = $evaluate_numyesno[$i];
            
        // } 
        // if($evaluate_numnumber != null){
        //     for($i=0 ;$i < count($evaluate_numnumber) ;$i++ ){
        //         $total_score[] = $evaluate_numnumber[$i];
                
        //     } 
        // }
        // if($evaluate_numtext != null){
        //     for($i=0 ;$i < count($evaluate_numtext) ;$i++ ){
        //         $total_score[] = $evaluate_numtext[$i];
                
        //     } 
        // }
        
        
        for($i=0 ; $i < count($evaluate_num) ;$i++){
            $countt += $evaluate_num[$i];
        }
        foreach($question_id as $Key => $value){
            Evaluation::create([
                'user_id' => $user_id,
                'program_id' => $program_id,
                'question_id' => $question_id[$Key],
                'evaluate_id' => $evaluate_id,
                'result_value' => $result_value[$Key],
                'evalute_num' => $evaluate_num[$Key],
                'evalute_text' => $evaluate_text[$Key],
                'total_score' => $countt,
                'organization_status' => $organization_status   
        ]);

        }
        // $lastquestion = Question::orderBy('created_at','DESC')->first();
        // $last_question_id = $lastquestion->id;
        // $selfEvaluation->user_id = $user_id;
        // $selfEvaluation->program_id = $program_id;
        // $selfEvaluation->evaluate_id = $evaluate_id;
        // $selfEvaluation->question_id = $last_question_id;
        // $selfEvaluation->total_score = $countt;
        //dd($countt);
        //$selfEvaluation->save();
        Session::flash('message','قيد المراجعة! سيتم عرض نتيجة التقييم بعد المراجعة');
        return redirect('/Show_UserEvaluations');
    }






    public function Add_ActualEvaluation(Request $request)
    {
        $user_id = $request->user_id;
        $program_id = $request->programtype;
        $evaluate_id = $request->evaluatetype;
        $result_value = $request->result_value;
        $result_file = $request->result_file;
        $organization_status = $request->organization_status;
        $evaluate_num = $request->evaluate_num;
        $evaluate_text = $request->evaluate_text;

        if($result_file != null){
            $file_namepath = time().'.'.$result_file->getClientOriginalName();
            $result_file->move('FilesFolder',$file_namepath);
        }
        $pdf_path = $request->pdf_path;
        $pdf_text_value = $request->pdf_text_value;
        $pdf_text_status = $request->pdf_text_status;
        $question_status = $request->question_status;
        $question_id = $request->question_id;
        $total_score = 0;
        $pdf_text_specificvalue = "";


        foreach($question_id as $Key => $value){
            $total_score += $evaluate_num[$Key];
        }
       
        foreach($question_id as $Key => $value){
            
            if($pdf_text_status[$Key] == 1 && $pdf_path[$Key] != ""){
                $path = $pdf_path[$Key];
                $path_url = time().'.'.$path->getClientOriginalName();
                $path->move('FilesFolder',$path_url);
            }else{
                $path_url = " ";
            }

            if($pdf_text_status[$Key] == 0){
                $pdf_text_specificvalue = " ";
            }else{
                $pdf_text_specificvalue = $pdf_text_value[$Key];
            }
            
            Evaluation::create([
                'result_value' => $result_value[$Key],
                'question_id' => $question_id[$Key],
                'evalute_num' => $evaluate_num[$Key],
                'evalute_text' => $evaluate_text[$Key],
                'total_score' => $total_score,
                'evaluate_id' => $evaluate_id,
                'user_id' => $user_id,
                'program_id' => $program_id,
                'pdf_path' => $path_url,
                'pdf_text_status' => $pdf_text_status[$Key],
                'pdf_text' => $pdf_text_specificvalue,
                'organization_status' => $organization_status
            ]);
            
            
        }
        Session::flash('message','قيد المراجعة! سيتم عرض نتيجة التقييم بعد المراجعة');
        return redirect('/Show_UserActualEvaluations');
    
    }

    public function Show_UserEvaluations()
    {
        $evaluations = Evaluation::where('user_id',Auth::id())->where('evaluate_id','1')->get()->unique('program_id');
        return view('User.Show_UserEvaluations',compact('evaluations'));
    }
    public function Show_UserActualEvaluations()
    {
        $evaluations = Evaluation::where('user_id',Auth::id())->where('evaluate_id','2')->get()->unique('program_id');
        return view('User.Show_UserActualEvaluations',compact('evaluations'));
    }
    public function search_userevaluation(Request $request)
    {
        //$AllEvaluations = Evaluation::all();
        $search = $request->search;
        if($search == 'ذاتي'){
            $search = 1;
        }else{
            $search = 2;
        }
       // $evaluate_type = ($AllEvaluations->evaluate_id == 1 ? 'تقييم ذاتي' : 'تقييم فعلي');
        $evaluations = Evaluation::whereHas('program', function($categoryQuery) use ($search){
             $categoryQuery->where('program_name', 'LIKE', '%'.$search.'%' );
         })->orwhereHas('user', function($categoryQuery) use ($search){
            $categoryQuery->where('name', 'LIKE', '%'.$search.'%' );
        })->orWhere('created_at','LIKE', '%'.$search.'%')->orWhere('evaluate_id','=', $search)->where('user_id',Auth::id())->get();

        // $evaluation = Evaluation::query();
        //$evaluations = Evaluation::where($this->program->program_name,'LIKE','%'.$search.'%')->get();
        return view('User.Show_UserEvaluations',compact('evaluations'));
    }

    public function make_self_evalreport($userid,$programid)
    {
        $evaluations = Evaluation::where('evaluate_id','1')->where('user_id',$userid)->where('program_id',$programid)->get();
        $uniqueevaluation = Evaluation::where('evaluate_id','1')->where('user_id',$userid)->where('program_id',$programid)->first();

        $user_id = $uniqueevaluation->user_id;
        $user_name = $uniqueevaluation->user->name;
        $program_name = $uniqueevaluation->program->program_name;
        $evaluate_name = 'تقييم ذاتي';
        $total_score = $uniqueevaluation->total_score;
        


        $pdf = PDF::loadView('pdf.SelfReport',[
            'evaluations' => $evaluations,
            'user_id' => $user_id,
            'user_name' => $user_name,
            'program_name' => $program_name,
            'evaluate_name' => $evaluate_name,
            'total_score' => $total_score
        ],[
            'mode'                       => '',
            'format'                     => 'A4',
            'default_font_size'          => '12',
            'default_font'               => 'sans-serif',
            'margin_left'                => 10,
            'margin_right'               => 10,
            'margin_top'                 => 10,
            'margin_bottom'              => 10,
            'margin_header'              => 0,
            'margin_footer'              => 0,
            'orientation'                => 'P',
            'title'                      => 'Laravel mPDF',
            'author'                     => '',
            'watermark'                  => '',
            'show_watermark'             => false,
            'show_watermark_image'       => false,
            'watermark_font'             => 'sans-serif',
            'display_mode'               => 'fullpage',
            'watermark_text_alpha'       => 0.1,
            'watermark_image_path'       => '',
            'watermark_image_alpha'      => 0.2,
            'watermark_image_size'       => 'D',
            'watermark_image_position'   => 'P',
            'custom_font_dir'            => '',
            'custom_font_data'           => [],
            'auto_language_detection'    => false,
            'temp_dir'                   => storage_path('app'),
            'pdfa'                       => false,
            'pdfaauto'                   => false,
            'use_active_forms'           => false,
        ]);
    
        return $pdf->download('SelfReport.pdf');
    }

    public function make_actual_evalreport($userid,$programid)
    {
        $evaluations = Evaluation::where('evaluate_id','2')->where('user_id',$userid)->where('program_id',$programid)->get();
        $uniqueevaluation = Evaluation::where('evaluate_id','2')->where('user_id',$userid)->where('program_id',$programid)->first();

        $user_id = $uniqueevaluation->user_id;
        $user_name = $uniqueevaluation->user->name;
        $program_name = $uniqueevaluation->program->program_name;
        $evaluate_name = 'تقييم فعلي';
        $total_score = $uniqueevaluation->total_score;
        


        $pdf = PDF::loadView('pdf.ActualReport',[
            'evaluations' => $evaluations,
            'user_id' => $user_id,
            'user_name' => $user_name,
            'program_name' => $program_name,
            'evaluate_name' => $evaluate_name,
            'total_score' => $total_score
        ],[
            'mode'                       => '',
            'format'                     => 'A4',
            'default_font_size'          => '12',
            'default_font'               => 'sans-serif',
            'margin_left'                => 10,
            'margin_right'               => 10,
            'margin_top'                 => 10,
            'margin_bottom'              => 10,
            'margin_header'              => 0,
            'margin_footer'              => 0,
            'orientation'                => 'P',
            'title'                      => 'Laravel mPDF',
            'author'                     => '',
            'watermark'                  => '',
            'show_watermark'             => false,
            'show_watermark_image'       => false,
            'watermark_font'             => 'sans-serif',
            'display_mode'               => 'fullpage',
            'watermark_text_alpha'       => 0.1,
            'watermark_image_path'       => '',
            'watermark_image_alpha'      => 0.2,
            'watermark_image_size'       => 'D',
            'watermark_image_position'   => 'P',
            'custom_font_dir'            => '',
            'custom_font_data'           => [],
            'auto_language_detection'    => false,
            'temp_dir'                   => storage_path('app'),
            'pdfa'                       => false,
            'pdfaauto'                   => false,
            'use_active_forms'           => false,
        ]);
    
        return $pdf->download('ActualReport.pdf');
    }
    public function make_self_wordevalreport($userid,$programid)
    {
        $evaluations = Evaluation::where('evaluate_id','1')->where('user_id',$userid)->where('program_id',$programid)->get();
        $uniqueevaluation = Evaluation::where('evaluate_id','1')->where('user_id',$userid)->where('program_id',$programid)->first();

        $user_id = $uniqueevaluation->user_id;
        $user_name = $uniqueevaluation->user->name;
        $program_name = $uniqueevaluation->program->program_name;
        $evaluate_name = 'تقييم ذاتي';
        $total_score = $uniqueevaluation->total_score;
        $view = view('word.selfreport',[
            'evaluations' => $evaluations,
            'user_id' => $user_id,
            'user_name' => $user_name,
            'program_name' => $program_name,
            'evaluate_name' => $evaluate_name,
            'total_score' => $total_score
        ])->render();
        $file_name = 'Selfevaluation.doc';
        $headers = array(
            "Content-type"=>"application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            "Content-Disposition"=>"attachment;Filename=$file_name"
        );
        return response()->make($view,200, $headers);
        
    
    }

    public function make_actual_wordevalreport($userid,$programid)
    {
        $evaluations = Evaluation::where('evaluate_id','2')->where('user_id',$userid)->where('program_id',$programid)->get();
        $uniqueevaluation = Evaluation::where('evaluate_id','2')->where('user_id',$userid)->where('program_id',$programid)->first();

        $user_id = $uniqueevaluation->user_id;
        $user_name = $uniqueevaluation->user->name;
        $program_name = $uniqueevaluation->program->program_name;
        $evaluate_name = 'تقييم فعلي';
        $total_score = $uniqueevaluation->total_score;
        $view = view('word.actualreport',[
            'evaluations' => $evaluations,
            'user_id' => $user_id,
            'user_name' => $user_name,
            'program_name' => $program_name,
            'evaluate_name' => $evaluate_name,
            'total_score' => $total_score
        ])->render();
        $file_name = 'Actualevaluation.doc';
        $headers = array(
            "Content-type"=>"application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            "Content-Disposition"=>"attachment;Filename=$file_name"
        );
        return response()->make($view,200, $headers);
    }







}
