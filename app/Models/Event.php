<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'has_certificate' => 'boolean',
        'has_comserv' => 'boolean',
        'has_sat' => 'boolean',
        'exclusive_major' => 'boolean',
        'exclusive_member' => 'boolean',
        'is_highlighted' => 'boolean',
        'date' => 'datetime',
        'registration_end' => 'datetime',
    ];

    protected $dates = ['date','registration_end'];

    public function majors() {
        return $this->belongsToMany(Major::class, 'event_major', 'event_id', 'major_id')->withTrashed();
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_event', 'event_id', 'user_id')
                ->withPivot('status', 'reasoning');
    }

    public function community() {
        return $this->belongsTo(Community::class)->withTrashed();
    }

    public function category() {
        return $this->belongsTo(Category::class)->withTrashed();
    }

    public function bgas() {
        return $this->belongsToMany(Bga::class, 'event_bga', 'event_id', 'bga_id');
    }

    public function sat_level() {
        return $this->belongsTo(SatLevel::class)->withTrashed();
    }
}
