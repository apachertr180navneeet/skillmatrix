<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChecklistQuesAns extends Model
{
    use SoftDeletes;

    protected $table = 'checklist_ques_ans';

    protected $fillable = [
        'checklist_id',
        'question',
        'option_one',
        'option_two',
        'option_three',
        'option_four',
        'answer_option',
    ];

    /* ================= RELATIONSHIPS ================= */

    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }
}

