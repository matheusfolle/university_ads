<?php
require_once __DIR__ . '/../config/banco.php';

class Fornecedor {

    public static function encontrarFornecedores()  {
        $banco = Banco::getConn();
        $res = $banco->query("SELECT * FROM fornecedores");
                
        $fornecedores = [];
        while ($t = $res->fetch_object()) {
            $fornecedores[] = $t;
        }

        return $fornecedores;
    }
    
    public static function encontrarFornecedorporID($idFornecedor)  {
        $banco = Banco::getConn();
        $res = $banco->query("SELECT * FROM fornecedores WHERE id='$idFornecedor'");
        
        return $res->fetch_object();
    }
    
    public static function criarFornecedor($nome, $email, $tel, $end) {
        $banco = Banco::getConn();
        $sql = "INSERT INTO fornecedores (nome_empresa, telefone_principal, email_principal, endereco) VALUES ('$nome','$tel','$email','$end')";
        return $banco->query($sql);
    }


    public static function atualizarFornecedor($id, $nome, $email, $tel, $end)  {
        $banco = Banco::getConn();
        $res = $banco->query("UPDATE fornecedores SET nome_empresa='$nome', telefone_principal='$tel', email_principal='$email', endereco='$end' WHERE id='$id'");
        echo "a";
    }
    

    public static function apagarFornecedor($idFornecedor) {
        $banco = Banco::getConn();
        return $banco->query("DELETE FROM fornecedores WHERE id='$idFornecedor'");
    }
    
}
