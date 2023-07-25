<?php 
require ('../../MySql.php');
$infos = \MySql::conectar()->prepare("SELECT tb_caixas.*, SUM(tb_vendas.valor) AS total_valor FROM tb_caixas INNER JOIN tb_vendas ON tb_caixas.caixa = tb_vendas.caixa WHERE tb_caixas.caixa = ? AND tb_vendas.colaborador = ? GROUP BY tb_caixas.id; ");
$infos->execute(array($_POST['caixa'],$_POST['colaborador']));
$infos = $infos->fetch();
print_r(json_encode($infos))
?>