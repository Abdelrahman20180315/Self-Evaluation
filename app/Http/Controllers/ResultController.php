<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ResultController extends Controller
{
    public function resultselectedquestion($id)
    {
        $question_id = $id;
        $question = Question::find($id);
        $question_status = $question->question_resultstatus;
        return view('Admins.resultsrelatedtoquestion',compact('question_id','question_status','question'));
    }

    public function editresult($id)
    {
        $result = Result::find($id);
        return view('Admins.update_selectedresult',compact('result'));
    }

    public function updateresult($id,Request $request)
    {
        if($request->result_status == 1){
            $validatedDate = $request->validate([
                'result_value' => 'required',
                'result_numrate' => 'required|integer',
                'result_textrate' => 'required',
                'pdf_text' => 'required'
                
            ],
            [
                'result_value.required' => 'من فضلك ادخل نعم او لا ',
                'result_numrate.required' => 'من فضلك ادخل تقييم رقمي لهذه الإجابة',
                'result_textrate.required' => 'من فضلك ادخل تقييم نصي لهذه الإجابة',
                'result_numrate.integer' => 'يجب أن تكون القيمة رقمية',
                'pdf_text' => 'يجب ادخال النص الذي يظهر لادخال الوثيقة الملائمة من اليوزر'
                 
            ]);
            $result = Result::find($id);
            $result->update([
                'result_value' => $request->result_value,
                'result_numrate' => $request->result_numrate,
                'result_textrate' => $request->result_textrate,
                'question_id' => $request->question_id,
                'result_status' => $request->result_status,
                'result_statusvalue' => '1',
                'pdf_text' => $request->pdf_text,

            ]);
            Session::flash('message','لقد تم تعديل الاجابة بنجاح');
            return redirect()->back();

        }elseif($request->result_status == 2){
            $validatedDate = $request->validate([
                'min_value' => 'required',
                'max_value' => 'required',
                'result_numrate' => 'required|integer',
                'result_textrate' => 'required'
                
            ],
            [
                'min_value.required' => 'من فضلك ادخل القيمة الدنيا  ',
                'max_value.required' => 'من فضلك ادخل القيمة العليا  ',
                'result_numrate.required' => 'من فضلك ادخل تقييم رقمي لهذه الإجابة',
                'result_textrate.required' => 'من فضلك ادخل تقييم نصي لهذه الإجابة',
                'result_numrate.integer' => 'يجب أن تكون القيمة رقمية',
                 
            ]);
            $result = Result::find($id);
            $result->update([
                'min_value' => $request->min_value,
                'max_value' => $request->max_value,
                'result_numrate' => $request->result_numrate,
                'result_textrate' => $request->result_textrate,
                'question_id' => $request->question_id,
                'result_status' => $request->result_status,
            ]);
            Session::flash('message','لقد تم تعديل الاجابة بنجاح');
            return redirect()->back();

        }
        else{
            $validatedDate = $request->validate([
                'result_value' => 'required',
                'result_numrate' => 'required|integer',
                'result_textrate' => 'required'
                
            ],
            [
                'result_value.required' => 'من فضلك ادخل نص',
                'result_numrate.required' => 'من فضلك ادخل تقييم رقمي لهذه الإجابة',
                'result_textrate.required' => 'من فضلك ادخل تقييم نصي لهذه الإجابة',
                'result_numrate.integer' => 'يجب أن تكون القيمة رقمية',
                 
            ]);
            $result = Result::find($id);
            $result->update([
                'result_value' => $request->result_value,
                'result_numrate' => $request->result_numrate,
                'result_textrate' => $request->result_textrate,
                'question_id' => $request->question_id,
                'result_status' => $request->result_status,
            ]);
            Session::flash('message','لقد تم تعديل الاجابة بنجاح');
            return redirect()->back();

        }
    }

    public function deleteresult($id)
    {
        $data = Result::find($id);
        $data->delete();
        Session::flash('deleteresult','تم حذف الإجابة بنجاح');
        return redirect()->back();
    }
}
