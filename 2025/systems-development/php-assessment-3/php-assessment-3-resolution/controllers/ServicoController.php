<?php
require_once __DIR__ . '/../models/Servico.php';
require_once __DIR__ . '/../models/Fornecedor.php';

class ServicoController {

    public static function verServicos($idFornecedor) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: login');
        }

        $servicos = Servico::buscarServicosDeUmFornecedor($idFornecedor);

        require __DIR__ . '/../views/servicos.php';
    }
        
}