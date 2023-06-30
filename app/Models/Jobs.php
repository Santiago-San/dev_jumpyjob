<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Jobs extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
	protected $table = 'jobs'; 
    protected $fillable = [
        'id',
        'title',
        'slug',
        'cat_id',
        'sub_cat_id',
        'short_description',
        'description',
        'package_anum',
        'exp_date',
        'job_type',
        'job_lat',
        'job_long',
        'job_address',
        'city',
        'state',
        'postal_code',
        'job_skills',
        'status',
        'gender',
        'vacancy',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
   
}
