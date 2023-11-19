<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable=[
        'group_id',
        'question_text',
        'question_score',
        'question_resultstatus'
    ];

    public function group()
    {
        // return $this->belongsTo('Model', 'foreign_key', 'owner_key'); 
        return $this->belongsTo('App\Models\Group','group_id','id');
    }

    public function result()
    {
        return $this->hasMany('App\Models\Result');
    }

    public function evaluation()
    {
        return $this->hasMany('App\Models\Evaluation');
    }

}
