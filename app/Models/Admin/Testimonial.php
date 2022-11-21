<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Testimonial extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'date',
        'type',
        'designation',
        'video_url',
        'photo',
        'video_cover_image',
        'given_by',
        'description',
        'status',
    ];
}
