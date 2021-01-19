<?php

namespace App\Admin\Models;

use App\Traits\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    use  HasRolesAndPermissions;
protected $table ='admins' ;
protected $guard='admin' ;
    protected $fillable = [
        'id','photo','name', 'email', 'password','status','updated_at' , 'created_at'
    ];


  protected $hidden = [
        'password', 'remember_token' , 'pivot'
    ];

    /**
     * The attributes that should be cast to native types.
     * *
    @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected static function boot()
    {
        parent::boot();
        // before delete() method call this
        static::deleting(function ($user) {

            $user->roles()->detach();
            $user->permissions()->detach();

        });
    }
}
