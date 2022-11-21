<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brochure extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'title',
        'brochure',
        'type',
        'status',
    ];
}
