<?php
require_once __DIR__ . '/../config/banco.php';

class Servico {

    public static function buscarServicos() {
        $banco = Banco::getConn();
        $res = $banco->query("SELECT * FROM servicos");

        $servicos = [];
        while ($t = $res->fetch_object()) {
            $servicos[] = $t;
        }        
        
        return $servicos;
    }

    public static function buscarServicosDeUmFornecedor($idFornecedor) {
        $banco = Banco::getConn();
        $res = $banco->query("SELECT * FROM servicos WHERE fornecedor_id='$idFornecedor'");

        $servicos = [];
        while ($t = $res->fetch_object()) {
            $servicos[] = $t;
        }
        return $servicos;
    }
    
}
?>