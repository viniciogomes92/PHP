<?php 

  if (isset($_SESSION['mensagem']) || isset($_SESSION['mensagem_type'])) :
?>

<div class="alert alert-<?= $_SESSION['mensagem_type'] ?> alert-dismissible fade show mt-4" role="alert">
  <?= $_SESSION['mensagem']; ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php 
  unset($_SESSION['mensagem']);
  unset($_SESSION['mensagem_type']);
  endif;
?>