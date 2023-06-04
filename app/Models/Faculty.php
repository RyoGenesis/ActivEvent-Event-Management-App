<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faculty extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function users() {
        return $this->hasMany(User::class);
    }

    public function majors() {
        return $this->hasMany(Major::class);
    }
}
