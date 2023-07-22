<?php 

include('../../MySql.php');
date_default_timezone_set('America/Sao_Paulo');
   $pedido = \MySql::conectar()->prepare(" INSERT INTO `tb_pedidos` (`id`, `cliente`, `produtos`, `data_entrega`, `data_pedido`,`retirada`,`forma_pagamento`) VALUES (NULL, ?, ?, ?, ?,?,?)");
   $pedido->execute(array($_POST['cliente'],json_encode($_POST['produtos']),$_POST['data_entrega'],$_POST['data_pedido'],$_POST['retirada'],$_POST['pagamento']));
   foreach ($_POST['produtos'] as $key => $value) {
    $produto = \MySql::conectar()->prepare("INSERT INTO `tb_vendas` (`id`, `colaborador`, `data`, `valor`, `caixa`,`produto`,`forma_pagamento`) VALUES (NULL, ?, ?, ?, ?,?,?); ");
    $produto->execute(array('luis',date("Y-m-d h:i:sa"),$value['preco']*$value['quantidade'],$_POST['caixa'],$value['id'],$_POST['pagamento']));
    $atualizar_caixa = \MySql::conectar()->prepare("UPDATE `tb_caixas` SET `valor_atual` = `valor_atual` + ? WHERE `tb_caixas`.`caixa` = ? ");
    $atualizar_caixa->execute(array($value['preco']*$value['quantidade'],$_POST['caixa']));

  }
?>