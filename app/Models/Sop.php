<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sop extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sop';

    protected $fillable = [
        'title',
        'department_id',
        'party_id',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];
}
