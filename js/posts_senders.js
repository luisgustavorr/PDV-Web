$(".datas").change(function () {
  alterarTabela();
});
$('#adicionar_caixa').submit(function(e){
  e.preventDefault()
  data = {
    nome_caixa: $('#nome_caixa').val(),
    troco_inicial:$('#troco_inicial').val()
 };

 $.post("../Models/post_receivers/insert_caixa.php", data, function(ret) {
  location.reload()

 })
})
let add_caixa_opnd = false
$('#add_caixa_opener').click(function(){
  if(add_caixa_opnd){
    $("#adicionar_caixa").css('display','none')

  }else{
    $("#adicionar_caixa").css('display','flex')

  }
  add_caixa_opnd = ! add_caixa_opnd 
})
$('#form_equip').submit(function(e){
  e.preventDefault()
  data = {
    caixa:$('#select_caixa').val(),
    impressora:  $('#nome_impressora').val(),
    porta_balanca:$('#porta_balanca').val(),
    freq_balanca:$('#freq_balanca').val()
 };

 $.post("../Models/post_receivers/insert_equipamentos.php", data, function(ret) {
  location.reload()

 })
})
$('#select_caixa').change(function(){
  $('#form_equip').css("display",'block')
  $('#form_equip red').text($(this).val()+':')
  if($(this).val()=='todos'){
    $('#form_equip').css("display",'none')
  }
  data = {
    caixa:$(this).val()
 };

 $.post("../Models/post_receivers/select_equipamentos.php", data, function(ret) {
   let infos = JSON.parse(ret)
  console.log(infos)
  $('#nome_impressora').val(infos.impressora)
  $('#porta_balanca').val(infos.porta_balanca)
  $('#freq_balanca').val(infos.velocidade_balanca)

 })
})
$(".modal_anotar_pedido").submit(function (e) {
  e.preventDefault();
  produtos = [];
  data_entrega = $("#data_entrega").val().replace("T", " ");
  data_pedido = $("#data_pedido").val().replace("T", " ");
  $(".modal_anotar_pedido tbody")
    .children()
    .each(function (index) {
      let produto = {
        id: $(this).attr("produto"),
        quantidade: $(this).attr("quantidade"),
        preco: $(this).attr("preco_produto"),
      };
      produtos[index] = produto;
    });
  console.log($("#data_pedido").val());
  data = {
    pedido:$('#pedido_id').val(),
    path: $('#include_path').val(),
    caixa: $('#select_caixa').val(),
    endereco:$('#endereco_cliente_input').val(),
    pagamento: $('#metodo_pagamento').val(),
    produtos: produtos,
    cliente: $("#nome_cliente_input").val(),
    data_entrega: data_entrega,
    data_pedido: data_pedido,
    codigo_colaborador: $("#codigo_colaborador_input").val(),
    retirada: $('input[name="entrega_retirada"]:checked').val(),
  };
  if($('#editando').val() == 'true'){
    $.post("Models/post_receivers/update_pedido.php", data, function (ret) {
      console.log(ret)
    });
  }else{
    $.post("Models/post_receivers/insert_pedido.php", data, function (ret) {
      console.log(ret)
    });
  }

});
$("#lista_pedidos span").click(function() {
  // Exibir o fundo e a modal
  exibirModalAnotarPedido();
	$('#editando').val("true")
  let pedido = JSON.parse($(this).attr('pedido'));
  $('#pedido_id').val(pedido.id)
  // Preencher os campos da modal com os dados do pedido
  $('#nome_cliente_input').val(pedido.cliente);
  $('#endereco_cliente_input').val(pedido.endereco);
  $('#metodo_pagamento').val(pedido.forma_pagamento);
  $('#data_pedido').val(pedido.data_pedido);
  $('#data_entrega').val(pedido.data_entrega);

  let produtos = JSON.parse(pedido.produtos);
  produtos.forEach(produto => {
    const data = {
      editando_pedido: true,
      produto: produto.id,
      caixa: $('#select_caixa').val(),
    };

    $.post("Models/post_receivers/select_produto.php", data, function(ret) {
      console.log(ret);
      let produtoData = JSON.parse(ret);

      // Construir a linha da tabela da modal com as informações do produto
      const newRow = `4
        <tr preco_produto="${produto.preco.toString().replace(",", ".")}" produto="${produto.id}" quantidade="${$("#quantidade_produto_pedido").val()}" class="produto_pedido${produto.id}">
          <td>${$("#quantidade_produto_pedido").val()}</td>
          <td>${produtoData.nome}</td>
          <td>${produtoData.preco}</td>
          <td>${(parseFloat(produtoData.preco.replace(",", ".")) * parseFloat(produto.quantidade)).toFixed(2)}</td>
          <td produto="${produto.id}" class="remove_item_pedido">-</td>
        </tr>
      `;

      $(".modal_anotar_pedido tbody").append(newRow);
    });
  });
});

function exibirModalAnotarPedido() {
  $('fundo').css('display', 'flex');
  $('.modal_anotar_pedido').css('display', 'flex');
}
function mudarTempo(esse){
  var dataNaTabela = moment($("#data_minima").val(), "YYYY-MM-DD");
  var dataAtual = moment();
  dataNaTabela = dataNaTabela.add(1, "days")
  console.log(dataAtual.format("DD/MM/YYYY"))
  console.log(dataNaTabela.format("DD/MM/YYYY"))
  if (dataNaTabela.format("DD/MM/YYYY") == dataAtual.format("DD/MM/YYYY") && $(esse).attr('id') == 'adiantar_semana') {
    $("#adiantar_semana").css("visibility", "hidden");
  } else {
    $("#adiantar_semana").css("visibility", "unset");
  }
      
  let dataMoment = moment($("#data_minima").val(), "YYYY-MM-DD");
  if ($(esse).attr("id") == "voltar_semana") {
    var dataNovaAtrasada = dataMoment.subtract(1, "days");

    $("#data_minima").val(dataNovaAtrasada.format("YYYY-MM-DD"));
    $("#data_maxima").val(dataNovaAtrasada.format("YYYY-MM-DD"));
  } else {
    var dataNovaAdiantada = dataMoment.add(1, "days");

    $("#data_minima").val(dataNovaAdiantada.format("YYYY-MM-DD"));
    $("#data_maxima").val(dataNovaAdiantada.format("YYYY-MM-DD"));
  }

  alterarTabela();
 
}
function alterarTabela() {

  data = {
    data_min: $("#data_minima").val(),
    data_max: $("#data_maxima").val(),
    caixa: $('#select_caixa').val(),
  };
  $.post("../Models/post_receivers/select_metricas.php", data, function (ret) {
    row = JSON.parse(ret);
    $(".pagamento_recorrente").text(row.formaPagamentoMaisRepetida);
    $(".quant_vendas").text(row.quantidadeVendas);
    $(".top_produto").text(row.produtoMaisVendido);
  });
  if ($("dot").attr("style").includes("left")) {
    data = {
      data_min: $("#data_minima").val(),
      data_max: $("#data_maxima").val(),
      caixa: $('#select_caixa').val(),
    };
    $.post(
      "../Models/post_receivers/select_vendas_periodo.php",
      data,
      function (ret) {
        $(".tabela_father tbody").html(ret);
        if ($("#data_minima").val() == $("#data_maxima").val()) {
          var novaData = moment($("#data_minima").val(), "YYYY-MM-DD");
          var novaDataFormatada = novaData.format("DD/MM/YYYY");
          $(".tabela_header span").html(
            "Vendas no dia: <yellow>" + novaDataFormatada + "</yellow> <i onclick='gerarPDFFullFunction(this)' class='gerar_pdf fa-regular fa-file-pdf'></i>"
          );
        } else {
          var dataMomentMAX = moment($("#data_maxima").val(), "YYYY-MM-DD");
          var dataMAXFormatada = dataMomentMAX.format("DD/MM/YYYY");
          var dataMomentMIN = moment($("#data_minima").val(), "YYYY-MM-DD");
          var dataMINFormatada = dataMomentMIN.format("DD/MM/YYYY");
          $(".tabela_header span").html(
            "Vendas no período de: <yellow>" +
              dataMINFormatada +
              "</yellow> até <yellow>" +
              dataMAXFormatada +
              "</yellow> <i onclick='gerarPDFFullFunction()'  class='gerar_pdf fa-regular fa-file-pdf'></i>"
          );
        }
      }
    );
  } else {
    data = {
      data_min: $("#data_minima").val(),
      data_max: $("#data_maxima").val(),
      caixa: $('#select_caixa').val(),
    };
    $.post("../Models/post_receivers/select_podium.php", data, function (ret) {
      $(".tabela_father tbody").html(ret);
      var dataMomentMAX = moment($("#data_maxima").val(), "YYYY-MM-DD");
      var dataMAXFormatada = dataMomentMAX.format("DD/MM/YYYY");
      var dataMomentMIN = moment($("#data_minima").val(), "YYYY-MM-DD");
      var dataMINFormatada = dataMomentMIN.format("DD/MM/YYYY");
      $(".tabela_header span").html(
        "Vendas no período de: <yellow>" +
          dataMINFormatada +
          "</yellow> até <yellow>" +
          dataMAXFormatada +
          "</yellow> <i onclick='gerarPDFFullFunction()'class='gerar_pdf' class='fa-regular fa-file-pdf'></i>"
      );
    });
  }
}
$("switch").click(function () {
  if ($("dot").attr("style").includes("left")) {
    $("dot").css("float", "right");
    data = {
      data_min: $("#data_minima").val(),
      data_max: $("#data_maxima").val(),
      caixa: $('#select_caixa').val(),
      switch: true,
    };
    $.post("../Models/post_receivers/select_podium.php", data, function (ret) {
      $(".tabela_father").remove();
      $("body").append(ret);
      var dataMomentMAX = moment($("#data_maxima").val(), "YYYY-MM-DD");
      var dataMAXFormatada = dataMomentMAX.format("DD/MM/YYYY");
      var dataMomentMIN = moment($("#data_minima").val(), "YYYY-MM-DD");
      var dataMINFormatada = dataMomentMIN.format("DD/MM/YYYY");
      $(".tabela_header span").html(
        "Vendas no período de: <yellow>" +
          dataMINFormatada +
          "</yellow> até <yellow>" +
          dataMAXFormatada +
          "</yellow> <i onclick='gerarPDFFullFunction()'class='gerar_pdf fa-regular fa-file-pdf'></i>"
      );
    });
  } else {
    $("dot").css("float", "left");
    data = {
      data_min: $("#data_minima").val(),
      data_max: $("#data_maxima").val(),
      caixa: $('#select_caixa').val(),
      switch: true,
    };
    $.post(
      "../Models/post_receivers/select_vendas_periodo.php",
      data,
      function (ret) {
        $(".tabela_father").remove();
        $("body").append(ret);
        var dataMomentMAX = moment($("#data_maxima").val(), "YYYY-MM-DD");
        var dataMAXFormatada = dataMomentMAX.format("DD/MM/YYYY");
        var dataMomentMIN = moment($("#data_minima").val(), "YYYY-MM-DD");
        var dataMINFormatada = dataMomentMIN.format("DD/MM/YYYY");
        $(".tabela_header span").html(
          "Vendas no período de: <yellow>" +
            dataMINFormatada +
            "</yellow> até <yellow>" +
            dataMAXFormatada +
            "</yellow> <i onclick='gerarPDFFullFunction()' class='gerar_pdf fa-regular fa-file-pdf'></i>"
        );
      }
    );
  }

});
$("#input_codigo_user").on('input',function(){
  data = {
     colaborador:$(this).val()
   };
   $.post(
     "../Models/post_receivers/select_colaborador.php",
     data,
     function (ret) {
       $('#input_nome_user').val(ret)
     })
})