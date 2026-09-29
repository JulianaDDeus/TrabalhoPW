<?php 
  require_once "functions.php"; 

  if (isset($_GET['id'])){
    delete($_GET['id']);
  } else {
    $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
    $_SESSION['type'] = 'danger';
  }
?>