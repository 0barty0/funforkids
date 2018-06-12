<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;
use Jenssegers\Date\Date;

class event extends Model
{
    protected $fillable = [
      'user_id','title','content','date_start','date_end','time_start','time_end', 'path_image'
    ];

    use FormAccessible;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getDateStartAttribute()
    {
        return Date::parse($this->attributes['date_start']);
    }

    public function getDateEndAttribute()
    {
        return Date::parse($this->attributes['date_end']);
    }

    public function getCreatedAtAttribute()
    {
        return Date::parse($this->attributes['created_at']);
    }

    public function getTimeStartAttribute()
    {
        return substr($this->attributes['time_start'], 0, 5);
    }

    public function getTimeEndAttribute()
    {
        return substr($this->attributes['time_end'], 0, 5);
    }

    public function formDateStartAttribute($value)
    {
        return Date::parse($value)->format('Y-m-d');
    }

    public function formDateEndAttribute($value)
    {
        return Date::parse($value)->format('Y-m-d');
    }

    public function formTimeStartAttribute($value)
    {
        return Date::parse($value)->format('H:i');
    }

    public function formTimeEndAttribute($value)
    {
        return Date::parse($value)->format('H:i');
    }

    public function getImage()
    {
        return \Storage::url($this->path_image);
    }
}
