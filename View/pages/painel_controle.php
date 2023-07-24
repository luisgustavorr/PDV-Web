<script>
  $( function() {
    $( document ).tooltip();
  } );
  </script>
  <form class="modal modal_adicionar_produto">
  <div class="first_input_row">
    <div class="inputs input_codigo_produto_add">
      <label for="">Código do Produto:</label><br />
      <input type="text" placeholder="Digite ou leia o Código de barras do Produto" name="codigo_produto_add" id="codigo_produto_add" required>
    </div>
    <div class="inputs input_nome_produto_add">
      <label for="">Nome do Produto:</label><br />
      <input type="text" placeholder="Digite o nome do Produto" name="nome_produto_add" id="nome_produto_add" required>
    </div>
  </div>
  <div class="second_input_row">
    <div class="inputs input_preco_produto_add">
      <label for="">Preço do Produto:</label><br />
      <input type="text" placeholder="Digite o preço do Produto" name="preco_produto_add" id="preco_produto_add" required>
    </div>
    <div class="inputs input_estoque_produto_add">
      <label for="">Estoque do Produto:</label><br />
      <input type="text" placeholder="Estoque do Produto" name="estoque_produto_add" id="estoque_produto_add" required>
    </div>
    <div class="inputs input_por_peso">
      <label for="">É por peso?</label><br />
      <div class="inputs_radio_father">
      <label for="sim">Sim</label>
      <input type="radio" name="entrega_retirada" required value="1" id="sim">
      <label for="nao">Não</label>
      <input type="radio" name="entrega_retirada" value="0" id="nao">
      </div>

    </div>
    <button id="finalziar_button_add">Finalizar</button>
  </div>
</form>
  <aside id="sidebar">
  <span class="princip_span" onclick="abrirModal('modal_adicionar_funcionario')">Adicionar Funcionário <i class="fa-solid fa-user-plus"></i></span>
  <span class="princip_span" onclick="abrirModal('modal_adicionar_produto')">Adicionar Produto <i class="fa-solid fa-plus"></i></span>

  <span class="princip_span" id="add_caixa_opener">Adicionar Caixa <i class="fa-solid fa-angle-down"></i></span>

  <form action="" id="adicionar_caixa">
    <span class="princip_span">Nome</span><br><input id="nome_caixa"placeholder="Digite o nome desse caixa" type="text" required><br>
    <span class="princip_span">Troco Inicial</span><br><input onKeyUp="mascaraMoeda(this, event)"id="troco_inicial"placeholder="Digite o troco inicial desse caixa" type="text" required><br>
    <button>Adicionar</button>
  </form>


  <span class="princip_span" >Caixa(s) Selecionado(s) : <select name="select_caixa" id="select_caixa">
    <option value="todos">Todos</option>
    <?php 
    $caixas = \MySql::conectar()->prepare("SELECT * FROM `tb_caixas`");
    $caixas->execute();
    $caixas = $caixas->fetchAll();
    foreach ($caixas as $key => $value) {
      echo '<option value="'.$value['caixa'].'">'.ucfirst($value['caixa']).'</option>';
    }
    ?>
  </select></span>

<form id="form_equip">

    <span class="princip_span">Equipamentos do caixa <red>:</red></span>
    <span class="princip_span">Nome Impressora</span>
    <input type="text"  id="nome_impressora">
    <span class="princip_span">Porta serial da balança</span>
    <input type="text"  id="porta_balanca">
    <span class="princip_span">Frequencia da balança</span>
    <input type="text"  id="freq_balanca">
    <button>Salvar</button>
</form>
<span  id="caixa_remover"><red>Remover Caixa <red></span >
</aside>
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

    <i id="voltar_semana" onclick="mudarTempo(this)" class="fa-solid fa-angle-left modificadores_tempo "></i> <span>Vendas no dia: <yellow> <?php echo date('d/m/Y') ?></yellow> <i onclick='gerarPDFFullFunction(this)' class="gerar_pdf fa-regular fa-file-pdf"></i></span><i onclick="mudarTempo(this)" id='adiantar_semana' class="fa-solid fa-angle-right modificadores_tempo adiantar_semana"></i>
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