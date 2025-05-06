<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Cek role-based access
        $currentRoute = service('router')->getMatchedRoute()[0] ?? '';
        $role = session()->get('role');

        // Jika bukan admin, batasi akses ke routes tertentu
        if ($role != 'admin') {
            $restrictedRoutes = ['users', 'categories', 'item-types', 'power-types', 'item-kinds', 'units'];
            foreach ($restrictedRoutes as $route) {
                if (strpos($currentRoute, $route) !== false) {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}