<script>
  $( function() {
    $( document ).tooltip();
  } );
  </script>
  <fundo></fundo>
  <form action="" class="modal modal_fechar_caixa">
    <h3>Fechamento <red>de Caixa:</red></h3>
    <div class="first_row">
        <div class="left_side">
            Data do Fechamento:
            <span><?php echo date('d/m/Y')?></span>
        </div>
        <div class="right_side">
            <div class="input_codigo_user_father">
            <label for="input_codigo_user">Código:</label>
            <input type="text" class="oders_inputs " name="input_codigo_user" id="input_codigo_user">
            </div>
            <div class="input_nome_user_father">
            <label for="input_nome_user">Nome do Funcionário:</label>
            <input type="text" class="oders_inputs tag_user" name="input_nome_user" id="input_nome_user">
            </div>
        </div>

    </div>
    <div class="valores_informados_box">
        <span class="valores_informados_title">Valores Informados:</span>
        <div class="body_valores">
            <div class="first_column">
          
                <div class="input_valores">
                    <label for="dinheiro_informadas">Dinheiro: </label>
                    <input onKeyUp="mascaraMoeda(this, event)"type="text" class="input_princip_completo oders_inputs"name="dinheiro_informadas" id="dinheiro_informadas">
                    <input  onKeyUp="mascaraMoeda(this, event)"type="text" class="quantidade quantidade_dinheiro oders_inputs">
                </div>
                <div class="input_valores">
                    <label for="pix_informadas">Pix: </label>
                    <input onKeyUp="mascaraMoeda(this, event)"type="text" class="input_princip_completo oders_inputs"name="pix_informadas" id="pix_informadas">
                    <input onKeyUp="mascaraMoeda(this, event)"type="text"  class="quantidade quantidade_pix oders_inputs">
                </div>
            </div>
            <div class="first_column">
                <span class="qtd">Qtd</span>
                <div class="input_valores">
                    <label for="moedas_informadas">Cartão: </label>
                    <input onKeyUp="mascaraMoeda(this, event)"type="text" class="input_princip_completo oders_inputs" name="moedas_informadas" id="moedas_informadas">
                    <input onKeyUp="mascaraMoeda(this, event)"type="text" class="quantidade quantidade_moedas oders_inputs">
                </div>
            
                <!-- <div class="input_valores">
                    <label for="pix_informadas">Vale-Ticket </label>
                    <input onKeyUp="mascaraMoeda(this, event)"type="text" class="input_princip oders_inputs"name="pix_informadas" id="pix_informadas">
                    <input onKeyUp="mascaraMoeda(this, event)"type="text"  class="quantidade quantidade_pix oders_inputs">
                </div> -->
                <div class="input_valores">
                    <label for="dinheiro_informadas">Pgto/Sangria: </label>
                    <input onKeyUp="mascaraMoeda(this, event)"type="text" class="input_princip_completo oders_inputs"name="dinheiro_informadas" id="dinheiro_informadas">
                </div>
            </div>
            <div class="second_column">

            </div>
        </div>
        <span class="valores_informados_footer">Valor Total: <red> R$00,00</red></span>
    </div>
    <div class="valores_informados_box">
        <span class="valores_informados_title">Valores Informados:</span>
        <div class="body_valores">
            <div class="first_column">
                <div class="input_valores">
                    <label for="moedas_informadas">Troco Inicial: </label>
                    <input  onKeyUp="mascaraMoeda(this, event)"type="text" class="input_princip_completo oders_inputs" name="moedas_informadas" id="moedas_informadas">
                </div>
                <div class="input_valores">
                    <label for="dinheiro_informadas">Troco de Vendas: </label>
                    <input onKeyUp="mascaraMoeda(this, event)"type="text" class="input_princip_completo oders_inputs"name="dinheiro_informadas" id="dinheiro_informadas">
                </div>
                <div class="input_valores">
                    <label for="pix_informadas">Troco Final: </label>
                    <input onKeyUp="mascaraMoeda(this, event)"type="text" class="input_princip_completo oders_inputs"name="pix_informadas" id="pix_informadas">
                </div>
            </div>
            <div class="first_column">
                <div class="input_valores">
                    <label for="moedas_informadas">Troco Apurado: </label>
                    <input onKeyUp="mascaraMoeda(this, event)"type="text" class="input_princip_completo oders_inputs" name="moedas_informadas" id="moedas_informadas">
                </div>
                <div class="input_valores">
                    <label for="dinheiro_informadas">Troco Informado: </label>
                    <input onKeyUp="mascaraMoeda(this, event)"type="text" class="input_princip_completo oders_inputs"name="dinheiro_informadas" id="dinheiro_informadas">
                </div>
                <div class="input_valores">
                    <label for="pix_informadas">Diferença: </label>
                    <input onKeyUp="mascaraMoeda(this, event)"type="text" class="input_princip_completo oders_inputs"name="pix_informadas" id="pix_informadas">
                </div>
            </div>
            <div class="second_column">

            </div>
        </div>
        <span class="valores_informados_footer">Valor Total: <red> R$00,00</red> </span>
    </div>
    <!-- <div class="valores_apurados_box">
        <span class="valores_apurados_title">Valores Informados:</span>
        <span class="valores_apurados_footer">Valor Total: <red> R$00,00</red></span>
    </div> -->
  </form>
<div class="header_section">
    <div class="left_side">
        <section style="width: 40%;">
        Selecione o Período:
        <div class="inputs_header_section">
            <input type="date" class="datas" name="data_minima" value="<?php echo  date('Y-m-d')?>" max="<?php echo  date('Y-m-d')?>"id="data_minima">
            <input type="date" class="datas"value="<?php echo  date('Y-m-d')?>"name="data_maxima"  max="<?php echo  date('Y-m-d')?>"id="data_maxima">

        </div>
        </section>
      
    </div>
    <div class="right_side">
        <div class="right_subdivision">
           <h3>Algumas Métricas:</h3> 
           <span>Tipo de Pagamento mais recorrente:</span>
           <red class="pagamento_recorrente"><?php \Models\PainelControleModel::buscarDados('formaPagamentoMaisRepetida')?></red>
           <span>Quantidade de Vendas no período::</span>
           <red class="quant_vendas"><?php \Models\PainelControleModel::buscarDados('quantidadeVendas')?> Vendas</red>
           <span>Produto Mais vendido no período::</span>
           <red class="top_produto"><?php \Models\PainelControleModel::buscarDados('produtoMaisVendido')?></red>
        </div>
        <div class="left_subdivision">
            <h3>Realizar Fechamento do caixa</h3>
            <span>Do dia <?php echo date('d/m/Y')?></span>
            <button onclick="abrirModal('modal_fechar_caixa')"><i class="fa-solid fa-cart-shopping"></i> Fechar Caixa</button>
            <div class="selection_switch">
                <span>Vendas Feitas</span>
                <switch><dot style="float: left;"></dot></switch>
                <span>Produtos Vendidos</span>
            </div>
        </div>
    </div>

</div>
<div class="tabela_father">
    <div class="tabela_header">

    <i id="voltar_semana" class="fa-solid fa-angle-left modificadores_tempo "></i> <span>Vendas no dia: <yellow> <?php echo date('d/m/Y') ?></yellow> <i onclick='gerarPDFFullFunction(this)' class="gerar_pdf fa-regular fa-file-pdf"></i></span><i id='adiantar_semana' class="fa-solid fa-angle-right modificadores_tempo adiantar_semana"></i>
    </div>
    <table id="table_tabela">
        <thead>
            <tr>
                <th>Data Venda</th>
                <th>Valor Total</th>
                <th>Produtos na Venda</th>
                <th>Método de Pagamento</th>
            </tr>
        </thead>
        <tbody>
                <?php \Models\PainelControleModel::formarTabela()?>
            
        </tbody>
    </table>
</div>

<script src="<?php echo INCLUDE_PATH?>js/criar_pdf_tabela.js"></script>
<script src="<?php echo INCLUDE_PATH?>js/index.js"></script>

<script src="<?php echo INCLUDE_PATH?>js/posts_senders.js"></script>