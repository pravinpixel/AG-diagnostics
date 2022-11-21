<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsEvents extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'event_name',
        'type',
        'start',
        'description',
        'choose',
        'news_image',
        'photo',
        'mobile_image',
        'video_url',
        'news_url',
        'event_image',
        'status',
        'meta_title',
        'meta_keyword',
        'meta_description',
        
    ];
}
