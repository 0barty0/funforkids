<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class event extends Model
{
    protected $fillable = [
      'user_id','title','content','date_start','date_end','time_start','time_end'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getDateStartAttribute()
    {
        return Carbon::parse($this->attributes['date_start']);
    }

    public function getDateEndAttribute()
    {
        return Carbon::parse($this->attributes['date_end']);
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at']);
    }
}
