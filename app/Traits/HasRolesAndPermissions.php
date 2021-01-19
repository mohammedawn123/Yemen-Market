<?php
namespace App\Traits;
use App\Admin\Models\Admin;
use App\Admin\Models\Permission;
use App\Admin\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait HasRolesAndPermissions
{
    protected static $allPermissions = null;

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles' , 'admin_id' ,'role_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions' , 'admin_id' , 'permission_id');
    }
    public static function user()
    {
        return Auth::guard('admin')->user();
    }

    //////////////////////////// roles ///////////////////////////
    public function isRole(string $role)
    {
      return $this->roles->pluck('slug')->contains($role);
    }
    public function inRoles(array $roles = [])
    {
        return $this->roles->pluck('slug')->intersect($roles)->isNotEmpty();
    }
    public function isViewAll()
    {
        return $this->isRole('view.all');
    }


    public function isAdministrator()
    {
        return $this->isRole('administrator');
    }

/////////////////////////////// permissions///////////////////////
    public function can($ability , $arguments = [])
    {
        if ($this->isAdministrator()) {
            return true;
        }

        if ($this->permissions->pluck('slug')->contains($ability)) {
            return true;
        }

        return $this->roles->pluck('permissions')->flatten()->pluck('slug')->contains($ability);
    }


    public function cannot( $ability , $arguments = [])
    {
        return !$this->can($ability);
    }


    public static function allPermissions()
    {

            $user= Admin::user();
           $allPermissions = $user->roles()->with('permissions')->get()->pluck('permissions')->flatten()->merge($user->permissions);
/*$urls=$allPermissions->pluck('http_uri')->toArray();
        $arrView = [];
foreach ($urls as $url)
{

    $actions= explode(',' , $url);
    foreach ($actions as $action)
    {
        if (strpos($action, 'ANY::') === 0 || strpos($action, 'GET::') === 0) {
            $arrPrefix = ['ANY::', 'GET::'];
            $arrScheme = ['https://', 'http://'];
            $arrView[] = str_replace($arrScheme, '', url(str_replace($arrPrefix, '', $action)));
        }

    }

} dd($arrView);*/
        return $allPermissions;
    }




/*
    public function hasPermission($permission)
    {
       return (bool) $this->permissions->where('slug', $permission)->count();
    }

    public function hasPermissionTo($permission)
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    public function hasPermissionThroughRole($permission)
     {
        $perm=  Permission::where('slug' , $permission )->first();

        if($perm === null)
            return false;

        foreach ($perm->roles as $role)
          {
            if($this->roles->contains('slug' , $role->slug))
              {
                return true;
              }
          }
         return false;
     }
    public function getPermissionsOfRole($role)
    {
         $role=Role::where('slug' , $role)->first();
         return $role->permissions->toarray();

    }
    public function getAllPermissions()
    {
        return  $this->permissions();
    }
    protected function getPermissions(array $permissions)
    {
        return  $this->permissions()->whereIn('slug',$permissions)->get();
    }
    public function givePermissionsTo(... $permissions)
    {
        foreach ($permissions as $permission) {
            $permissions1 = Permission::where('slug',$permission['slug'])->get();

            if (!$permissions1->count()>0 ) {

                $this->permissions()->createMany(array($permission));
            }

        }  return $this;
    }
    public function deletePermissions(... $permissions )
    {
        $permissions=$this->getPermissions($permissions);

        foreach ($permissions as $permission) {
            $permission->delete();
           // $this->permissions()->detach($permission);
        }
        return $this->getAllPermissions;
    }
    public function refreshPermissions(... $permissions )
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }*/

}
