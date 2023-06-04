<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function majors() {
        return $this->belongsToMany(Major::class, 'event_major', 'event_id', 'major_id');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_event', 'event_id', 'user_id')
                ->withPivot('status', 'reasoning');
    }

    public function community() {
        return $this->belongsTo(Community::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function bgas() {
        return $this->belongsToMany(Bga::class, 'event_bga', 'event_id', 'bga_id');
    }

    public function sat_level() {
        return $this->belongsTo(SatLevel::class);
    }
}
