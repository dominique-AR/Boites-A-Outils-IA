<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Vérifiez si l'utilisateur est connecté
        if (! session()->get('isLoggedIn')) {
            // Si non connecté, redirigez vers la page de connexion
            return redirect()->to('/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Pas nécessaire ici, mais vous pouvez modifier la réponse après l'exécution du contrôleur si nécessaire
    }
}
