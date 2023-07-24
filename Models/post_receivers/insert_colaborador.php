<?php 
include('../../MySql.php');
    if($_POST['adm']){
        $apagar_anterior = \MySql::conectar()->prepare("INSERT INTO `tb_administradores` (`id`, `nome`, `senha`,`user`) VALUES (NULL, ?, ?,?);");
        $apagar_anterior->execute(array($_POST['nome'],$_POST['senha']),$_POST['user']);
    }else{
        $apagar_anterior = \MySql::conectar()->prepare("INSERT INTO `tb_colaboradores` (`id`, `nome`, `codigo`) VALUES (NULL, ?, ?);");
        $apagar_anterior->execute(array($_POST['nome'],$_POST['codigo']));
    }
  
    ?>