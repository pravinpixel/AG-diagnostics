<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeVisit extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'package_id',
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
    public function package()
    {
        return $this->belongsTo(ManagePackage::class,'packageId','id');
    }
}
