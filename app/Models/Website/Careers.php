<?php

namespace App\Models\Website;

use App\Models\Admin\JobPost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Careers extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'job_id',
        'file',
        'address',
        'cover_letter',
    ];
    public function job()
    {
        return $this->belongsTo(JobPost::class)->select('id','job_title');
    }
}
