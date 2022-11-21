<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SampleCollectionCenters extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'centerId',
        'localityId',
        'location',
        'timing',
        'address',
        'cityId',
        'city',
        'stateId',
        'state',
        'phone',
        'email',
        'latitude',
        'longitude',
        'googleReviewLink',
        'whatsAppLink',
        'status',
    ];
}
