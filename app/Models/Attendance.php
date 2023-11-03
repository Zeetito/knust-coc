<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attendance extends Model
{
    use HasFactory;

    // The type of service should be added to the table so that we could query later, how many times an
    // individual has attended a particular servie, say evening service

    protected $fillable = [
        'meeting_type',
        'venue',
        // 'checked_by',

    ];

    // public function members(): hasMany{
    //     return $this->hasMany(User::class,'attendance_users','attendance_id','user_id')
    //     ->withPivot('user_id')
    //     ;
    // }

    // RELATIONSHIPS

    // Members function to query for users who're currently members and present
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'attendance_users', 'attendance_id', 'person_id')
            ->where('is_member', 1)
            ->withPivot('person_id', 'checked_by');
    }

    // Members function to query for users who're currently members and present
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'attendance_users', 'attendance_id', 'person_id')
            ->where('is_member', 1)
            ->withPivot('person_id', 'checked_by');
    }

    // Visitors function, querrying for users who're not currently members and guests present
    // Using the is_member attribute on every user
    public function visitors()
    {

    }

    public function meeting(): BelongsTo
    {
        return $this->belongsTo(Meeting::class, 'meeting_type');
    }

    public function user_marked_by($user)
    {
        return User::find($user);
    }

    // Getting All Males(Members) present for a particular attendance session
    public function males_members_present()
    {
        return User::where('is_member', 1)
                        ->join('attendance_users', 'users.id', '=', 'attendance_users.person_id')
                        ->where('attendance_users.attendance_id', $this->id)
                        ->where('users.gender', 'm')
                        ->where('attendance_users.is_user', 1)
                        ->get();
    }

    // MEMBERS
    // Getting Females(Members) present for a particular attendance session
    public function females_members_present()
    {
        return User::where('is_member', 1)
                        ->join('attendance_users', 'users.id', '=', 'attendance_users.person_id')
                        ->where('attendance_users.attendance_id', $this->id)
                        ->where('users.gender', 'f')
                        ->where('attendance_users.is_user', 1)
                        ->get();
    }

    // VISITORS - GUESTS
    // Getting All (Guest) present for a particular attendance session
    public function guests_present()
    {
        return Guest::
                // where('is_member',1)
                join('attendance_users', 'guests.id', '=', 'attendance_users.person_id')
                    ->where('attendance_users.attendance_id', $this->id)
                    ->where('attendance_users.is_user', 0)
                    ->get();
    }

    // Getting Males (Guest) present for a particular attendance session
    public function males_guests_present()
    {
        return Guest::
                // where('is_member',1)
                join('attendance_users', 'guests.id', '=', 'attendance_users.person_id')
                    ->where('attendance_users.attendance_id', $this->id)
                    ->where('guests.gender', 'm')
                    ->where('attendance_users.is_user', 0)
                    ->get();
    }

    // Getting females (Guest) present for a particular attendance session
    public function females_guests_present()
    {
        return Guest::
                // where('is_member',1)
                join('attendance_users', 'guests.id', '=', 'attendance_users.person_id')
                    ->where('attendance_users.attendance_id', $this->id)
                    ->where('guests.gender', 'f')
                    ->where('attendance_users.is_user', 0)
                    ->get();
    }

    // VISITORS - USERS
    // Getting All Users who visited (not Members)
    public function users_visitors_present()
    {
        return User::where('is_member', 0)
                        ->join('attendance_users', 'users.id', '=', 'attendance_users.person_id')
                        ->where('attendance_users.attendance_id', $this->id)
                        ->where('attendance_users.is_user', 1)
                        ->get();
    }

    // Getting Male Users who visited (not Members)
    public function users_male_visitors_present()
    {
        return User::where('is_member', 0)
                        ->join('attendance_users', 'users.id', '=', 'attendance_users.person_id')
                        ->where('attendance_users.attendance_id', $this->id)
                        ->where('users.gender', 'm')
                        ->where('attendance_users.is_user', 1)
                        ->get();
    }

    // Getting Female Users who visited (not Members)
    public function users_female_visitors_present()
    {
        return User::where('is_member', 0)
                        ->join('attendance_users', 'users.id', '=', 'attendance_users.person_id')
                        ->where('attendance_users.attendance_id', $this->id)
                        ->where('users.gender', 'f')
                        ->where('attendance_users.is_user', 1)
                        ->get();
    }

    // Get the total visitors count
    public function visitors_count()
    {
        return $this->males_guests_present()->count() + $this->females_guests_present()->count() + $this->users_male_visitors_present()->count() + $this->users_female_visitors_present()->count();
    }

    // Get the total count of individuals for a particular attendance session
    public function total_count()
    {
        return $this->visitors_count() + $this->members()->count();
    }
}
