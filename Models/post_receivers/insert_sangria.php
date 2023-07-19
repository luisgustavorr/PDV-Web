<?php 
include('../../MySql.php');
date_default_timezone_set('America/Sao_Paulo');
  $sangria = \MySql::conectar()->prepare("INSERT INTO `tb_sangrias` (`id`, `colaborador`, `caixa`, `mensagem`, `valor`, `data`) VALUES (NULL,?,?,?,?,?)");
  $sangria->execute(array('luis',$_POST['caixa'],$_POST['mensagem'],$_POST['valor_sangria'],date("Y-m-d h:i:sa")));
  
  $atualizar_caixa = \MySql::conectar()->prepare("UPDATE `tb_caixas` SET `valor_atual` = ? WHERE `tb_caixas`.`caixa` = ? ");
  $atualizar_caixa->execute(array($_POST['valor'],$_POST['caixa']));

  $atualizar_vendas = \MySql::conectar()->prepare("UPDATE `tb_vendas` SET `out_caixa` = '1' WHERE `caixa` = ? ");
  $atualizar_vendas->execute(array($_POST['caixa']));

  $produto = \MySql::conectar()->prepare("SELECT valor_atual FROM `tb_caixas` WHERE `caixa` = ?");
  $produto->execute(array($_POST['caixa']));
  $produto = $produto->fetch();

?>