<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VedioQuesans extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vedio_quesans';

    protected $fillable = [
        'vedio_id',
        'question',
        'option_one',
        'option_two',
        'option_three',
        'option_four',
        'answere_option',
    ];

    /**
     * Relationship: Question belongs to a Video
     */
    public function vedio()
    {
        return $this->belongsTo(Vedio::class, 'vedio_id');
    }
}
