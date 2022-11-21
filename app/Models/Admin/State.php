<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'country_id',
        'stateId',
        'state',
        'state_code',
        'status',
    ];


    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
