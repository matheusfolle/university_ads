<?php
require_once __DIR__ . '/../models/Fornecedor.php';

class FornecedorController {
    

    public static function index() {

        if (!isset($_SESSION['user_id'])) {
            header('Location: login');
        }

        $fornecedores = Fornecedor::encontrarFornecedores();

        require __DIR__ . '/../views/fornecedores.php';
    }

    
    public static function novo() {

        if (!isset($_SESSION['user_id'])) {
            header('Location: login');
        }
        
        require __DIR__ . '/../views/fornecedores-criar.php';
    }


    public static function criarFornecedor() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: login');
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $nome_empresa = $_POST['nome_empresa'] ?? null;
            $telefone_principal = $_POST['telefone_principal'] ?? null;
            $email_principal = $_POST['email_principal'] ?? null;
            $endereco = $_POST['endereco'] ?? null;

            if(!is_null($nome_empresa) && !is_null($telefone_principal) && !is_null($email_principal) && !is_null($endereco)) {
                Fornecedor::criarFornecedor($nome_empresa, $telefone_principal, $email_principal, $endereco);
            }
            
        } 


        header("Location: ../fornecedores");
    }

    public static function editarFornecedor($idFornecedor) {

        if (!isset($_SESSION['user_id'])) {
            header('Location: login');
        }

        $fornecedor = Fornecedor::encontrarFornecedorPorId($idFornecedor);
        $f['id'] = $fornecedor->id;
        $f['nome_empresa'] = $fornecedor->nome_empresa;
        $f['telefone_principal'] = $fornecedor->telefone_principal;
        $f['email_principal'] = $fornecedor->email_principal;
        $f['endereco'] = $fornecedor->endereco;

        require __DIR__ . '/../views/fornecedores-editar.php';
    }

    public static function atualizarFornecedor() {

        if (!isset($_SESSION['user_id'])) {
            header('Location: login');
        }
        
        if($_SERVER['REQUEST_METHOD'] === "POST") {

            $idFornecedor = $_POST['id'] ?? null;
            $nome_empresa = $_POST['nome_empresa'] ?? null;
            $telefone_principal = $_POST['telefone_principal'] ?? null;
            $email_principal = $_POST['email_principal'] ?? null;
            $endereco = $_POST['endereco'] ?? null;
            
            if(!is_null($idFornecedor) && !is_null($nome_empresa) && !is_null($telefone_principal) && !is_null($email_principal) && !is_null($endereco)) {
                Fornecedor::atualizarFornecedor($idFornecedor, $nome_empresa, $email_principal, $telefone_principal, $endereco);
            }

        }

        header('Location: ../fornecedores');
    }
    
    public static function apagar($idFornecedor) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: login');
        }

        Fornecedor::apagarFornecedor($idFornecedor);

        header('Location: ../../fornecedores');
    }

}
