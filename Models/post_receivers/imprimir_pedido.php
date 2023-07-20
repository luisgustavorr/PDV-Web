<?php 
$let =$_POST['path'].'vendor\autoload.php';
require_once $let;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
try{
    $connector = new WindowsPrintConnector("TM-T20X");
    $printer = new Printer($connector);
    $printer -> text("Hello World! \\n");
    $printer -> text('\\n');
    $printer -> cut();
    $printer ->close();
}catch(Exception $e){   
    echo 'Falha ao imprimir: '.$e->getMessage();

}
// data = {
//     path: "C:\\NewerXampp\\htdocs\\MixSalgados\\Caixa\\",
//   };
  
//   $.post("Models/post_receivers/imprimir_pedido.php", data, function(ret) {
//     console.log(ret)
//   });
?>
