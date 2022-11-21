<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class FeatureStories extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'story_title',
        'date',
        'story_url',
        'description',
        'pdf',
        'video_link',
        'status',
        
    ];
}
