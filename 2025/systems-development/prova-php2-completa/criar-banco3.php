<?php
// create_database.php
// Script para criar o banco de dados 'banco-prova' em localhost e criar tabelas com dados de exemplo

$host     = 'localhost:3306';
$user     = 'root';
$password = '';
$dbName   = 'banco-prova';

// Conexão inicial sem especificar banco
$conn = new mysqli($host, $user, $password);
if ($conn->connect_error) {
    die('Falha na conexão: ' . $conn->connect_error);
}

echo "Conectado ao MySQL com sucesso.<br>";

// Cria o banco de dados, se ainda não existir
$sql = "CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if ($conn->query($sql) === TRUE) {
    echo "Banco de dados '$dbName' criado (ou já existente).<br>";
} else {
    echo "Erro ao criar o banco de dados: " . $conn->error . "<br>";
}

// Seleciona o banco de dados
$conn->select_db($dbName);
$conn->set_charset('utf8mb4');

echo "Selecionado o banco de dados '$dbName'.<br>";

// SQL para criação de tabelas
$tables = [
    'usuarios' => "
        CREATE TABLE IF NOT EXISTS usuarios (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome_usuario VARCHAR(50) NOT NULL UNIQUE,
            senha VARCHAR(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    'fornecedores' => "
        CREATE TABLE IF NOT EXISTS fornecedores (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome_empresa VARCHAR(100) NOT NULL,
            telefone_principal VARCHAR(20),
            email_principal VARCHAR(100),
            endereco VARCHAR(255)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    'servicos' => "
        CREATE TABLE IF NOT EXISTS servicos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            fornecedor_id INT NOT NULL,
            titulo VARCHAR(100) NOT NULL,
            preco DECIMAL(10,2) NOT NULL,
            FOREIGN KEY (fornecedor_id) REFERENCES fornecedores(id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
];

// Cria cada tabela
foreach ($tables as $name => $ddl) {
    if ($conn->query($ddl) === TRUE) {
        echo "Tabela '$name' criada com sucesso.<br>";
    } else {
        echo "Erro ao criar tabela '$name': " . $conn->error . "<br>";
    }
}

// Insere dados de exemplo
// Usuários
$hashAdmin = password_hash('admin123', PASSWORD_DEFAULT);
$hashUsuario = password_hash('usuario123', PASSWORD_DEFAULT);

$exampleInserts = [
    // Usuários
    "INSERT IGNORE INTO usuarios (nome_usuario, senha) VALUES ('admin', '$hashAdmin')",
    "INSERT IGNORE INTO usuarios (nome_usuario, senha) VALUES ('usuario1', '$hashUsuario')",

    // Fornecedores (10 exemplos)
    "INSERT IGNORE INTO fornecedores (nome_empresa, telefone_principal, email_principal, endereco) VALUES ('ACME Ltda', '11-1234-5678', 'contato@acme.com', 'Rua A, 123')",
    "INSERT IGNORE INTO fornecedores (nome_empresa, telefone_principal, email_principal, endereco) VALUES ('Beta Serviços', '21-8765-4321', 'suporte@beta.com', 'Av. B, 456')",
    "INSERT IGNORE INTO fornecedores (nome_empresa, telefone_principal, email_principal, endereco) VALUES ('Conecta Tecnologia', '31-3456-7890', 'tech@conecta.com', 'Rua das Flores, 50')",
    "INSERT IGNORE INTO fornecedores (nome_empresa, telefone_principal, email_principal, endereco) VALUES ('Ótimo Logística', '41-2222-3333', 'log@otimo.com', 'Av. Central, 789')",
    "INSERT IGNORE INTO fornecedores (nome_empresa, telefone_principal, email_principal, endereco) VALUES ('Soluções TI', '51-9999-8888', 'info@solucoesti.com', 'Rua dos Andradas, 150')",
    "INSERT IGNORE INTO fornecedores (nome_empresa, telefone_principal, email_principal, endereco) VALUES ('ConstruPlus', '61-4002-5000', 'contato@construplus.com', 'Av. Brasil, 1000')",
    "INSERT IGNORE INTO fornecedores (nome_empresa, telefone_principal, email_principal, endereco) VALUES ('Limpeza & Cia', '71-8888-7777', 'serv@limpezacia.com', 'Rua do Comércio, 200')",
    "INSERT IGNORE INTO fornecedores (nome_empresa, telefone_principal, email_principal, endereco) VALUES ('Doutor Carro', '81-7777-6666', 'auto@doutorcarro.com', 'Av. 7 de Setembro, 321')",
    "INSERT IGNORE INTO fornecedores (nome_empresa, telefone_principal, email_principal, endereco) VALUES ('Clínica Vida', '91-5555-4444', 'contato@clinicavida.com', 'Rua da Saúde, 45')",
    "INSERT IGNORE INTO fornecedores (nome_empresa, telefone_principal, email_principal, endereco) VALUES ('Jardinagem e Cia', '11-1111-2222', 'garden@jardinagemcia.com', 'Praça das Rosas, 77')",

    // Serviços (10 exemplos)
    "INSERT IGNORE INTO servicos (fornecedor_id, titulo, preco) VALUES (1, 'Instalação Elétrica Residencial', 250.00)",
    "INSERT IGNORE INTO servicos (fornecedor_id, titulo, preco) VALUES (1, 'Manutenção Elétrica Comercial', 450.00)",
    "INSERT IGNORE INTO servicos (fornecedor_id, titulo, preco) VALUES (2, 'Manutenção de Computadores', 150.00)",
    "INSERT IGNORE INTO servicos (fornecedor_id, titulo, preco) VALUES (2, 'Formatação de HD', 120.00)",
    "INSERT IGNORE INTO servicos (fornecedor_id, titulo, preco) VALUES (3, 'Suporte em Rede', 200.00)",
    "INSERT IGNORE INTO servicos (fornecedor_id, titulo, preco) VALUES (4, 'Frete Carga Leve', 300.00)",
    "INSERT IGNORE INTO servicos (fornecedor_id, titulo, preco) VALUES (5, 'Instalação de Software', 100.00)",
    "INSERT IGNORE INTO servicos (fornecedor_id, titulo, preco) VALUES (6, 'Construção de Muro', 800.00)",
    "INSERT IGNORE INTO servicos (fornecedor_id, titulo, preco) VALUES (7, 'Limpeza Pós-Obra', 400.00)",
    "INSERT IGNORE INTO servicos (fornecedor_id, titulo, preco) VALUES (8, 'Troca de Óleo Automotivo', 120.00)"
];

// Executa as inserções
foreach ($exampleInserts as $sql) {
    if ($conn->query($sql) === TRUE) {
        echo "Inserção executada: $sql<br>";
    } else {
        echo "Erro na inserção: " . $conn->error . "<br>";
    }
}

$conn->close();

echo "<br>Script finalizado.";
?>
