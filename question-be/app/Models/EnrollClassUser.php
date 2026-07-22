<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrollClassUser extends Model
{
    protected $table = 'ho.enroll_class_users';
    protected $fillable = [
        'code',
        'class_id',
        'user_id',
        'used_at'
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
