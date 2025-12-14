<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checklist extends Model
{
    use SoftDeletes;

    protected $table = 'checklists';

    protected $fillable = [
        'party_id',
        'department_id',
        'title',
        'description',
        'file',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = false; 
    // because created_at is handled by DB default


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
}
