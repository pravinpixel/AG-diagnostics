<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Organ extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'organs',
        'status',
    ];
}
