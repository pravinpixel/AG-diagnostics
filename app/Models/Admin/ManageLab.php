<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManageLab extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'lab_name',
        'address',
        'country_id',
        'state_id',
        'city_id',
        'area_id',
        'location_map_url',
        'location_map',
        'latitude',
        'longitude',
        'near_by',
        'timing',
        'timing_day',
        'landline',
        'mobile',
        'toll_free_number',
        'contact_person',
        'email',
        'facilities',
        'specialty',
        'department',
        'meta_title',
        'meta_keyword',
        'meta_description',
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
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
