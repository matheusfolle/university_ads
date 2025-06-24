<?php 
  require __DIR__ . '/layout/header.php'; 
  require __DIR__ . '/layout/cards.php';
?>

<h2>Serviços</h2>

<div class="cards-container">
  <?php 
    foreach ($servicos as $servico) {
        cardServicos($servico->id, $servico->titulo, 1, $servico->preco);
    }
    // cardServicos($idServico, $titulo, $idFornecedor, $preco)    
  ?>
</div>

<?php require __DIR__ . '/layout/footer.php'; ?>