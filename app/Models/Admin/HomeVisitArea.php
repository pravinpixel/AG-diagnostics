<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeVisitArea extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'areaId',
        'area',
        'cityId',
        'city',
        'stateId',
        'state',
        'status',
    ];
}
