<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ladmin\Models\Admin;

class Community extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function events() {
        return $this->hasMany(Event::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_community', 'community_id', 'user_id');
    }

    public function majors() {
        return $this->belongsToMany(Major::class, 'community_major', 'community_id', 'major_id');
    }

    public function admins() {
        return $this->hasMany(Admin::class, 'community_id', 'id');
    }
}
