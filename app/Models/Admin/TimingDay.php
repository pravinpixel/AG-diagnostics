<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class TimingDay extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'days',
        'status',
    ];
}
