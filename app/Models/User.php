<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'nim',
        'personal_email',
        'campus_id',
        'faculty_id',
        'major_id',
        'topics'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
        'topics' => 'array',
    ];

    public function campus() {
        return $this->belongsTo(Campus::class)->withTrashed();
    }

    public function faculty() {
        return $this->belongsTo(Faculty::class)->withTrashed();
    }

    public function major() {
        return $this->belongsTo(Major::class)->withTrashed();
    }

    public function communities() {
        return $this->belongsToMany(Community::class, 'user_community', 'user_id', 'community_id')->withTrashed();
    }

    public function events() {
        return $this->belongsToMany(Event::class, 'user_event', 'user_id', 'event_id')->withTrashed()
                ->withPivot('status', 'reasoning')->withTimestamps();
    }

    public function events_upcoming() {
        return $this->belongsToMany(Event::class, 'user_event', 'user_id', 'event_id')
                ->where('date','>',Carbon::now())
                ->wherePivot('status', 'Registered')
                ->withPivot('status', 'reasoning');
    }

    public function events_rejected() {
        return $this->belongsToMany(Event::class, 'user_event', 'user_id', 'event_id')->withTrashed()
                ->where('date','>',Carbon::now())
                ->where(function($q) {
                    //get upcoming events that got cancelled along with events registration that got rejected
                    $q->whereNotNull('deleted_at')->orWhere('user_event.status', 'Rejected');
                })
                ->withPivot('status', 'reasoning');
                
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'user_category_interest', 'user_id', 'category_id')->withTrashed();
    }
}
