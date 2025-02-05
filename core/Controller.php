<?php
abstract class Controller {
    protected function render($view, $data = []) {
        extract($data);
        
        $viewFile = "app/views/" . $view . ".php";
        if (file_exists($viewFile)) {
            require_once "app/views/templates/header.php";
            require_once $viewFile;
            require_once "app/views/templates/footer.php";
        } else {
            die("Vue non trouvée");
        }
    }
    
    protected function redirect($url) {
        header("Location: " . $url);
        exit();
    }
    
    protected function validateCSRF() {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("Token CSRF invalide");
        }
    }
    
    protected function generateCSRFToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
}