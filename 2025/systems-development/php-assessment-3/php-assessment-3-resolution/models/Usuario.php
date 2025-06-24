<?php
require_once __DIR__ . '/../config/banco.php';

class Usuario {
    
    // Autentica usuário - Login
    public static function authenticate($username, $password) {
        $banco = Banco::getConn();
        $sql = "SELECT * FROM usuarios WHERE nome_usuario='$username' LIMIT 1";
        $resp = $banco->query($sql);

        if($resp->num_rows <= 0){
            return false;
        }else{
            
            $obj_usuario_resposta = $resp->fetch_object();
            
            if(password_verify($password, $obj_usuario_resposta->senha)){
                $_SESSION['user_id'] = $obj_usuario_resposta->id;
                $_SESSION['user'] = $obj_usuario_resposta->nome_usuario;
                return true;
            }else{
                return false;
            }

        }
        
    }
    
    public static function detelar($idUsuario) {
        $banco = Banco::getConn();
        $sql = "DELETE FROM usuarios WHERE id='$idUsuario'";
        $banco->query($sql);
    }
        
}
?>