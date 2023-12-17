<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'user_id',
        'assigned_staff_user_id',
        'title',
        'observed_date',
        'details',
        'completed_at'
    ];
}
