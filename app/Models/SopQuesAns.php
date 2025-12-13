<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SopQuesAns extends Model
{
    use SoftDeletes;

    protected $table = 'sop_ques_ans';

    protected $fillable = [
        'sop_id',
        'question',
        'option_one',
        'option_two',
        'option_three',
        'option_four',
        'answere_option',
    ];

    // timestamps enabled
    public $timestamps = true;
}
