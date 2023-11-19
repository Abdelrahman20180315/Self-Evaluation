<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_id',
        'result_value',
        'min_value',
        'max_value',
        'result_numrate',
        'result_textrate',
        'result_status',
        'result_statusvalue',
        'pdf_text',
        'pdf_path',
        'pdf_text_status',
        'status_for_group',
        'status_for_evaluation',
    ];

    public function question()
    {
        // return $this->belongsTo('Model', 'foreign_key', 'owner_key'); 
        return $this->belongsTo('App\Models\Question','question_id','id');
    }
}
