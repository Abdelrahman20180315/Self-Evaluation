<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    public function questionselectedgroup($id)
    {
        $group_id = $id;
        $group = Group::find($id);
        return view('Admins.questionrelatedtogrops',compact('group_id','group'));
    }

    public function editquestion($id)
    {
        $question = Question::find($id);
        return view('Admins.update_selectedquestion',compact('question'));
    }

    public function updatequestion($id , Request $request)
    {
        $validateData = $request->validate([

            'question_text' => 'required',
            'question_score' => 'required',
            'question_resultstatus' => 'required',
        ],
        [

            'question_text.required' => 'من فضلك ادخل نص السؤال',
            'question_score.required' => 'من فضلك ادخل وزن السؤال',
            'question_resultstatus.required' => 'من فضلك ادخل نوع الاجابة ',
        ]);

        $question = Question::find($id);
        $group = Group::find($request->group_id);
        $quest = Question::where('group_id',$request->group_id)->get();
        $quest_registeredscore = $quest->sum('question_score');

        if($group->group_score - ($quest_registeredscore + $request->question_score) >= 0){
            $question->update([
                'question_text' => $request->question_text,
                'question_score' => $request->question_score,
                'question_resultstatus' => $request->question_resultstatus
            ]);
            Session::flash('message','لقد تم تعديل السؤال بنجاح');
            return redirect()->back();
        }else{
            Session::flash('failure','  عفوا! لا يمكن اضافة وزن اعلي لان مجموع اوزان الاسئلة لهذه المجموعة تتخطي 100% من وزن المجموعة');
        }

    }

    public function deletequestion($id)
    {
        $data = Question::find($id);
        $data->delete();
        Session::flash('deletedquestion','تم حذف السؤال بنجاح');
        return redirect()->back();
    }
}
