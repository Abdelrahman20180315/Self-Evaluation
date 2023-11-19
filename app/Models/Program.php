<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $fillable=[
        'program_name',
        'organization_status'
    ];

    public function group()
    {
        return $this->hasMany('App\Models\Group');
    }

    public function evaluation()
    {
        return $this->hasMany('App\Models\Evaluation');
    }
}
