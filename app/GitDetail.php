<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GitDetail extends Model
{
    public $timestamps = true;
    
    protected $table = 'git_details';

    // public function git_user()
    // {
    //     return $this->belongsTo('App\GitUser');
    // }
}
