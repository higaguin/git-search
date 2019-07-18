<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GitUser extends Model
{
    public $timestamps = true;

    protected $table = 'git_users';

    public function git_detail()
    {
        return $this->hasOne('App\GitDetail', 'id', 'git_detail_id');
    }
}
