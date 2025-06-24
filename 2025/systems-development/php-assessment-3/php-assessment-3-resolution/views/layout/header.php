<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Sistema de Gerenciamento</title>
  <link rel="stylesheet" href="/prova-php/assets/style.css">
</head>

<body>
  <header style="border-radius: 8px">
    <a href="/prova-php/">
      <img src="/prova-php/assets/img/profile/prof-3.jpg" style="border-radius: 50%;" alt="Usuário" width="50">
    </a>
    <nav>
      <ul>
        <?php 
                if(isset($_SESSION['user_id'])){
                    echo '<li><a href="fornecedores">Fornecedores</a></li>';
                    echo '<li><a href="logout">Logout</a></li>';
                    echo '<li><a href="apagar-usuario">Deletar</a></li>';
                }else{
                    echo 'Fazer Login...';
                }
            ?>
      </ul>
    </nav>
  </header>
  <div class="container">