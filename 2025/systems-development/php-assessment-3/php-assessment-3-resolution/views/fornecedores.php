<?php
require __DIR__ . '/layout/header.php';
require __DIR__ . '/layout/cards.php';
?>

<h2>Fornecedores</h2>

<a href="fornecedores/novo" class="btn btn-primary">Novo Fornecedor</a>
<br><br>

<div class="cards-container">

  <?php
    foreach ($fornecedores as $i => $f) {
      cardFornecedor($f->id, $f->nome_empresa, $f->email_principal, $f->telefone_principal, $f->endereco, "img-{$f->id}.jpg");
    }
  ?>

</div>


<?php require __DIR__ . '/layout/footer.php'; ?>