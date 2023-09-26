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
        
        //Category filter
        $query->when($request->categories, function ($q) use ($request) {
            $q->whereIn('category_id', $request->categories);
        });

        //SAT filter
        $query->when($request->has_sat, function ($q) use ($request) {
            if($request->has_sat == 'Yes') {
                $q->where('has_sat',true);
            } else if ($request->has_sat == 'No'){
                $q->where('has_sat',false);
            }
        });

        //Comserv filter
        $query->when($request->has_comserv, function ($q) use ($request) {
            if($request->has_comserv == 'Yes') {
                $q->where('has_comserv',true);
            } else if ($request->has_comserv == 'No'){
                $q->where('has_comserv',false);
            }
        });

        //certificate filter
        $query->when($request->has_certificate, function ($q) use ($request) {
            if($request->has_certificate == 'Yes') {
                $q->where('has_certificate',true);
            } else if ($request->has_certificate == 'No'){
                $q->where('has_certificate',false);
            }
        });

        //price filter
        $query->when($request->price, function ($q) use ($request) {
            if($request->price == 'Free') {
                $q->where('price', 0);
            } else if ($request->price == 'Paid'){
                $q->where('price','>',0);
            }
        });

        //slot limitation filter
        $query->when($request->max_slot, function ($q) use ($request) {
            if($request->max_slot == 'No Limit') {
                $q->where('max_slot', -1);
            } else if ($request->max_slot == 'Limited'){
                $q->where('max_slot','>',0);
            }
        });

        //exclusivity filter
        $query->when($request->exclusivity, function ($q) use ($request) {
            if($request->exclusivity == 'For Everyone') {
                $q->where('exclusive_major', false)->where('exclusive_member',false);
            } else if ($request->exclusivity == 'Exclusive'){
                $q->where(function ($q) {
                    $q->where('exclusive_major', true)->orWhere('exclusive_member',true);
                });
            }
        });

        //community filter
        $query->when($request->communities, function ($q) use ($request) {
            $q->whereIn('community_id', $request->communities);
        });
    }
}
