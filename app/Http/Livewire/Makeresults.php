<?php

namespace App\Http\Livewire;

use App\Models\Group;
use App\Models\Question;
use App\Models\Result;
use Livewire\Component;

class Makeresults extends Component
{
    protected $listners;
    public $question_id,$question_status, $result_value, $min_value, $max_value, $result_numrate, $result_textrate, $result_status,$pdf_text,$pdf_text_status,$status_for_group,$status_for_evaluation,$group_status,$evaluation_status,$pdf_status_yes,$pdf_status_no;
    public $updateMode = false;
    public $inputs = [];
    public $result_statusvalue = 1 ;
    public $i = 1;
    public $j = 0;
    public $countval ;
    public $statusv0 = 0;
    public $statusv1 = 1;

    // public $pdfstus = 0;
    //public $odiv;
    
    public $showDiv = false;

    // public function changestatusyes(){
    //     $this->pdfstus = 1;
    // }
    // public function changestatusno(){
    //     $this->pdfstus = 0;
    // }
    // public function openDiv()
    // {
    //     $this->showDiv = true;
        
    // }
    // public function closeDiv(){
    //     if($this->showDiv == true){
    //         $this->showDiv = false;
    //     }
        
    // }
    // public function opendivdy($odiv){
    //     $this->emit('opendivddy',$odiv);
    // }
    public function mount()
    {
       
       for($f = 0 ;$f < 20 ; $f++){
            $this->group_status[$f] = 0;
            $this->evaluation_status[$f] = 0;
            // $this->pdf_status_yes[$f] = 0;
            // $this->pdf_status_no[$f] = 0;

       }
        
       
       
        
    }

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs ,$i);
    }
   

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    private function resetInputFields(){
        $this->result_value = '';
        $this->result_numrate = '';
        $this->result_textrate = '';
        $this->min_value = '';
        $this->max_value = '';
        $this->pdf_text = '';
        

    }

    public function store()
    {

        if($this->question_status == 1){

            $validatedDate = $this->validate([
                'result_value.0' => 'required',
                'result_numrate.0' => 'required|integer',
                'result_textrate.0' => 'required',
                'pdf_text.0' => 'required',
                'result_value.*' => 'required',
                'result_numrate.*' => 'required|integer',
                'result_textrate.*' => 'required',
                'pdf_text.*' => 'required',
            ],
            [
                'result_value.0.required' => 'من فضلك ادخل نعم او لا ',
                'result_numrate.0.required' => 'من فضلك ادخل تقييم رقمي لهذه الإجابة',
                'result_textrate.0.required' => 'من فضلك ادخل تقييم نصي لهذه الإجابة',
                'result_numrate.0.integer' => 'يجب أن تكون القيمة رقمية',
                'pdf_text.0.required' => 'يجب ادخال النص الذي يظهر حتي يتمكن اليوزر من ادخال الوثيقة الملائمة',
                'result_value.*.required' => 'من فضلك ادخل نعم او لا ',
                'result_numrate.*.required' => 'من فضلك ادخل تقييم رقمي لهذه الإجابة',
                'result_textrate.*.required' => 'من فضلك ادخل تقييم نصي لهذه الإجابة',
                'result_numrate.*.integer' => 'يجب أن تكون القيمة رقمية',   
                'pdf_text.*.required' => 'يجب ادخال النص الذي يظهر حتي يتمكن اليوزر من ادخال الوثيقة الملائمة',
     
            ]
        );
        
        
        foreach ($this->result_numrate as $key => $value) {
            $question = Question::find($this->question_id);
            $groupScore = $question->group->group_score;
            $resultNumrate = ($this->result_numrate[$key] / 100) * $groupScore;
            $result_question = Result::where('question_id',$this->question_id)->get();
            

                if($this->pdf_text_status[$key] == 1){
                    if($this->group_status[$key] == 0  && $this->evaluation_status[$key] == 0){
                        Result::create(
                            ['result_value' => $this->result_value[$key],
                            'result_numrate' => $resultNumrate,
                            'result_textrate' => $this->result_textrate[$key],
                            'result_status' => $this->question_status,
                            'question_id' => $this->question_id,
                            'result_statusvalue' => $this->result_statusvalue,
                            'pdf_text' => $this->pdf_text[$key],
                            'pdf_text_status' => 1,
                                                 
                            ]
                        );
                       
                       
                        // Result::create(
                        //     ['result_value' => $this->result_value[$key],
                        //     'result_numrate' => $resultNumrate,
                        //     'result_textrate' => $this->result_textrate[$key],
                        //     'result_status' => $this->question_status,
                        //     'question_id' => $this->question_id,
                        //     'result_statusvalue' => $this->result_statusvalue,
                        //     'pdf_text' => $this->pdf_text[$key],
                        //     'pdf_text_status' => $this->pdf_text_status[$key],                     
                        //     ]
                        // );
                    }elseif ($this->group_status[$key] == 1 && $this->evaluation_status[$key] == 0) {
                        Result::create(
                            ['result_value' => $this->result_value[$key],
                            'result_numrate' => $resultNumrate,
                            'result_textrate' => $this->result_textrate[$key],
                            'result_status' => $this->question_status,
                            'question_id' => $this->question_id,
                            'result_statusvalue' => $this->result_statusvalue,
                            'pdf_text' => $this->pdf_text[$key],
                            'pdf_text_status' => 1,
                            'status_for_group' => 1,                     
                            ]
                        );
                    }elseif ($this->group_status[$key] == 0 && $this->evaluation_status[$key] == 1) {
                        Result::create(
                            ['result_value' => $this->result_value[$key],
                            'result_numrate' => $resultNumrate,
                            'result_textrate' => $this->result_textrate[$key],
                            'result_status' => $this->question_status,
                            'question_id' => $this->question_id,
                            'result_statusvalue' => $this->result_statusvalue,
                            'pdf_text' => $this->pdf_text[$key],
                            'pdf_text_status' => 1,
                            'status_for_evaluation' => 1,                     
                            ]
                        );
                    } 
                    else {
                        Result::create(
                            ['result_value' => $this->result_value[$key],
                            'result_numrate' => $resultNumrate,
                            'result_textrate' => $this->result_textrate[$key],
                            'result_status' => $this->question_status,
                            'question_id' => $this->question_id,
                            'result_statusvalue' => $this->result_statusvalue,
                            'pdf_text' => $this->pdf_text[$key],
                            'pdf_text_status' => 1,
                            'status_for_group' => 1,
                            'status_for_evaluation' => 1,                    
                            ]
                        );
                        // Result::create(
                        //     ['result_value' => $this->result_value[$key],
                        //     'result_numrate' => $resultNumrate,
                        //     'result_textrate' => $this->result_textrate[$key],
                        //     'result_status' => $this->question_status,
                        //     'question_id' => $this->question_id,
                        //     'result_statusvalue' => $this->result_statusvalue,
                        //     'pdf_text' => $this->pdf_text[$key],
                        //     'pdf_text_status' => $this->pdf_text_status[$key],
                        //     'status_for_group' => 1,
                        //     'status_for_evaluation' => 1,                     
                        //     ]
                        // );
                    }
                    
    
                }else{

                    if($this->group_status[$key] == 0 && $this->evaluation_status[$key] == 0){
                        Result::create(
                            ['result_value' => $this->result_value[$key],
                            'result_numrate' => $resultNumrate,
                            'result_textrate' => $this->result_textrate[$key],
                            'result_status' => $this->question_status,
                            'question_id' => $this->question_id,
                            'result_statusvalue' => $this->result_statusvalue,
                            'pdf_text_status' => 0, 
                                                
                            ]
                        );
                    }elseif ($this->group_status[$key] == 1 && $this->evaluation_status[$key] == 0) {
                        Result::create(
                            ['result_value' => $this->result_value[$key],
                            'result_numrate' => $resultNumrate,
                            'result_textrate' => $this->result_textrate[$key],
                            'result_status' => $this->question_status,
                            'question_id' => $this->question_id,
                            'result_statusvalue' => $this->result_statusvalue,
                            'pdf_text_status' => 0,                     
                            'status_for_group' => 1,                     
                            ]
                        );
                    }elseif ($this->group_status[$key] == 0 && $this->evaluation_status[$key] == 1) {
                        Result::create(
                            ['result_value' => $this->result_value[$key],
                            'result_numrate' => $resultNumrate,
                            'result_textrate' => $this->result_textrate[$key],
                            'result_status' => $this->question_status,
                            'question_id' => $this->question_id,
                            'result_statusvalue' => $this->result_statusvalue,
                            'pdf_text_status' => 0,                     
                            'status_for_evaluation' => 1,                     
                            ]
                        );
                    }
                    else {
                        Result::create(
                            ['result_value' => $this->result_value[$key],
                            'result_numrate' => $resultNumrate,
                            'result_textrate' => $this->result_textrate[$key],
                            'result_status' => $this->question_status,
                            'question_id' => $this->question_id,
                            'result_statusvalue' => $this->result_statusvalue,
                            'pdf_text_status' => 0,                     
                            'status_for_group' => 1,  
                            'status_for_evaluation' => 1,                                        
                            ]
                        );
                    }

                }
            

            
            

            
       
            session()->flash('message', 'لقد تم اضافة الإجابة  بنجاح');    

        }
            $this->inputs = [];
       
            $this->resetInputFields();
            $this->emit('groupadded');

    }
         elseif($this->question_status == 2){

            $validatedDate = $this->validate([
                'min_value.0' => 'required',
                'max_value.0' => 'required',
                'result_numrate.0' => 'required|integer',
                'result_textrate.0' => 'required',
                'pdf_text.0' => 'required',
                'result_numrate.*' => 'required|integer',
                'result_textrate.*' => 'required',
                'min_value.*' => 'required',
                'max_value.*' => 'required',
                'pdf_text.*' => 'required',

            ],
            [
                'min_value.0.required' => 'من فضلك ادخل القيمة الدنيا',
                'max_value.0.required' => 'من فضلك ادخل القيمة العليا',
                'result_numrate.0.required' => 'من فضلك ادخل تقييم رقمي لهذه الإجابة',
                'result_textrate.0.required' => 'من فضلك ادخل تقييم نصي لهذه الإجابة',
                'result_numrate.0.integer' => 'يجب أن تكون القيمة رقمية',
                'pdf_text.0.required' => 'يجب ادخال النص الذي يظهر حتي يتمكن اليوزر من ادخال الوثيقة الملائمة',

                'result_numrate.*.required' => 'من فضلك ادخل تقييم رقمي لهذه الإجابة',
                'result_textrate.*.required' => 'من فضلك ادخل تقييم نصي لهذه الإجابة',
                'result_numrate.*.integer' => 'يجب أن تكون القيمة رقمية',     
                'min_value.*.required' => 'من فضلك ادخل القيمة الدنيا',
                'max_value.*.required' => 'من فضلك ادخل القيمة العليا', 
                'pdf_text.*.required' => 'يجب ادخال النص الذي يظهر حتي يتمكن اليوزر من ادخال الوثيقة الملائمة',
  
            ]
        );
            foreach ($this->result_numrate as $key => $value) {
                $question = Question::find($this->question_id);
                $groupScore = $question->group->group_score;
                $resultNumrate = ($this->result_numrate[$key] / 100) * $groupScore;
                // if($this->pdf_text_status[$key] == 1 ){
                    

                    if($this->group_status[$key] == 0 && $this->evaluation_status[$key] == 0){
                        Result::create(
                            ['min_value' => $this->min_value[$key],
                            'max_value' => $this->max_value[$key],
                            'result_numrate' => $resultNumrate,
                            'result_textrate' => $this->result_textrate[$key],
                            'result_status' => $this->question_status,
                            'question_id' => $this->question_id,
                            'result_statusvalue' => $this->result_statusvalue,
                            'pdf_text' => $this->pdf_text[$key],
                            'pdf_text_status' => 1,                     
                            ]
                        );
                    }elseif ($this->group_status[$key] == 1 && $this->evaluation_status[$key] == 0) {
                        Result::create(
                            ['min_value' => $this->min_value[$key],
                            'max_value' => $this->max_value[$key],
                            'result_numrate' => $resultNumrate,
                            'result_textrate' => $this->result_textrate[$key],
                            'result_status' => $this->question_status,
                            'question_id' => $this->question_id,
                            'result_statusvalue' => $this->result_statusvalue,
                            'pdf_text' => $this->pdf_text[$key],
                            'pdf_text_status' => 1,   
                            'status_for_group' => 1,                  
                            ]
                        );
                    }elseif ($this->group_status[$key] == 0 && $this->evaluation_status[$key] == 1) {
                        Result::create(
                            ['min_value' => $this->min_value[$key],
                            'max_value' => $this->max_value[$key],
                            'result_numrate' => $resultNumrate,
                            'result_textrate' => $this->result_textrate[$key],
                            'result_status' => $this->question_status,
                            'question_id' => $this->question_id,
                            'result_statusvalue' => $this->result_statusvalue,
                            'pdf_text' => $this->pdf_text[$key],
                            'pdf_text_status' => 1,   
                            'status_for_evaluation' => 1,                  
                            ]
                        );
                    }else {
                        Result::create(
                            ['min_value' => $this->min_value[$key],
                            'max_value' => $this->max_value[$key],
                            'result_numrate' => $resultNumrate,
                            'result_textrate' => $this->result_textrate[$key],
                            'result_status' => $this->question_status,
                            'question_id' => $this->question_id,
                            'result_statusvalue' => $this->result_statusvalue,
                            'pdf_text' => $this->pdf_text[$key],
                            'pdf_text_status' => 1,   
                            'status_for_group' => 1,
                            'status_for_evaluation' => 1,                  
                            ]
                        );
                    }


                    
    
                // }else{
                //     Result::create(
                //         ['min_value' => $this->min_value[$key],
                //          'max_value' => $this->max_value[$key],
                //          'result_numrate' => $resultNumrate,
                //          'result_textrate' => $this->result_textrate[$key],
                //          'result_status' => $this->question_status,
                //          'question_id' => $this->question_id,
                //          'result_statusvalue' => $this->result_statusvalue,
                                              
                //         ]
                //     );
                // }
    
               
           
                session()->flash('message', 'لقد تم اضافة الإجابة  بنجاح'); 
                  
    
            }
            $this->inputs = [];
           
            $this->resetInputFields();

            $this->emit('groupadded'); 
    }
    else{

        $validatedDate = $this->validate([
            'result_value.0' => 'required',
            'result_numrate.0' => 'required|integer',
            'result_textrate.0' => 'required',
            'pdf_text.0' => 'required',

            'result_value.*' => 'required',
            'result_numrate.*' => 'required|integer',
            'result_textrate.*' => 'required',
            'pdf_text.*' => 'required',

        ],
        [
            'result_value.required' => 'من فضلك ادخل نص ',
            'result_numrate.0.required' => 'من فضلك ادخل تقييم رقمي لهذه الإجابة',
            'result_textrate.0.required' => 'من فضلك ادخل تقييم نصي لهذه الإجابة',
            'result_numrate.0.integer' => 'يجب أن تكون القيمة رقمية',
            'pdf_text.0.required' => 'يجب ادخال النص الذي يظهر حتي يتمكن اليوزر من ادخال الوثيقة الملائمة',

            'result_value.*.required' => 'من فضلك ادخل نص ',
            'result_numrate.*.required' => 'من فضلك ادخل تقييم رقمي لهذه الإجابة',
            'result_textrate.*.required' => 'من فضلك ادخل تقييم نصي لهذه الإجابة',
            'result_numrate.*.integer' => 'يجب أن تكون القيمة رقمية',
            'pdf_text.*.required' => 'يجب ادخال النص الذي يظهر حتي يتمكن اليوزر من ادخال الوثيقة الملائمة',
        
        ]
    );

    foreach ($this->result_numrate as $key => $value) {
        $question = Question::find($this->question_id);
        $groupScore = $question->group->group_score;
        $resultNumrate = ($this->result_numrate[$key] / 100) * $groupScore;
        // if($this->pdf_text_status[$key] == 1 ){


            if($this->group_status[$key] == 0 && $this->evaluation_status[$key] == 0){
                        Result::create(
                            ['result_value' => $this->result_value[$key],
                            'result_numrate' => $resultNumrate,
                            'result_textrate' => $this->result_textrate[$key],
                            'result_status' => $this->question_status,
                            'question_id' => $this->question_id,
                            'result_statusvalue' => $this->result_statusvalue,
                            'pdf_text' => $this->pdf_text[$key],
                            'pdf_text_status' => 1,                     
                            ]
                        );
                    }elseif ($this->group_status[$key] == 1 && $this->evaluation_status[$key] == 0) {
                        Result::create(
                            ['result_value' => $this->result_value[$key],
                            'result_numrate' => $resultNumrate,
                            'result_textrate' => $this->result_textrate[$key],
                            'result_status' => $this->question_status,
                            'question_id' => $this->question_id,
                            'result_statusvalue' => $this->result_statusvalue,
                            'pdf_text' => $this->pdf_text[$key],
                            'pdf_text_status' => 1, 
                            'status_for_group' => 1,                    
                            ]
                        );
                    }elseif ($this->group_status[$key] == 0 && $this->evaluation_status[$key] == 1) {
                        Result::create(
                            ['result_value' => $this->result_value[$key],
                            'result_numrate' => $resultNumrate,
                            'result_textrate' => $this->result_textrate[$key],
                            'result_status' => $this->question_status,
                            'question_id' => $this->question_id,
                            'result_statusvalue' => $this->result_statusvalue,
                            'pdf_text' => $this->pdf_text[$key],
                            'pdf_text_status' => 1, 
                            'status_for_evaluation' => 1,                    
                            ]
                        );
                    }else {
                        Result::create(
                            ['result_value' => $this->result_value[$key],
                            'result_numrate' => $resultNumrate,
                            'result_textrate' => $this->result_textrate[$key],
                            'result_status' => $this->question_status,
                            'question_id' => $this->question_id,
                            'result_statusvalue' => $this->result_statusvalue,
                            'pdf_text' => $this->pdf_text[$key],
                            'pdf_text_status' => 1,
                            'status_for_group' => 1,
                            'status_for_evaluation' => 1,                            ]
                        );
                    }



            

        // }else{
        //     Result::create(
        //         ['result_value' => $this->result_value[$key],
        //          'result_numrate' => $resultNumrate,
        //          'result_textrate' => $this->result_textrate[$key],
        //          'result_status' => $this->question_status,
        //          'question_id' => $this->question_id,
        //          'result_statusvalue' => $this->result_statusvalue,
                                      
        //         ]
        //     );
        // }

        
   
        session()->flash('message', 'لقد تم اضافة الإجابة  بنجاح');  

    }
        $this->inputs = [];
   
        $this->resetInputFields();

        $this->emit('groupadded');  

        
  }
}
   


    
    public function render()
    {
        $listners = ['groupadded'=>'$refresh'];
        //$this->dispatchBrowserEvent('jquery');
        $results = Result::where('question_id',$this->question_id)->get();
        return view('livewire.makeresults',compact('results'));
    }
}
