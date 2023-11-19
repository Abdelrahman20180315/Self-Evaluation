<?php

namespace App\Http\Livewire;

use App\Models\Group;
use App\Models\Program;
use Livewire\Component;

class Makegroups extends Component
{
    protected $listners;
    public $group_name, $group_score, $program_id;
    public $updateMode = false;
    public $inputs = [];
    public $i = 1;
    public $j = 0;

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
        $this->group_name = '';
        $this->group_score = '';
        
    }

    public function store()
    {
        $validatedDate = $this->validate([
                'group_name.0' => 'required',
                'group_score.0' => 'required',
                'group_name.*' => 'required',
                'group_score.*' => 'required',
            ],
            [
                'group_name.0.required' => 'من فضلك ادخل أسم المجموعة',
                'group_score.0.required' => 'من فضلك ادخل وزن المجموعة ',
                'group_name.*.required' => 'من فضلك ادخل أسم المجموعة',
                'group_score.*.required' => 'من فضلك ادخل وزن المجموعة',
                
            ]
        );
        $program = Program::find($this->program_id);
        $group = Group::where('program_id',$this->program_id)->get();
        $group_registeredscore = $group->sum('group_score');
         if($group == Null && $this->group_score <= 100 ){
             foreach ($this->group_name as $key => $value) {
                 Group::create(
                     ['group_name' => $this->group_name[$key],
                      'group_score' => $this->group_score[$key],
                      'program_id' => $this->program_id
                     ]
                 );
             }
      
             $this->inputs = [];
       
             $this->resetInputFields();
        
             session()->flash('message', 'لقد تم اضافة المجموعات بنجاح');
         }else{
             foreach($this->group_score as $key => $value){
                
                 $this->j += $this->group_score[$key];
                }
        
                 foreach ($this->group_score as $key => $value) {
                    if(100 - ($group_registeredscore +  $this->j ) >= 0)
                    {
                        Group::create(
                            ['group_name' => $this->group_name[$key],
                             'group_score' => $this->group_score[$key],
                             'program_id' => $this->program_id
                            ]
                        );
                        

                        session()->flash('message', 'لقد تم اضافة المجموعات بنجاح');

                    }
                    else{
                        session()->flash('failure', ' %عفوا! لايمكن اضافة مجموعات جديدة لان مجموع اوزان المجموعة لهذا البرنامج يتخطي 100 ');                    
                        break;

                    }

                    
             }
                       $this->inputs = [];
        
                        $this->resetInputFields();
                        $this->emit('groupadded');

         }

   
   }




    public function render()
    {
        $listners = ['groupadded'=>'$refresh'];
        $groups = Group::where('program_id',$this->program_id)->get();
        return view('livewire.makegroups',compact('groups'));
    }
}
