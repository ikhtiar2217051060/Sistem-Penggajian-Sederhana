<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Admin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        if (! $session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('message', 'Silakan login terlebih dahulu.');
        }

        if ($session->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('message', 'Anda tidak memiliki akses ke halaman tersebut.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing here
    }
}
