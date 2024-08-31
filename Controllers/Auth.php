<?php
namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        $session = session();
        $model = new UserModel();

        // Vérifie si la méthode de la requête est POST
        if ($this->request->getMethod() === 'post') {
            $username = trim($this->request->getVar('username'));
            $password = trim($this->request->getVar('password'));
            $user = $model->where('username', $username)->first();
           
            if ($user &&  password_verify($password, trim($user['password']))) {
                $sessionData = [
                    'username' => $user['username'],
                    'isLoggedIn' => true,
                ];
                $session->set($sessionData);
                return redirect()->to('/'); // Assurez-vous que cette route est correcte
            } else {
                $session->setFlashdata('error', 'Username or Password is incorrect');
                return redirect()->back()->withInput();
            }
        }

        // Charger la vue pour le formulaire de connexion si aucune donnée POST n'est détectée
        // ou si l'utilisateur vient de naviguer vers la page de connexion
        return view('auth/login');
    }
        // Méthode pour afficher le formulaire d'inscription
        public function showRegisterForm()
        {
            return view('auth/register');
        }
    
        // Méthode pour traiter la soumission du formulaire d'inscription
        public function register()
        {
            helper(['form']);
            $session = session();
            $rules = [
                'username' => 'required|min_length[5]|max_length[50]',
                'password' => 'required|min_length[8]|max_length[255]',
                'role' => 'required|in_list[administrateur,utilisateur]'
            ];
    
            if ($this->validate($rules)) {
                $model = new UserModel();
                $data = [
                    'username' => trim($this->request->getVar('username')),
                    'password' => trim($this->request->getVar('password')),
                    'role' => trim($this->request->getVar('role'))
                ];
                $model->saveUser($data);
                return redirect()->to('/login');
            } else {
                $session->setFlashdata('error', 'Invalid input');
                return redirect()->back()->withInput();
            }
        }
        // Page de confirmation (peut être une vue PHP)
public function showConfirmationForm()
{
    $session = session();
    $tempData = $session->get('temp_data');
    if (!$tempData) {
        return redirect()->to('/register'); // Rediriger si aucune donnée temporaire n'est disponible
    }
    
    echo view('auth/confirm_form', ['tempData' => $tempData]);
}

public function finalizeRegistration()
{
    $session = session();
    $tempData = $session->get('temp_data');
    if (!$tempData) {
        // Rediriger si aucune donnée temporaire n'est stockée
        return redirect()->to('auth/register');
    }
    $username = trim($this->request->getVar('username'));
    $password = trim($this->request->getVar('password'));
    $model = new UserModel();
    $user = $model->where('username', $username)->first();
   
    if ($user && trim($user['role']) == "administrateur" &&  password_verify($password, trim($user['password']))) {
    $data = [
        'username' => trim($tempData['username']),
        'password' => trim($tempData['password']),
        'role' => trim($this->request->getVar('role'))
    ];
    $model->saveUser($data);
    $session->remove('temp_data');  // Nettoyer la session après l'enregistrement
    $session->setFlashdata('success', 'Account successfully created. Please login.');
    return redirect()->to('/login'); // Assurez-vous que cette route est correcte
    } else {
        $session->setFlashdata('error', 'Username or Password is incorrect');
        return redirect()->back()->withInput();
    }
}



        // Controller Method: initialRegistration
public function initialRegistration()
{
    helper(['form']);
    $session = session();
    $rules = [
        'username' => 'required|min_length[5]|max_length[50]',
        'password' => 'required|min_length[8]|max_length[255]',
        'role' => 'required|in_list[administrateur,utilisateur]'
    ];

    if ($this->validate($rules)) {
        // Stockage temporaire des données
        $session->set('temp_data', [
            'username' => trim($this->request->getVar('username')),
            'password' => trim($this->request->getVar('password')),
            'role' => trim($this->request->getVar('role'))
        ]);
        
        // Redirection vers le formulaire de confirmation
        return redirect()->to('/auth/confirm');
    } else {
        $session->setFlashdata('error', 'Invalid input');
        return redirect()->back()->withInput();
    }
}


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}