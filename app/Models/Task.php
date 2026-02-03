<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

protected $fillable = [
    'title',
    'notes',
    'duration_minutes',
    'is_completed',
    'time_spent',
    'time_goal',
    'user_id'
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}