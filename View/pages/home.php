<fundo>

</fundo>
<?php 
  if(!isset($_COOKIE['caixa'])){
    echo '<red>INSIRA UM CAIXA VÁLIDO NO ICONE "<i class="fa-solid fa-bars"></i>"</red>';
  }
?>
<aside id="notification" >
<i class="fa-solid fa-xmark"></i>
  <section class="lista_pedido">
    
  </section>
</aside>
<input type="hidden" id="include_path" value="<?php echo BASE_DIR_PAINEL.'\\'?>" disabled>
<aside id="sidebar">
  <span class="princip_span"> Caixa Selecionado</span>
  <input value="<?php 
  if(isset($_COOKIE['caixa'])){
    echo $_COOKIE['caixa'];
  }
  ?>" type="text" id="caixa_selecionado" style="height: 30px; text-align:center;"><button id="salvar_caixa">Salvar</button>
  <span class="princip_span" onclick="abrirModal('modal_anotar_pedido')">Anotar Pedido</span>

  <span class="princip_span"id="abrir_lista_pedidos">Pedidos</span>
  <div class="lista_pedidos">
    <?php
    $pedidos = \MySql::conectar()->prepare("SELECT * FROM `tb_pedidos` WHERE `caixa` = ? AND `entregue` = 0");
    $pedidos->execute(array('principal'));
    $pedidos = $pedidos->fetchAll();
    foreach ($pedidos as $key => $value) {
      $timestamp = strtotime($value['data_pedido']); // Converte a string para um timestamp Unix
$data_formatada = date('d/m/Y', $timestamp);
      echo "
       <span  pedido='".json_encode($value)."'> <input class='pedido_feito' type='checkbox' pedido='".$value['id']."'><label onclick='editarPedido(this)'> ".$value['cliente']."-".$data_formatada."</label></span>
      ";
    }
    ?>
  </div>

</aside>
<form class="modal modal_anotar_pedido">
    <input type="hidden" id="editando" value="false" disabled>
    <input type="hidden" id="pedido_id" value="false" disabled>

  <div class="first_row">
    <div class="colaborador_father input_father">
      <div class="subdivision">

      <span>Nome do cliente:</span>
      <input required type="text" name="nome_cliente" class="oders_inputs" id="nome_cliente_input" placeholder="Insira o nome do cliente">
      </div>
      <div class="subdivision">

      <span>Seu código:</span>
      <input required type="text" name="codigo_colaborador" class="oders_inputs" id="codigo_colaborador_input" placeholder="Insira o seu código">
      </div>

    </div>
    <div class="endereco_cliente_father">
      <div class="input_endereco_cliente">
      <span>Endereço do cliente:</span>
      <input required type="text" name="endereco_cliente_input" class="oders_inputs" id="endereco_cliente_input" placeholder="Insira o endereço do cliente">
      </div>
      <div class="input_select">
        <span>Método de Pagamento:</span>
        <select name="metodo_pagamento" class="pagamento_input" id="metodo_pagamento">
          <option value="Cartão Crédito">Cartão Crédito</option>
          <option value="Dinheiro">Dinheiro</option>
          <option value="Cartão Débito">Cartão Débito</option>
          <option value="Pix">Pix</option>


        </select>
      </div>
    </div>

    <div class="entrega_retirada_father">
      <div>

      <span>Vai buscar?</span>
      <label for="sim">Sim</label>
      <input type="radio" name="entrega_retirada" required value="1" id="sim">
      <label for="nao">Não</label>
      <input type="radio" name="entrega_retirada" value="0" id="nao">
      </div>

   
    </div>
  </div>
  <div class="second_row">
    <div class="valor_sangria_father input_father">
      <span>Data do Pedido:</span>
      <input type="datetime-local" value="<?php echo  date('Y-m-d\TH:i');?>" name="" id="data_pedido">


    </div>
    <div class="valor_caixa_father input_father">
      <span>Data da Entrega:</span>
      <input type="datetime-local" name="" value="<?php echo (new DateTime())->modify('+30 minutes')->format('Y-m-d\TH:i') ?>" id="data_entrega">

    </div>
    <div class="valor_caixa_father input_father">
      <span>Quantidade:</span>
      <input type="text" class="oders_inputs" name="" value="1" id="quantidade_produto_pedido">

    </div>
    <div class="valor_caixa_father input_father">
      <span>Nome produto:</span>
      <input type="text" class="tags_produto_name oders_inputs" name="" laceholder="Nome do produto" id="nome_produto_pedido">

    </div>

  </div>
  <table>
    <thead>
      <tr>
        <th>Qt</th>
        <th>Produto</th>
        <th>Valor Unit.</th>
        <th>Valor Total</th>
        <th>Remover</th>

      </tr>
    </thead>
    <tbody>
    <tr class="remove_item_pedido"></tr>
    
    </tbody>
  </table>
  <div class="button_finalizar_father">
    <button id="finaliza_sangria_button" class="finalizar_button">Finalizar Operação</button>
  </div>
</form>
<div id="qr-reader" style="width: 600px"></div>

<div class="modal_troco modal">

  <h3>É Necessário Troco?</h3>
  <div class="inputs_troco_father">
    <div class="input_troco valor_total_troco">
      <span>Valor Total:</span>
      <div class="input_money_father">
        <span class="prefix">R$</span>
        <input type="text" class="oders_inputs input_money" name="valor_total_input" id="valor_total_input">
      </div>
    </div>
    <div class="input_troco valor_recebido_troco ">
      <span>Valor Recebido:</span>
      <div class="input_money_father">
        <span class="prefix">R$</span>
        <input onKeyUp="mascaraMoeda(this, event)" type="text" class="oders_inputs input_money" name="valor_recebido_input" id="valor_recebido_input">
      </div>
    </div>
    <div class="input_troco valor_calculado_troco">
      <span>Valor Calculado:</span>
      <div class="input_money_father">
        <span class="prefix">R$</span>
        <input readonly="readonly" type="text" class="oders_inputs input_money" name="valor_calculado_input" id="valor_calculado_input">
      </div>
    </div>
  </div>
  <div class="button_father">
    <button class="finalizar_venda">Finalizar Venda</button>
  </div>
</div>
<form class="modal modal_sangria">

  <h3>Realizar <strong>Sangria do Caixa</strong></h3>
  <div class="first_row">
    <div class="colaborador_father input_father">
      <span>Colaborador:</span>
      <input required type="text" name="colaborador" class="oders_inputs" id="colaborador_input" placeholder="Insira seu código">
    </div>
    <div class="horario_father input_father">
      <span>Horário da Sangria:</span>
      <red class="horario_atual_finder">Seg: 10/07/2023 10h40</red>
    </div>
  </div>
  <div class="second_row">
    <div class="valor_sangria_father input_father">
      <span>Valor da Sangria:</span>
      <div class="input_valor_sangria">
        <span>R$</span>
        <input type="text" required value="" onKeyUp="mascaraMoeda(this, event)" name="valor_sangria" class="oders_inputs" id="valor_sangria"></input>

      </div>
    </div>
    <div class="valor_caixa_father input_father">
      <span>Valor em Caixa:</span>
      <red>R$00,00</red>
    </div>
    <div class="valor_caixa_apos_father input_father">
      <span>Valor após Sangria:</span>
      <red>R$00,00</red>
    </div>
  </div>
  <span class="motivo_sangria_text">Explique o motivo para realização da Sangria:</span>
  <textarea name="motivo_sangria" id="motivo_sangria" class="oders_inputs" cols="30" rows="10"></textarea>
  <div class="button_finalizar_father">
    <button id="finaliza_sangria_button" class="finalizar_button">Finalizar Operação</button>
  </div>
</form>
<div class="modal modal_pagamento">
  <div class="head_pagamento">

    <div class="inputs_pagamento_father">
      <span>Seu Código:</span>
      <input type="text" class="oders_inputs" placeholder="Digite o seu do código" name="codigo_colaborador_venda" id="codigo_colaborador_venda">

    </div>

    <div class="inputs_pagamento_father">
      <span>Nome Cliente:</span>
      <input type="text" class="oders_inputs" placeholder="Digite o Nome do Cliente" name="nome_cliente" id="nome_cliente">

    </div>
    <div id="whats_cliente_father" class="inputs_pagamento_father">
      <span>Whatsapp Cliente:</span>
      <input type="text" class="oders_inputs" placeholder="Digite o Whatsapp do Cliente" name="whatsapp_cliente" id="whatsapp_cliente">
    </div>
  </div>
  <div class="body_part_pagamento">
    <div class="left_side_pagamento">
      <h3>Pagamento:</h3>
      <div class="input_select">
        <span>Método de Pagamento:</span>
        <select name="metodo_pagamento" class="pagamento_input" id="metodo_pagamento">
          <option value="Cartão Crédito">Cartão Crédito</option>

          <option value="Dinheiro">Dinheiro</option>
          <option value="Cartão Débito">Cartão Débito</option>
          <option value="Pix">Pix</option>


        </select>
      </div>
      <div class="input_select">
        <span>Quantidade de Parcelas:</span>
        <select name="quantidade_parcelas" class="pagamento_input" id="quantidade_parcelas">
          <option value="1x">1x</option>
          <option class="parcelado" value="2x">2x</option>
          <option class="parcelado" value="3x">3x</option>
          <option class="parcelado" value="4x">4x</option>
          <option class="parcelado" value="5x">5x</option>
          <option class="parcelado" value="6x">6x</option>
          <option class="parcelado" value="7x">7x</option>
          <option class="parcelado" value="8x">8x</option>
          <option class="parcelado" value="9x">9x</option>
          <option class="parcelado" value="10x">10x</option>
          <option class="parcelado" value="11x">11x</option>
          <option class="parcelado" value="12x">12x</option>
        </select>
      </div>
      <div class="input_select">
        <span>Tipo de Pagamento:</span>
        <select name="tipo_pagamento" class="pagamento_input" id="tipo_pagamento">
          <option class="parcelado" value="Parcelado">Parcelado</option>

          <option class="a_vista" value="À Vista">À Vista</option>
        </select>
      </div>

    </div>
    <div class="right_side_pagamento">
      <h3>Checkout Venda:</h3>
      <span>Tipo de Pagamento:</span>
      <h4 id="tipo_pagamento_text">À Vista</h4>
      <span>Quantidade de Parcelas:</span>
      <h4 id="quantidade_parcelas_text">1x</h4>
      <span>Metodo de Pagamento:</span>
      <h4 id="metodo_pagamento_text">Dinheiro</h4>
      <p>Total da Compra:</p>
      <h2 id="valor_compra">R$00,00</h2>
      <button id="finalizar_venda_modal_button" class="finalizar_venda_button">Finalizar Venda</button>
    </div>
  </div>


</div>

<div class="content">
  <div class="content_left_side">
    <div class="inputs">
      <div class="first_inputs">
        <div class="input codigo_produto_input">
          <span>Código do Produto:</span>
          <div class="codigo_produto_input_mask">
            <input type="text" name="codigo_produto" placeholder="Escaneie o Cod.Barras do produto ou digite" id="codigo_produto" />
            <i class="fa-solid fa-magnifying-glass"></i>
          </div>
          <div class="search_results_by_barcode">

            <span produto="" class="resultado_pesquisa_by_barcode"></span>
          </div>
        </div>
        <div class="input quantidade_produto_input">
          <span style="margin: 0;">Quantidade:</span>
          <input class="oders_inputs" min="0" type="number" name="quantidade_produto" id="quantidade_produto" value="0" />
        </div>
      </div>
      <div class="input desc_produto_input">
        <span>Descrição do Produto:</span>
        <div class="desc_produto_input_mask">
          <input class="oders_inputs" type="text" name="desc_produto" placeholder="Digite o nome do produto" id="desc_produto" />
          <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        <div class="search_results">
          <!-- results will be added here -->
          <span produto="" class="resultado_pesquisa"></span>
        </div>
      </div>
    </div>
    <table id="tabela_produtos">
      <thead>
        <tr>
          <th>Código</th>
          <th>Código Barras</th>
          <th>NCM</th>
          <th>Descrição</th>
          <th>Preço</th>
          <th>UN</th>
          <th>Estoque</th>
          <th>TA PD</th>
          <th>ICMS</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
    <button class="sangria_button" onclick="abrirModal('modal_sangria')" id="fazer_sangria">Fazer Sangria do Caixa</button>
  </div>
  <div class="content_right_side">
    <div class="valores">
      <div class="valor_father valor_unitario">
        <span>Valor Unitário:</span>
        <strong>R$: 00,00</strong>
      </div>
      <div class="valor_father valor_total">
        <span>Valor Total:</span>
        <strong>R$: 00,00</strong>
      </div>
    </div>
    <div class="venda_atual_box">
      <div class="venda_atual_header">
        <h3><i class="fa-brands fa-opencart"></i> Venda Atual:</h3>
      </div>
      <div class="venda_atual_body">
        <red>Horário da Venda:</red><br>
        <span class="horario_venda"><i class="fa-regular fa-clock"></i>
          <date_now class=" horario_atual_finder">Seg: 10/07/2023 10h40</date_now>
        </span>
        <div class="venda_preview">
          <h3 class="venda_preview_title">Produtos na Venda:</h3>
          <table class="venda_preview_body">
            <thead>
              <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Valor Unitário</th>
                <th>Valor Total</th>
                <th>Retirar</th>

              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
          <h3 class="venda_preview_bottom">Subtotal: R$00,00</h3>


        </div>
        <div class="finalizar_venda_button_principal_father">
          <button id="finalizar_venda_button_principal" onclick="abrirModal('modal_pagamento')" class="finalizar_venda_button_principal">Finalizar Venda</button>
        </div>
      </div>

    </div>
  </div>
</div>

<script src="<?php echo INCLUDE_PATH ?>js/index.js"></script>
<script src="<?php echo INCLUDE_PATH ?>js/posts_senders.js"></script>
<script src="<?php echo INCLUDE_PATH ?>js/procurar_pedidos_proximos.js"></script>


</body>

</html>