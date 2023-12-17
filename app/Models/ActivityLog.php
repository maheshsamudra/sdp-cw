<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity',
        'user_id'
    ];

    public static function add_log($activity)
    {
        if (!$activity) {
            return false;
        }
        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => $activity
        ]);
        return true;
    }
}
