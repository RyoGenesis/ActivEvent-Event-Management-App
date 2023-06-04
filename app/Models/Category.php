<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function events() {
        return $this->hasMany(Event::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_category_interest', 'category_id', 'user_id');
    }
}
