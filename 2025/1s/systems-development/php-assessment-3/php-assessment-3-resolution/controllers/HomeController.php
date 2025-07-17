<?php

require_once __DIR__ . '/../models/Usuario.php';

class HomeController {

    public static function login() {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $usuario = $_POST['username'] ?? null;
            $senha = $_POST['password'] ?? null;
            
            if(!is_null($usuario) && !is_null($senha)){
                if(Usuario::authenticate($usuario, $senha)){
                    echo "4";
                    header("Location: fornecedores");
                }
            }

        }
        
        require __DIR__ . '/../views/login.php';
    }

    public static function apagarUsuarioLogado() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: login');
        }
        
        Usuario::detelar($_SESSION['user_id']);
        HomeController::logout();

        header('Location: login');
        exit;
    }

    public static function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user']);
        session_destroy();
        
        header('Location: login');
        exit;
    }
    
}
?>