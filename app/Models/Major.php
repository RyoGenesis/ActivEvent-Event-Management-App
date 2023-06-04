<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Major extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function users() {
        return $this->hasMany(User::class);
    }

    public function faculty() {
        return $this->belongsTo(Faculty::class);
    }

    public function communities() {
        return $this->belongsToMany(Community::class, 'community_major', 'major_id', 'community_id');
    }

    public function events() {
        return $this->belongsToMany(Event::class, 'event_major', 'major_id', 'event_id');
    }
}
