<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RequestCallBack extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'mobile',
        'email',
        'remarks',
        'test',
    ];
}
