<?php 
include('../../MySql.php');


$row = \MySql::conectar()->prepare('SELECT * FROM `tb_vendas` WHERE date(`data`) BETWEEN ? AND ? ');
$row->execute(array($_POST['data_min'],$_POST['data_max']));
$row = $row->fetchAll();
foreach ($row as $key => $value) {
    echo $value['colaborador'];
}
// data = {
//     data_min: "2023-07-17",
//     data_max: "2023-07-19"
//   };
  
//   $.post("Models/post_receivers/select_relatorio_abc.php", data, function (ret) {
//   console.log(ret)
//   });
?>
