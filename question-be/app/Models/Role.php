<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'ho.roles';
    protected $fillable = [
        'id',
        'name',
        'guard_name',
        'create_at',
        'update_at'
    ];
    public function modelHasRole(){
        return $this->hasMany(ModelHasRole::class, 'role_id', 'id');
    }
}
