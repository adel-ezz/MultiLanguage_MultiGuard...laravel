<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Department extends Model
{

    use Translatable;
    protected $fillable=['name'];


    function users()
    {
        return $this->hasMany(User::class,'department_id');
    }

}
