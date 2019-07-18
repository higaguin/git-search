<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryTrack extends Model
{
    public $timestamps = true;

    protected $table = 'history_tracks';

    public function git_detail()
    {
        return $this->hasOne('App\GitDetail', 'id', 'git_detail_id');
    }
}
