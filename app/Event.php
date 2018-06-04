<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    protected $fillable = [
      'user_id','title','content','date_start','date_end','time_start','time_end'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
