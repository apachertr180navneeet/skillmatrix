<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SopUserResult extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sopuserresults';

    protected $fillable = [
        'sop_id',
        'user_id',
        'result',
        'result_status',
        'total_questions',
        'correct_answers',
        'wrong_answers',
    ];

    protected $casts = [
        'result' => 'integer',
    ];

    /* ================= RELATIONS ================= */

    public function sop()
    {
        return $this->belongsTo(Sop::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
