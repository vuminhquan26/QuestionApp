<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'ho.users';
    protected $hidden = ['password'];
    protected $fillable = [
        'id',
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'avatar',
        'deleted_at',
        'deleted_by',
        'gender',
        'phone',
        'school_name',
        'city' ,
        'area',
        'is_first_login',
        'birth_date',
        'provience_name',
        'ward_name',
        'organization_name',
        'grade_level_id',

    ];

    // USER -> ASSESSMENT SETS (created_by)
    public function assessmentSets()
    {
        return $this->hasMany(AssessmentSet::class, 'created_by', 'id');
    }
    public function role()
    {
        return $this->belongsToMany(
            Role::class,
            'ho.model_has_roles',
            'model_id',
            'role_id'
        );
    }
}
