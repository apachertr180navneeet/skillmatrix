<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;

    // Disable updated_at
    public const UPDATED_AT = null;

    protected $fillable = [
        'title',
        'party_id',
        'department_id',
        'video_file',
        'video_link',
        'is_link',
        'description',
        'is_suggestion',
        'status',
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

    public function videoQuesAns()
    {
        return $this->hasMany(VedioQuesans::class, 'vedio_id', 'id');
    }

}
