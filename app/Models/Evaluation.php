<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use \Znck\Eloquent\Traits\BelongsToThrough;

class Evaluation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'total_score',
        'program_id',
        'question_id',
        'evaluate_id',
        'result_value',
        'evalute_num',
        'evalute_text',
        'pdf_text',
        'pdf_path',
        'pdf_text_status',
        'show_user_results',
        'show_user_pdf',
        'organization_status'        
    ];
    public function user()
    {
        // return $this->belongsTo('Model', 'foreign_key', 'owner_key'); 
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function program()
    {
        // return $this->belongsTo('Model', 'foreign_key', 'owner_key'); 
        return $this->belongsTo('App\Models\Program','program_id','id');
    }
    public function question()
    {
        // return $this->belongsTo('Model', 'foreign_key', 'owner_key'); 
        return $this->belongsTo('App\Models\Question','question_id','id');
    }
    // public function results(){
    //     return $this->belongsToThrough(Result::class, Question::class);
    // }
}
