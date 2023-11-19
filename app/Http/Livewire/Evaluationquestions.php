<?php

namespace App\Http\Livewire;

use App\Models\Result;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Evaluationquestions extends Component
{
    public $user_id,$evaluatetype,$programtype,$questions,$question_id_yesno,$evaluate_num,$evaluate_text,$evaluate_num_yesno=0,$evaluate_text_yesno;
    public $i=0 , $j=0 , $k=0 ;
    public function returnyes()
    {
        $resltyes = DB::table('results')->where('question_id', '24')->where('result_value','نعم')->get();
        $evaluate_num_yesno = $resltyes->result_numrate;
    }
    public function returnno()
    {
        
    }
    public function render()
    {
        return view('livewire.evaluationquestions');
    }
}
