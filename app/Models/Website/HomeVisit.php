<?php

namespace App\Models\Website;

use App\Models\Admin\Area;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class HomeVisit extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'packageId',
        'title',
        'first_name',
        'last_name',
        'email',
        'mobile',
        'gender',
        'dob',
        'address',
        'date',
        'timing',
        'status',
    ];
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function areas()
    {
        return $this->hasOne(Area::class,'id','area');
    }
}
