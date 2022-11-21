<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'country_id',
        'state_id',
        'stateId',
        'state',
        'cityId',
        'city',
        'city_code',
        'call_us',
        'bcc_email',
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
        return $this->belongsTo(State::class,'stateId','stateId');
    }
   
}
