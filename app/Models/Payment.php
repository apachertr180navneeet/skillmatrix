<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'date',
        'plan_name',
        'party_id',
        'amount',
        'utr_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * SOP belongs to a Company (party)
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'party_id');
    }
}