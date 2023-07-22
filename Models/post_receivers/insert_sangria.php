<?php 
include('../../MySql.php');
date_default_timezone_set('America/Sao_Paulo');
$let =$_POST['path'].'vendor\\autoload.php';
require_once $let;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
$user = \MySql::conectar()->prepare("SELECT * FROM `tb_colaboradores`  WHERE `codigo` = ?");
$user->execute(array($_POST['colaborador']));
$user = $user->fetch();
print_r(empty($user));
if(!empty($user)){

  try{
    $connector = new WindowsPrintConnector("TM-T20X");
    $printer = new Printer($connector);
    $printer -> text("Hello World! \\n");
    $printer -> text('\\n');
    $printer -> cut();
    $printer ->close();
    $sangria = \MySql::conectar()->prepare("INSERT INTO `tb_sangrias` (`id`, `colaborador`, `caixa`, `mensagem`, `valor`, `data`) VALUES (NULL,?,?,?,?,?)");
    $sangria->execute(array($_POST['colaborador'],$_POST['caixa'],$_POST['mensagem'],$_POST['valor_sangria'],date("Y-m-d h:i:sa")));
    

  
  
    $produto = \MySql::conectar()->prepare("SELECT valor_atual FROM `tb_caixas` WHERE `caixa` = ?");
    $produto->execute(array($_POST['caixa']));
    $produto = $produto->fetch();
}catch(Exception $e){   
    echo 'Falha ao imprimir: '.$e->getMessage();

}
}


?>