<?php
class Router {
    private $routes = [];
    
    public function addRoute($method, $path, $controller, $action) {
        // Remplace les paramètres dynamiques {id} par une regex
        $path = preg_replace('/{([^\/]+)}/', '([^/]+)', $path);
        $this->routes[] = [
            'method' => $method,
            'path' => "#^" . $path . "$#",
            'controller' => $controller,
            'action' => $action
        ];
    }
    
    public function dispatch() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestPath = rtrim($requestPath, '/'); // Normalisation

        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && preg_match($route['path'], $requestPath, $matches)) {
                array_shift($matches); // Retire l'URL complète de la capture
                $controller = new $route['controller']();
                $action = $route['action'];
                
                return call_user_func_array([$controller, $action], $matches);
            }
        }

        // Route non trouvée
        header("HTTP/1.0 404 Not Found");
        require_once "app/views/error/404.php";
        exit;
    }
}