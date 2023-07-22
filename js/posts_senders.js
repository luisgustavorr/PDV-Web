$(".datas").change(function () {
  alterarTabela();
});

$(".modificadores_tempo").click(function () {

  var dataNaTabela = moment($("#data_minima").val(), "YYYY-MM-DD");
  var dataAtual = moment();
  dataNaTabela = dataNaTabela.add(1, "days")
  console.log(dataAtual.format("DD/MM/YYYY"))
  console.log(dataNaTabela.format("DD/MM/YYYY"))
  
  if (dataNaTabela.format("DD/MM/YYYY") == dataAtual.format("DD/MM/YYYY") && $(this).attr('id') == 'adiantar_semana') {
    $("#adiantar_semana").css("visibility", "hidden");
  } else {
    $("#adiantar_semana").css("visibility", "unset");
  }
      
  let dataMoment = moment($("#data_minima").val(), "YYYY-MM-DD");
  if ($(this).attr("id") == "voltar_semana") {
    var dataNovaAtrasada = dataMoment.subtract(1, "days");

    $("#data_minima").val(dataNovaAtrasada.format("YYYY-MM-DD"));
    $("#data_maxima").val(dataNovaAtrasada.format("YYYY-MM-DD"));
  } else {
    var dataNovaAdiantada = dataMoment.add(1, "days");

    $("#data_minima").val(dataNovaAdiantada.format("YYYY-MM-DD"));
    $("#data_maxima").val(dataNovaAdiantada.format("YYYY-MM-DD"));
  }

  alterarTabela();
 
});
function alterarTabela() {

  data = {
    data_min: $("#data_minima").val(),
    data_max: $("#data_maxima").val(),
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