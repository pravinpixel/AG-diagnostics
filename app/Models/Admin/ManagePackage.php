<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManagePackage extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'primaryId',
        'packageName',
        'packageCode',
        'icon',
        'cityId',
        'cityName',
        'testLists',
        'testSchedule',
        'sampleType',
        'ageRestrictions',
        'preRequisties',
        'reportAvailability',
        'comments',
        'fees',
        'homeVisit',
        'discountFees',
        'is_selected',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'sorting_order',
        'status',
        'is_selected'
    ];
    public function condition()
    {
        return $this->belongsTo(Condition::class,'condition_id','id');
    }
    public function organ()
    {
        return $this->belongsTo(Organ::class,'organ_id','id');
    }
    public function specialty()
    {
        return $this->belongsTo(Speciality::class,'specialty_id','id');
    }
    
    
}
