<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ManageTest extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'primaryId',
        'testName',
        'testCode',
        'cityId',
        'cityName',
        'details',
        'sample',
        'container',
        'qty',
        'storage',
        'method',
        'comments',
        'fees',
        'homeVisit',
        'discountFees',

        'type',
        'category_id',
        'pre_instruction',
        'report_delivery',
        'status',
    ];
   
}
