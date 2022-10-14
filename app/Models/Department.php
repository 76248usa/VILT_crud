<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone'
    ];

    public function employees()
    {
        return $this->hasMany(\App\Models\Employee::class);
    }

    public function teachers()
    {
        return $this->hasMany(\App\Models\Teacher::class);
    }
}
