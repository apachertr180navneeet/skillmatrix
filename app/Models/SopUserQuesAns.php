<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SopUserQuesAns extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sopuserquesans';

    protected $fillable = [
        'sop_id',
        'user_id',
        'ques_id',
        'answere',
    ];

    protected $dates = ['deleted_at'];

    /*
    |------------------------------
    | Relationships (Optional)
    |------------------------------
    */
    public function sop()
    {
        return $this->belongsTo(Sop::class, 'sop_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function question()
    {
        return $this->belongsTo(SopQuestion::class, 'ques_id');
    }
}
