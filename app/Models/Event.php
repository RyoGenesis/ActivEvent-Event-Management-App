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

    public function scopeFilterBy($query, $request)
    {
        // $query->when($request->status, function ($q) use ($request) {
        //     $q->where('status', $request->status);
        // });
        
        $query->when($request->category_id, function ($q) use ($request) {
            $q->where('category_id', $request->category_id);
        });

        $query->when($request->has_sat, function ($q) {
            $q->where('has_sat',true);
        });

        $query->when($request->has_comserv, function ($q) {
            $q->where('has_comserv',true);
        });

        $query->when($request->has_certificate, function ($q) {
            $q->where('has_certificate',true);
        });

        $query->when($request->price, function ($q) use ($request) {
            if($request->price == 'Free') {
                $q->where('price', 0);
            } else {
                $q->where('price','>',0);
            }
        });

        $query->when($request->max_slot, function ($q) use ($request) {
            if($request->max_slot == 'No Limit') {
                $q->where('max_slot', -1);
            } else {
                $q->where('max_slot','>',0);
            }
        });

        $query->when($request->community_id, function ($q) use ($request) {
            $q->where('community_id', $request->community_id);
        });
    }
}
