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
if (!function_exists('formatarDocumento')) {
    function formatarDocumento($valor)
    {
        $valor = preg_replace('/\D/', '', $valor);
        if (strlen($valor) === 11) {
            return preg_replace(
                '/(\d{3})(\d{3})(\d{3})(\d{2})/',
                '$1.$2.$3-$4',
                $valor
            );
        }
        if (strlen($valor) === 14) {
            return preg_replace(
                '/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/',
                '$1.$2.$3/$4-$5',
                $valor
            );
        }
        return $valor;
    }
}