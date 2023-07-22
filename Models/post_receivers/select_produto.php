<?php 
include('../../MySql.php');

  $produto = \MySql::conectar()->prepare("SELECT * FROM `tb_produtos` WHERE `codigo` = ?");
  $produto->execute(array($_POST['barcode']));
  $produto = $produto->fetch();
  echo json_encode($produto,JSON_UNESCAPED_UNICODE);
?>