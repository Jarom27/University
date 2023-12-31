<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory;

    public function students(){
        return $this->belongsToMany(Student::class);
    }
    public function teachers(){
        return $this->belongsToMany(Teacher::class);
    }
}
