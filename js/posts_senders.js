$(".datas").change(function () {
  data = {
    data_min: $("#data_minima").val(),
    data_max: $("#data_maxima").val(),
  };
  console.log();
  $.post(
    "../Models/post_receivers/select_metricas.php",
    data,
    function (ret) {
      row = JSON.parse(ret);
  		$(".pagamento_recorrente").text(row.formaPagamentoMaisRepetida)
     $(".quant_vendas").text(row.quantidadeVendas)
   $(".top_produto").text(row.produtoMaisVendido)
    }
  );
  if ($("dot").attr("style").includes("left")) {
  data = {
    data_min: $("#data_minima").val(),
    data_max: $("#data_maxima").val(),
  };
  console.log();
  $.post(
    "../Models/post_receivers/select_vendas_periodo.php",
    data,
    function (ret) {
      console.log(ret)
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
          "</yellow>"
      );
    }
  );
  }else{
    data = {
      data_min: $("#data_minima").val(),
      data_max: $("#data_maxima").val(),

    };
    $.post(
      "../Models/post_receivers/select_podium.php",
      data,
      function (ret) {
    console.log(ret);

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
            "</yellow>"
        );
      }
    );
  }
  
});
$("switch").click(function () {
  if ($("dot").attr("style").includes("left")) {
    $("dot").css("float", "right");
    data = {
      data_min: $("#data_minima").val(),
      data_max: $("#data_maxima").val(),
      switch:true
    };
    console.log();
    $.post(
      "../Models/post_receivers/select_podium.php",
      data,
      function (ret) {
        $(".tabela_father").remove()
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
            "</yellow>"
        );
      }
    );
  } else {
    $("dot").css("float", "left");
    data = {
      data_min: $("#data_minima").val(),
      data_max: $("#data_maxima").val(),
      switch:true

    };
    console.log();
    $.post(
      "../Models/post_receivers/select_vendas_periodo.php",
      data,
      function (ret) {
        $(".tabela_father").remove()
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
            "</yellow>"
        );
      }
    );
  }
});
