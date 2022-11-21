<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class NewsEventImage extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'image',
        'news_event_id',
        'status',
        
    ];
}
