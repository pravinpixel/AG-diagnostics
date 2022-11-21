<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'country',
        'iso_code_two',
        'iso_code_three',
        'status',
        'country_code',
    ];
}
