<?php 
include('../../MySql.php');
if(isset($_POST['codigo'])){
  $produto = \MySql::conectar()->prepare("SELECT * FROM `tb_produtos` WHERE `codigo` LIKE ?");
  $produto->execute(array($_POST['pesquisa'].'%'));
  $produto = $produto->fetchAll();
}else{
  $produto = \MySql::conectar()->prepare("SELECT * FROM `tb_produtos` WHERE `nome` LIKE ?");
  $produto->execute(array('%'.$_POST['pesquisa'].'%'));
  $produto = $produto->fetchAll();
}

  echo json_encode($produto);
?>