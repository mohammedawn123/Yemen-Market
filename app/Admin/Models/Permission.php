<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
class Permission extends Model
{
    protected $table ='permissions' ;
    // protected $guarded=[];
     protected $fillable = [
        'id','name','slug', 'http_uri' ,'created_at','updated_at'
    ];
    protected $hidden = [
        'pivot'
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class,'roles_permissions' , 'permission_id' , 'role_id');
    }
    public function users()
    {
        return $this->belongsToMany(Admin::class, 'users_permissions' , 'permission_id' , 'admin_id' );
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
            $role->roles()->detach();
            $role->users()->detach();

        });
    }
    public function shouldPassThrough(Request $request): bool
    {
        if (empty($this->http_uri))
        {
            return false;
        }

        $routerCurrent = app()->make('router');
        $uriCurrent = $routerCurrent->getCurrentRoute()->uri;
        $methodCurrent = $request->method();
        $actions = explode(',', $this->http_uri);

        foreach ($actions as $key => $action)
        {
            $method = explode('::', $action);
            if ($method[0] === 'ANY' && ($request->path() . '/*' === $method[1] || $request->is($method[1])))
            {
                return true;
            }
            if ($methodCurrent . '::' . $uriCurrent === $action)
            {
                return true;
            }
        }

        return false;
    }


}
