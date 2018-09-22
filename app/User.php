<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function compounds()
    {
        return $this->hasMany(Compound::class);
    }

    public function addSupervisor(User $user)
    {
        DB::table('student_supervisor')->insert([
            'student_id'   => $this->id,
            'supervisor_id' => $user->id,
        ]);
    }

    public function supervisors()
    {
        return $this->belongsToMany(User::class, 'student_supervisor', 'student_id', 'supervisor_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'student_supervisor', 'supervisor_id', 'student_id');
    }
}
