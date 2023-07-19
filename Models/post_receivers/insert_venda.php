<?php 
include('../../MySql.php');
date_default_timezone_set('America/Sao_Paulo');

foreach ($_POST['produtos'] as $key => $value) {
  $produto = \MySql::conectar()->prepare("INSERT INTO `tb_vendas` (`id`, `colaborador`, `data`, `valor`, `caixa`,`produto`) VALUES (NULL, ?, ?, ?, ?,?); ");
  $produto->execute(array('luis',date("Y-m-d h:i:sa"),$value['preco']*$value['quantidade'],$_POST['caixa'],$value['id']));
  $atualizar_caixa = \MySql::conectar()->prepare("UPDATE `tb_caixas` SET `valor_atual` = `valor_atual` + ? WHERE `tb_caixas`.`caixa` = ? ");
  $atualizar_caixa->execute(array($_POST['valor'],$_POST['caixa']));
  $atualizar_caixa = \MySql::conectar()->prepare("UPDATE `tb_produtos` SET `estoque` = `estoque`-? WHERE `tb_produtos`.`id` = ?");
  $atualizar_caixa->execute(array($value['quantidade'],$value['id']));
}
?>