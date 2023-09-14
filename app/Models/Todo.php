<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'user_id', 'priority', 'description', 'is_checked', 'due_date'];

    protected $attributes = ['priority' => "Medium", 'is_checked' => false, 'due_date' => null ];

    protected $dates = ['due_date'];
}
