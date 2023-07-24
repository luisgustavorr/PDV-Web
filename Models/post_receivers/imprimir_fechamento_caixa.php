<?php 
require __DIR__ . '/../../vendor/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

// Conecta à impressora (substitua "printer_device" pelo caminho ou nome da porta da impressora)
$connector = new WindowsPrintConnector(dest:"TM-T20X");

$printer = new Printer($connector);
// Configura o modo de impressão (tamanho da fonte, negrito, etc.)
$printer->setEmphasis(true); // Ativa o modo de enfatizar (negrito)

// Escreve o cabeçalho do fechamento de caixa
$printer->text("FECHAMENTO DE CAIXA\n");
$printer->setEmphasis(false); // Desativa o modo de enfatizar (negrito)
$printer->text("Data: " . date("d/m/Y H:i:s") . "\n"); // Adicione a data e hora do fechamento
$funcionario = 'Luís Gustavo R. Rezende';
$printer->text("Funcionário: " . $funcionario  . "\n"); // Adicione a data e hora do fechamento

// Valores apurados pelo sistema
$valorDinheiroSistema = 1000.00;
$valorCartaoSistema = 800.00;
$valorPixSistema = 500.00;

// Valores informados pelo funcionário
$valorDinheiroFuncionario = 980.00;
$valorCartaoFuncionario = 820.00;
$valorPixFuncionario = 510.00;

// Escreve os valores informados pelo funcionário
$printer->setEmphasis(true); // Ativa o modo de enfatizar (negrito)
$printer->text("Valores Informados\n");
$printer->setEmphasis(false); // Desativa o modo de enfatizar (negrito)
$printer->text("Dinheiro: R$" . number_format($valorDinheiroFuncionario, 2, ',', '.') . "\n");
$printer->text("Cartão: R$" . number_format($valorCartaoFuncionario, 2, ',', '.') . "\n");
$printer->text("Pix: R$" . number_format($valorPixFuncionario, 2, ',', '.') . "\n");


// Escreve os valores apurados pelo sistema
$printer->setEmphasis(true); // Ativa o modo de enfatizar (negrito)
$printer->text("Valores Apurados\n");
$printer->setEmphasis(false); // Desativa o modo de enfatizar (negrito)
$printer->text("Dinheiro: R$" . number_format($valorDinheiroSistema, 2, ',', '.') . "\n");
$printer->text("Cartão: R$" . number_format($valorCartaoSistema, 2, ',', '.') . "\n");
$printer->text("Pix: R$" . number_format($valorPixSistema, 2, ',', '.') . "\n");


// Calcula as diferenças entre os valores apurados e os informados
$diferencaDinheiro = $valorDinheiroFuncionario - $valorDinheiroSistema ;
$diferencaCartao =  $valorCartaoFuncionario - $valorCartaoSistema;
$diferencaPix =  $valorPixFuncionario - $valorPixSistema ;

// Escreve as diferenças
$printer->setEmphasis(true); // Ativa o modo de enfatizar (negrito)
$printer->text("Diferenças\n");
$printer->setEmphasis(false); // Desativa o modo de enfatizar (negrito)
if($diferencaDinheiro < 0)$printer->setEmphasis(true); // Ativa o modo de enfatizar (negrito)
$printer->text("Dinheiro: R$" . number_format($diferencaDinheiro, 2, ',', '.') . "\n");
if($diferencaDinheiro < 0)$printer->setEmphasis(false); // Ativa o modo de enfatizar (negrito)

if($diferencaCartao < 0)$printer->setEmphasis(true); // Ativa o modo de enfatizar (negrito)
$printer->text("Cartão: R$" . number_format($diferencaCartao, 2, ',', '.') . "\n");
if($diferencaCartao < 0)$printer->setEmphasis(false); // Ativa o modo de enfatizar (negrito)

if($diferencaPix < 0)$printer->setEmphasis(true); // Ativa o modo de enfatizar (negrito)
$printer->text("Pix: R$" . number_format($diferencaPix, 2, ',', '.') . "\n");
if($diferencaPix < 0)$printer->setEmphasis(false); // Ativa o modo de enfatizar (negrito)

// Escreve o campo de assinatura
$printer->text("\nAssinatura _______________________\n");

// Finaliza a impressão e fecha a conexão
$printer->cut();
$printer->close();
?>