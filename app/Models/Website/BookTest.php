<?php

namespace App\Models\Website;

use App\Models\Admin\Area;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookTest extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'full_name',
        'mobile',
        'email',
        'area',
        'test',
        'visit',
        'date',
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
