<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionPlan extends Model
{
    use SoftDeletes;

    protected $table = 'subscription_plan';

    protected $fillable = [
        'plan_name',
        'amount',
        'duration',
        'user',
        'description',
        'status',
    ];

    // Disable updated_at since it's not used
    const UPDATED_AT = null;
}
