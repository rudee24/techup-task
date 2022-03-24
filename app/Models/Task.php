<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Note;

class Task extends Model
{
    use HasFactory;

    public function notes(){

        return $this->hasMany(Note::class);

    }
}

