<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'link', 'category', 'description',
    ];

    protected $casts = [
        'category' => 'array',
    ];
}
