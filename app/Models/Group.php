<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable=[
        'program_id',
        'group_name',
        'group_score'
    ];

    public function program()
    {
        // return $this->belongsTo('Model', 'foreign_key', 'owner_key'); 
        return $this->belongsTo('App\Models\Program','program_id','id');
    }

    public function question()
    {
        return $this->hasMany('App\Models\Question');
    }
}
