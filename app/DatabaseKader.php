<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatabaseKader extends Model
{
	protected $table = 'users';
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'hp', 'department', 'address', 'photo', 'komisariat', 'gcmtoken', 'sex', 'age', 'jenjang_training', 
        'pengalaman_organisasi', 'linkedin', 'instagram', 'other_social_media', 'year_join', 'angkatan_kuliah'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
