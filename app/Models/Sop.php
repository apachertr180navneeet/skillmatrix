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
        'sop_upload',
        'is_suggestion',
        'description',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * SOP belongs to a Department
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    /**
     * SOP belongs to a Company (party)
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'party_id');
    }

    public function sopQuesAns()
    {
        return $this->hasMany(SopQuesAns::class, 'sop_id', 'id');
    }
}
