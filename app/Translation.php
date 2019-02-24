<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    //
    protected $casts = [
        'content' => 'array',
    ];
    protected $fillable = [
        'content',
        'language',
        'col_title'
    ];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function translatable()
    {
        return $this->morphTo();
    }

}
