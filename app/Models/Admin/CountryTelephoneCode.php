<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CountryTelephoneCode extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'code',
        'country_id',
        'status',
    ];
}
