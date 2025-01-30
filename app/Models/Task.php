<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'is_completed',
        'user_id', // relates to the user
    ];
     
    // Cast 'due_date' to a Carbon instance for easy manipulation
    protected $casts = [
        'due_date' => 'datetime', // This will cast 'due_date' to a Carbon instance
    ];

    // Relationship to User model (each task belongs to a user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
