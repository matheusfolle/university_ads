<?php

// Não mudar nada aqui, tudo deve funcinar normalmente
/// ---------------------------------------------------------------

// Mini gerenciador de rotas usando match
// Captura a rota amigável (ex.: 'login', 'fornecedores/edit/5')
$url = $_GET['url'] ?? null;
$url = explode("/", $url);
// print_r($url);
// echo "<hr>";

$pagina =  $url[0];

if (isset($url[1])) {
    $pagina = "{$url[0]}/$url[1]";
}

/// ---------------------------------------------------------------

if(!isset($_SESSION)) {
    session_start();
}

// Inclui controllers
require __DIR__ . '/controllers/HomeController.php';
require __DIR__ . '/controllers/FornecedorController.php';
require __DIR__ . '/controllers/ServicoController.php';

match ($pagina) {
    'login'                     => HomeController::login(),
    'logout'                    => HomeController::logout(),
    'apagar-usuario'            => HomeController::apagarUsuarioLogado(),
        
    'fornecedores'              => FornecedorController::index(),
    'fornecedores/novo'         => FornecedorController::novo(),
    'fornecedores/criar'        => FornecedorController::criarFornecedor(),
    'fornecedores/editar'       => FornecedorController::editarFornecedor($url[2]),
    'fornecedores/atualizar'    => FornecedorController::atualizarFornecedor(),
    'fornecedores/apagar'       => FornecedorController::apagar($url[2]),

    'servicos/ver'              => ServicoController::verServicos($url[2]),

    default                     => FornecedorController::index(),
};

exit;
