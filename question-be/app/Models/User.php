<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Classes;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class User extends Authenticatable implements JWTSubject
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
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function getJWTIdentifier() {
        return $this->getKey();
    }
    public function getJWTCustomClaims() {
        return [];
    }
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
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            Role::class,
            'model_has_roles',
            'model_id',
            'role_id'
        );
    }
    public function classes()
    {
        return $this->belongsToMany(
            Classes::class,
            'enroll_class_users',
            'user_id',
            'class_id'
        );
    }
}