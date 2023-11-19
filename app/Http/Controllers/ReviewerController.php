<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpWord\TemplateProcessor;

use PDF;

class ReviewerController extends Controller
{
    public function Reviewer_showActualEvaluations()
    {
        $evaluations = Evaluation::where('evaluate_id','2')->get()->unique('program_id');
        return view('Reviewer.Reviewer_homepage',compact('evaluations'));
    }

    public function Add_Score($userid,$programid)
    {
        $Evaluations = Evaluation::where('evaluate_id','2')
        ->where('user_id',$userid)->where('program_id',$programid)->get();
        //$eval_quest_result = $Evaluations->question->result;
        return view('Reviewer.reviewer_addscores',compact('Evaluations'));
    }

    public function Reviewer_StoreActualEvaluation(Request $request)
    {
        $user_id = $request->user_id;
        $program_id = $request->programtype;
        $evaluate_id = $request->evaluatetype;
        $result_value = $request->result_value;
        $id = $request->id;
        $pdf_text_status = $request->pdf_text_status;
        $file_namepath = $request->hidden_file;
        $question_status = $request->question_status;
        $question_id = $request->question_id;
        $Reviewer_total_score = 0;
        $evaluate_num = $request->evaluate_num;
        $evaluate_text = $request->evaluate_text;
        $pdf_text_value = $request->pdf_text_value;
        $pdf_path = $request->pdf_path;
        $organization_status = $request->organization_status;

        $total_score = [];
        $total_score_compute = 0;

        foreach($question_id as $Key => $value){
            $evaluation = Evaluation::find($id[$Key]);
            if($evaluation->evalute_num == $evaluate_num[$Key]){
                $total_score_compute += $evaluate_num[$Key];
            }else{
                $question = Question::find($question_id[$Key]);
                $groupScore = $question->group->group_score;
                $result_evalnum = ($evaluate_num[$Key] / 100) * $groupScore;
                $total_score_compute += $result_evalnum;

            }
        }

        foreach($question_id as $Key => $value){
            if($pdf_text_status[$Key] == 1 && $pdf_path[$Key] != " "){
                $path_url = $pdf_path[$Key];
            }else{
                $path_url = " ";
            }

            if($pdf_text_status[$Key] == 0){
                $pdf_text_specificvalue = " ";
            }else{
                $pdf_text_specificvalue = $pdf_text_value[$Key];
            }
            $evaluation = Evaluation::find($id[$Key]);

                $evaluation->update([
                    'result_value' => $result_value[$Key],
                    'question_id' => $question_id[$Key],
                    'evalute_num' => $evaluate_num[$Key],
                    'evalute_text' => $evaluate_text[$Key],
                    'total_score' => $total_score_compute,
                    'evaluate_id' => $evaluate_id,
                    'user_id' => $user_id,
                    'program_id' => $program_id,
                    'pdf_text' => $pdf_text_specificvalue,
                    'pdf_path' => $path_url,
                    'pdf_text_status' => $pdf_text_status[$Key],
                    'organization_status' => $organization_status
                ]);
            //}

        }
        Session::flash('message','! لقد تم اضافة التقييمات للاجابات بنجاح');
        return redirect('/Reviewer_showActualEvaluations');
    }

    public function Reviewer_showSelfEvaluations()
    {
        $evaluations = Evaluation::where('evaluate_id','1')->get()->unique('program_id');
        return view('Reviewer.Reviewer_self_evalpage',compact('evaluations'));
    }
    public function Add_SelfEvalScore($userid,$programid)
    {
        $Evaluations = Evaluation::where('evaluate_id','1')
        ->where('user_id',$userid)->where('program_id',$programid)->get();
        //$eval_quest_result = $Evaluations->question->result;
        return view('Reviewer.reviewer_add_self_evalscores',compact('Evaluations'));
    }

    public function Reviewer_StoreSelfEvaluation(Request $request)
    {
        $user_id = $request->user_id;
        $program_id = $request->programtype;
        $evaluate_id = $request->evaluatetype;
        $result_value = $request->result_value;
        $id = $request->id;
        $question_id = $request->question_id;
        $Reviewer_total_score = 0;
        $evaluate_num = $request->evaluate_num;
        $evaluate_text = $request->evaluate_text;
        $organization_status = $request->organization_status;
        $total_score = [];
        $total_score_compute = 0;

        foreach($question_id as $Key => $value){
            $evaluation = Evaluation::find($id[$Key]);
            if($evaluation->evalute_num == $evaluate_num[$Key]){
                $total_score_compute += $evaluate_num[$Key];
            }else{
                $question = Question::find($question_id[$Key]);
                $groupScore = $question->group->group_score;
                $result_evalnum = ($evaluate_num[$Key] / 100) * $groupScore;
                $total_score_compute += $result_evalnum;
            }

        }

        foreach($question_id as $Key => $value){

            $evaluation = Evaluation::find($id[$Key]);

                $evaluation->update([
                    'result_value' => $result_value[$Key],
                    'question_id' => $question_id[$Key],
                    'evalute_num' => $evaluate_num[$Key],
                    'evalute_text' => $evaluate_text[$Key],
                    'total_score' => $total_score_compute,
                    'evaluate_id' => $evaluate_id,
                    'user_id' => $user_id,
                    'program_id' => $program_id,
                    'organization_status' => $organization_status

                ]);
            //}

        }
        Session::flash('message','! لقد تم اضافة التقييمات للاجابات بنجاح');
        return redirect('/Reviewer_showSelfEvaluations');
    }

    public function Send_ActualResult($userid,$programid)
    {
        $uniqueEvaluation = Evaluation::where('evaluate_id','2')->where('user_id',$userid)->where('program_id',$programid)->first();
        $evaluation = Evaluation::where('evaluate_id','2')->where('user_id',$userid)->where('program_id',$programid)->get();
        if($uniqueEvaluation->show_user_results == 1){

            Session::flash('sendResult','لقد تم ارسال البيانات مسبقا');
            return redirect()->back();

        }else{
            for($i = 0 ; $i < count($evaluation) ; $i++){
                $evaluation[$i]->update([
                    'show_user_results' => 1
                ]);
            }
            Session::flash('sendResult','لقد تم ارسال البيانات بنجاح');
            return redirect()->back();
        }
    }
    public function Send_ActualReport($userid,$programid)
    {
        $uniqueEvaluation = Evaluation::where('evaluate_id','2')->where('user_id',$userid)->where('program_id',$programid)->get()->first();
        $evaluation = Evaluation::where('evaluate_id','2')->where('user_id',$userid)->where('program_id',$programid)->get();
        if($uniqueEvaluation->show_user_pdf == 1){

            Session::flash('sendReport','لقد تم ارسال التقرير مسبقا');
            return redirect()->back();

        }else{
            for($i = 0 ; $i < count($evaluation) ; $i++){
                $evaluation[$i]->update([
                    'show_user_pdf' => 1
                ]);
            }
            Session::flash('sendReport','لقد تم ارسال التقرير بنجاح');
            return redirect()->back();
        }
    }

    public function Send_SelfResult($userid,$programid)
    {
        $uniqueEvaluation = Evaluation::where('evaluate_id','1')->where('user_id',$userid)->where('program_id',$programid)->get()->first();
        $evaluation = Evaluation::where('evaluate_id','1')->where('user_id',$userid)->where('program_id',$programid)->get();
       // dd($uniqueEvaluation[0]);
        if($uniqueEvaluation->show_user_results == 1){

            Session::flash('sendResult','لقد تم ارسال البيانات مسبقا');
            return redirect()->back();

        }else{
            for($i = 0 ; $i < count($evaluation) ; $i++){
                $evaluation[$i]->update([
                    'show_user_results' => 1
                ]);
                // $evaluation[$i]->show_user_results = 1;
                // $evaluation[$i]->update();
            }
            Session::flash('sendResult','لقد تم ارسال البيانات بنجاح');
            return redirect()->back();
        }
    }

    public function Send_SelfReport($userid,$programid)
    {
        $uniqueEvaluation = Evaluation::where('evaluate_id','1')->where('user_id',$userid)->where('program_id',$programid)->get()->first();
        $evaluation = Evaluation::where('evaluate_id','1')->where('user_id',$userid)->where('program_id',$programid)->get();
        if($uniqueEvaluation->show_user_pdf == 1){

            Session::flash('sendReport','لقد تم ارسال التقرير مسبقا');
            return redirect()->back();

        }else{
            for($i = 0 ; $i < count($evaluation) ; $i++){
                $evaluation[$i]->update([
                    'show_user_pdf' => 1
                ]);
            }
            Session::flash('sendReport','لقد تم ارسال التقرير بنجاح');
            return redirect()->back();
        }
    }

    public function Make_ActualReport($userid,$programid)
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

    public function Make_SelfReport($userid,$programid)
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

    // public function View_SelfWordReport($userid,$programid)
    // {
    //     $evaluations = Evaluation::where('evaluate_id','1')->where('user_id',$userid)->where('program_id',$programid)->get();
    //     $uniqueevaluation = Evaluation::where('evaluate_id','1')->where('user_id',$userid)->where('program_id',$programid)->first();

    //     $user_id = $uniqueevaluation->user_id;
    //     $user_name = $uniqueevaluation->user->name;
    //     $program_name = $uniqueevaluation->program->program_name;
    //     $evaluate_name = 'تقييم ذاتي';
    //     $total_score = $uniqueevaluation->total_score;
    //     return view('word.selfreport',[
    //         'evaluations' => $evaluations,
    //         'user_id' => $user_id,
    //         'user_name' => $user_name,
    //         'program_name' => $program_name,
    //         'evaluate_name' => $evaluate_name,
    //         'total_score' => $total_score
    //     ]);
    // }

    public function Make_SelfWordReport($userid,$programid)
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
    public function Make_ActualWordReport($userid,$programid)
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
