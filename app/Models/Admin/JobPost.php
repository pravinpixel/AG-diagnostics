<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPost extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'job_title',
        'cityId',
        'department_id',
        'experience',
        'education',
        'job_purpose',
        'responsibilities',
        'status',
        
    ];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class,'cityId','cityId')->select('cityId','city');
    }
    
}
