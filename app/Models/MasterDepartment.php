<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterDepartment extends Model
{
    use HasFactory, SoftDeletes;

    // ✅ Table name
    protected $table = 'master_departments';

    // ✅ Primary key (optional, default is 'id')
    protected $primaryKey = 'id';

    // ✅ Fillable fields (as per your columns)
    protected $fillable = [
        'name',
        'status',
    ];

    // ✅ For Soft Delete column
    protected $dates = ['deleted_at'];

    // ✅ Handle timestamps (important for your default issue)
    public $timestamps = true;

    // OPTIONAL: Fix default timestamp issue
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}