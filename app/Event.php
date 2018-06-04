<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Collective\Html\Eloquent\FormAccessible;

class event extends Model
{
    protected $fillable = [
      'user_id','title','content','date_start','date_end','time_start','time_end'
    ];

    use FormAccessible;

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

    public function formDateStartAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function formDateEndAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function formTimeStartAttribute($value)
    {
        return Carbon::parse($value)->format('H:i');
    }

    public function formTimeEndAttribute($value)
    {
        return Carbon::parse($value)->format('H:i');
    }
}
