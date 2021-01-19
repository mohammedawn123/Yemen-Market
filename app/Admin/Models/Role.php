<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table ='roles' ;
    protected $guarded=[];
   /* protected $fillable = [
        'id','name','slug', 'created_at','updated_at'
    ];*/

    protected $hidden = [
         'pivot'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'roles_permissions' ,'role_id' , 'permission_id');
    }

    public function users()
    {
        return $this->belongsToMany(Admin::class, 'users_roles' , 'role_id' ,'admin_id');
    }
    public function  getCreatedAtAttribute($val)
    {
          return date_create($val)->format("yy-m-d") ;
    }
    public function  getUpdatedAtAttribute($val)
    {
        return date_create($val)->format("yy-m-d") ;
    }

    protected static function boot()
    {
        parent::boot();
        // before delete() method call this
        static::deleting(function ($role) {

            $role->permissions()->detach();
            $role->users()->detach();

        });
    }
}
