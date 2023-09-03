<?php


namespace App\Utils;


use Illuminate\Support\Arr;

trait PermissionHelper
{
    public function checkPermission($permissions, $module, $func = null)
    {
        if (in_array('all', $permissions))
            return;

        elseif (!in_array($module, array_keys($permissions)))
            return abort(403);

        if (in_array($module, array_keys($permissions)) && in_array($func, $permissions[$module]))
            return;

        return abort(403);
    }

    public function getPermissions($permissions, $module)
    {
        if ($permissions != null && in_array('all', $permissions))
            return ['show', 'edit', 'delete', 'add'];//because of the custom fields to avoid not to be viewed when permitted
        elseif (!isset($permissions[$module]))
            return abort(403);
        return $permissions[$module];
    }

    public function hasPermissions($permissions, $module)
    {
        if ( $permissions == null)
            return false;
        if (in_array('all', $permissions))
            return true;
        elseif (!isset($permissions[$module]))
            return false;
        return true;
    }

    public function allowedRole($permission_name, $allowedArray )
    {
        return sizeof($allowedArray) == 0 || in_array($permission_name ,  $allowedArray );
    }
}
