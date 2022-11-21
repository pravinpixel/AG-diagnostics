<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'country_id',
        'state_id',
        'city_id',
        'area',
        'area_code',
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
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
