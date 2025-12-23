<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoUserQuesAns extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'videouserquesans';

    protected $fillable = [
        'vedio_id',
        'user_id',
        'ques_id',
        'answere',
        'company_id'
    ];

    /* ================= RELATIONSHIPS ================= */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class, 'vedio_id');
    }

    // If you have a video question model
    public function question()
    {
        return $this->belongsTo(VedioQuesans::class, 'ques_id');
    }
}
