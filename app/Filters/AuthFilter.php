<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use ReturnTypeWillChange;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session('logou')) {
            return redirect()->to('/login');
        }

        // Sem necessidade de permissão
        if (empty($arguments)) {
            return;
        }

        $permissions = session('user_permission') ?? [];

        foreach ($arguments as $perm) {
            if (in_array($perm, $permissions, true)) {
                return;
            }
        }

        // Logado mas sem permissão
        return redirect()->to('/dashboard')->with('error', 'Sem permissão');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
