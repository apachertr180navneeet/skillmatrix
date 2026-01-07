<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChecklistUserQuesAns extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'checklistsuserquesans';

    protected $fillable = [
        'checklist_id',
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

    public function checklist()
    {
        return $this->belongsTo(Checklist::class, 'checklist_id');
    }

    // If you have a checklist question model
    public function question()
    {
        return $this->belongsTo(ChecklistQuesAns::class, 'ques_id');
    }
}
