<?php
class AuthController extends Controller {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new User();
    }
    
    public function showLogin() {
        $this->render('auth/login', [
            'csrf_token' => $this->generateCSRFToken()
        ]);
    }
    
    public function login() {
        $this->validateCSRF();
        
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? '';
        
        if ($this->userModel->login($email, $password)) {
            $this->redirect('/dashboard');
        } else {
            $this->render('auth/login', [
                'error' => 'Email ou mot de passe incorrect',
                'csrf_token' => $this->generateCSRFToken()
            ]);
        }
    }
    
    public function showRegister() {
        $this->render('auth/register', [
            'csrf_token' => $this->generateCSRFToken()
        ]);
    }
    
    public function register() {
        $this->validateCSRF();
        
        $data = [
            'name' => filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING),
            'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
            'password' => $_POST['password'] ?? '',
            'role' => 'patient' // Par défaut, les nouveaux utilisateurs sont des patients
        ];
        
        if ($this->userModel->register($data)) {
            $this->redirect('/login');
        } else {
            $this->render('auth/register', [
                'error' => 'Erreur lors de l\'inscription',
                'csrf_token' => $this->generateCSRFToken()
            ]);
        }
    }
    
    public function logout() {
        session_destroy();
        $this->redirect('/login');
    }
}