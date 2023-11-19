<?php

namespace App\Http\Livewire;

use App\Models\Group;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Result;
use Illuminate\Support\Facades\DB;

class Makequestions extends Component
{
    protected $listners;
    public $question_text, $question_score, $question_resultstatus, $group_id;
    public $updateMode = false;
    public $inputs = [];
    public $i = 1;
    public $j = 0;
    public $u = 0;

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
        $this->question_text = '';
        $this->question_score = '';
        $this->question_resultstatus = '';

    }

    public function store()
    {
        $validatedDate = $this->validate([
                'question_text.0' => 'required',
                'question_score.0' => 'required',
                'question_resultstatus.0' => 'required',
                'question_text.*' => 'required',
                'question_score.*' => 'required',
                'question_resultstatus.*' => 'required',
            ],
            [
                'question_text.0.required' => 'required',
                'question_score.0.required' => 'required',
                'question_resultstatus.0.required' => 'required',
                'question_text.*.required' => 'required',
                'question_score.*.required' => 'required',
                'question_resultstatus.*.required' => 'required',
                
            ]
        );
        $group = Group::find($this->group_id);
        $quest = Question::where('group_id',$this->group_id)->get();
        $quest_registeredscore = $quest->sum('question_score');
         if($quest == Null && $this->question_score <= 100){
             foreach ($this->question_text as $key => $value) {
                 Question::create(
                     ['question_text' => $this->question_text[$key],
                      'question_score' => $this->question_score[$key],
                      'question_resultstatus' => $this->question_resultstatus[$key],
                      'group_id' => $this->group_id
                     ]
                    );
                    // if($this->question_resultstatus[$key] == '4'){
                    //     $question_used = DB::table('questions')->orderBy('created_at','DESC')->first();
                    //     // $result_used = Result::where('question_id',$question_used->id)->get();
                    //     // if($result_used == null){
                    //     Result::create(
                    //         ['result_value' => '',
                    //         'result_numrate' => '0',
                    //         'result_textrate' => 'حسنا',
                    //         'result_status' => '4',
                    //         'question_id' => $question_used->id,
                            
                    //         ]
                    //     );
                    //     //}
                    // } 
                    // $questions_used = Question::where('question_resultstatus','4')
                    // ->where('group_id',$this->group_id)->get();
                        
                    //     for($r=0;$r<=$questions_used->count();$r++){
                    //         $result_used = Result::where('question_id',$questions_used->result_status[$r])->get();
                    //         if($this->question_resultstatus[$key] == '4'){
        
                    //              if($result_used == null){
                    //                  Result::create(
                    //                     ['result_value' => '',
                    //                       'result_numrate' => '0',
                    //                       'result_textrate' => 'حسنا',
                    //                       'result_status' => $this->question_resultstatus,
                    //                       'question_id' => $questions_used->id[$r],
                                         
                    //                     ]
                    //                 );
                    //             }
                                
                    //         }
                    //     }
             }
      
             $this->inputs = [];
       
             $this->resetInputFields();
        
             session()->flash('message', 'لقد تم اضافة الاسئلة بنجاح');
         }else{
             foreach($this->question_score as $key => $value){
                
                 $this->j += $this->question_score[$key];
                }
        
                 foreach ($this->question_score as $key => $value) {
                    if(100 - ($quest_registeredscore +  $this->j ) >= 0)
                    {
                        Question::create(
                            ['question_text' => $this->question_text[$key],
                            'question_score' => $this->question_score[$key],
                            'question_resultstatus' => $this->question_resultstatus[$key],
                            'group_id' => $this->group_id
                        ]
                        
                        );
                        // if($this->question_resultstatus[$key] == '4'){
                        //     $question_used = DB::table('questions')->orderBy('created_at','DESC')->first();
                        //     // $result_used = Result::where('question_id',$question_used->id)->get();
                        //     // if($result_used == null){
                        //     Result::create(
                        //         ['result_value' => '',
                        //         'result_numrate' => '0',
                        //         'result_textrate' => 'حسنا',
                        //         'result_status' => '4',
                        //         'question_id' => $question_used->id,
                                
                        //         ]
                        //     );
                        //     //}
                        // }
                    //     $questions_used = Question::where('question_resultstatus','4')
                    // ->where('group_id',$this->group_id)->get();
                        
                    //     // foreach($questions_used->question_text as $Key => $value)
                    //     for($r=0;$r<=$questions_used->count();$r++){
                    //         $result_used = Result::where('question_id',$questions_used->result_status[$r])->get();
                    //         if($this->question_resultstatus[$key] == '4'){
        
                    //              if($result_used == null){
                    //                  Result::create(
                    //                     ['result_value' => '',
                    //                       'result_numrate' => '0',
                    //                       'result_textrate' => 'حسنا',
                    //                       'result_status' => $this->question_resultstatus,
                    //                       'question_id' => $questions_used->id[$r],
                                         
                    //                     ]
                    //                 );
                    //             }
                                
                    //         }
                    //     }
                       

                        session()->flash('message', 'لقد تم اضافة الاسئلة بنجاح');

                        

                    }
                    else{
                        session()->flash('failure', ' عفوا! لايمكن اضافة اسئلة جديدة لان مجموع اوزان الاسئلة لهذه المجموعة يتخطي 100% لهذه المجموعة ');                    
                        break;

                    }

                    
             }
                       $this->inputs = [];
        
                        $this->resetInputFields();

         }

   
   }

    public function render()
    {
        $listners = ['groupadded'=>'$refresh'];
        $questions = Question::where('group_id',$this->group_id)->get();
        return view('livewire.makequestions',['questions' => $questions]);
    }
} 