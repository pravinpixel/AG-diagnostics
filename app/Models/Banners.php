<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banners extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'Title',
        'Content',
        'Url',
        'DesktopImage',
        'MobileImage',
        'OrderBy',
        'Status'
    ];
}
