<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoUserResult extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'videouserresult';

    protected $fillable = [
        'vedio_id',
        'user_id',
        'result',
        'result_status',
        'total_questions',
        'correct_answers',
        'wrong_answers',
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
}
