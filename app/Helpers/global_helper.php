<?php

if (!function_exists('hasPermission')) {
    function hasPermission($perm)
    {
        $permissions = session('user_permission') ?? [];

        return in_array($perm, $permissions);
    }
}

if (!function_exists('hasAnyPermission')) {
    function hasAnyPermission(array $perms)
    {
        $permissions = session('user_permission') ?? [];

        foreach ($perms as $perm) {
            if (in_array($perm, $permissions)) {
                return true;
            }
        }

        return false;
    }
}