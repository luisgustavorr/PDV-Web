let timeoutId;
let input_codigo_focado = false;
let condicao_favoravel = true;
function atualizarHorario() {
  moment.locale("pt-br");
  var dataAtual = moment().format("ddd: DD/MM/YYYY HH[h]mm");
  $(".horario_atual_finder").text(dataAtual);
}

data = {
  caixa: "principal",
};

$.post("Models/post_receivers/select_valor_caixa.php", data, function (ret) {
  let valor = ret == "" ? (valor = 0) : parseFloat(ret);
  if (!valor >= 30) {
    console.log("a");
    $('#fazer_sangria').css('animation','hysterical_pulse 0.7s infinite')
  } else if (valor >= 20) {
    $('#fazer_sangria').css('animation','pulse 3s infinite')

  }
});
function valorCaixa() {
  data = {
    caixa: "principal",
  };

  $.post("Models/post_receivers/select_valor_caixa.php", data, function (ret) {
    let valor = ret == "" ? (valor = 0) : parseFloat(ret);
    console.log(ret);
    $("#valor_sangria").val(valor.toFixed(2).replace(".", ","));
    $(".valor_caixa_father red").text(
      "R$" + valor.toFixed(2).replace(".", ",")
    );
  });
}
atualizarHorario();
setInterval(function () {
  atualizarHorario();
}, 10000);

$("#finaliza_sangria_button").click(function () {
  data = {
    caixa: "principal",
    valor: $(".valor_caixa_apos_father red")
      .text()
      .replace("R$", "")
      .replace(",", "."),
    valor_sangria: $("#valor_sangria").val().replace(",", "."),
    mensagem: $("#motivo_sangria").val(),
  };

  $.post("Models/post_receivers/insert_sangria.php", data, function (ret) {
    console.log(ret);
    location.reload()
  });
});
$("#valor_sangria").keyup(function () {
  //valor caixa - valor retirado
  let valor_caixa = $(".valor_caixa_father red")
    .text()
    .replace("R$", "")
    .replace(",", ".");
  let valor_retirado = $(this).val().replace("R$", "").replace(",", ".");
  if (parseFloat(valor_caixa) > parseFloat(valor_retirado)) {
    $(".valor_caixa_apos_father red").text(
      "R$" +
        Math.abs(parseFloat(valor_caixa) - parseFloat(valor_retirado))
          .toFixed(2)
          .toString()
          .replace(".", ",")
    );
  } else {
    $(".valor_caixa_apos_father red").text("R$00,00");
  }
});
$("#whatsapp_cliente").mask("(00) 0 0000-0000");
$("#codigo_produto").focus(function () {
  input_codigo_focado = true;
});
$("#codigo_produto").blur(function () {
  input_codigo_focado = false;
});
$(".oders_inputs").focus(function () {
  condicao_favoravel = false;
});
$(".oders_inputs").blur(function () {
  condicao_favoravel = true;
});
$(".pagamento_input").change(function () {
  if (
    $(this).val() == "Cartão Crédito" ||
    $(this).attr("id") == "quantidade_parcelas" ||
    $(this).val() == "Parcelado"
  ) {
    $(".a_vista").css("display", "none");
    $(".parcelado").css("display", "block");
    $("#tipo_pagamento").val("Parcelado");
  } else {
    $("#tipo_pagamento").val("À Vista");
    $("#quantidade_parcelas").val("1x");
    $(".parcelado").css("display", "none");
    $(".a_vista").css("display", "block");
  }
  $("#" + $(this).attr("id") + "_text").text($(this).val());
});
$("fundo").click(function () {
  $(".modal").each(function () {
    $(this).css("display", "none");
    $("fundo").css("display", "none");
  });
});
function abrirModal(modal) {
  $("." + modal).css("display", "flex");
  $("fundo").css("display", "flex");
  if (modal == "modal_sangria") {
    valorCaixa();
  }
}
$("#valor_recebido_input").keyup(function () {
  let valor_calculado = parseFloat(
    Math.abs(
      parseFloat($("#valor_total_input").val().replace(",", ".")) -
        parseFloat($(this).val().replace(",", "."))
    ).toFixed(2)
  )
    .toString()
    .replace(".", ",");
  if (
    parseFloat($("#valor_total_input").val().replace(",", ".")) >
    parseFloat($(this).val().replace(",", "."))
  ) {
    $("#valor_calculado_input").val("");
  } else {
    $("#valor_calculado_input").val(valor_calculado);
  }
});
$("#finalizar_venda_modal_button").click(function () {
  //$('#valor_compra').text().replace('R$','') == valor sem R$
  $("#valor_total_input").val($("#valor_compra").text().replace("R$", ""));
  if ($("#metodo_pagamento").val() == "Dinheiro") {
    $("#valor_total_input").val($("#valor_compra").text().replace("R$", ""));
    $(".modal_troco").css("display", "block");
    $(".modal_pagamento").css("display", "none");
  } else {
    valor_compra = parseFloat(
      $("#valor_compra").text().replace("R$", "").replace(",", ".")
    );
    let produtos = [];
    $(".venda_preview_body .quantidade_produto").each(function (index) {
      console.log($(this).attr("id_produto") + $(this).text().replace("x", ""));
      let produto_info = {
        id: $(this).attr("id_produto"),
        quantidade: $(this).text().replace("x", ""),
      };
      produtos[index] = produto_info;
    });
    data = {
      valor: valor_compra,
      caixa: "principal",
      produtos: produtos,
    };

    $.post("Models/post_receivers/insert_venda.php", data, function (ret) {
      console.log(ret);
      $(".modal").each(function () {
        location.reload()
      });
    });
  }
});

$(document).keyup(function (event) {
  if (event.code.includes("Digit") && condicao_favoravel) {
    var key = event.keyCode || event.which;
    key = String.fromCharCode(key);
    console.log(event.code);

    if (input_codigo_focado == false) {
      $("#codigo_produto").val($("#codigo_produto").val() + key);
    }
    const barcode = $("#codigo_produto").val().trim();

    clearTimeout(timeoutId);

    pesquisarProduto(barcode);
  }
});
let darker = false;
function pesquisarProduto(barcode) {
  timeoutId = setTimeout(function () {
    if (barcode.length == 13 || barcode.length == 8) {
      data = {
        barcode: barcode,
      };

      $.post("Models/post_receivers/select_produto.php", data, function (ret) {
        let total_valor = 0;
        darker ? (darker_class = "darker") : (darker_class = "");
        row = JSON.parse(ret);
        $("#desc_produto").val(row.nome);
        $("#quantidade_produto").val(1);
        $("#tabela_produtos tbody").append(
          "   <tr class='row_id_" +
            row.id +
            " " +
            darker_class +
            " '><td>" +
            row.id +
            "</td><td>" +
            row.codigo +
            "</td><td>170.99.00</td><td>" +
            row.nome +
            "</td><td id_produto='" +
            row.id +
            "' nome_produto='" +
            row.nome +
            "' class='preco_produto'>" +
            row.preco +
            "</td><td>" +
            1 +
            "</td><td>0</td><td>A P</td><td>0,00</td></tr>"
        );
        $(".valor_unitario strong").text("R$:" + row.preco);
        $("#tabela_produtos .preco_produto").each(function () {
          total_valor =
            parseFloat(total_valor) +
            parseFloat($(this).text().replace(",", "."));
          $(".tiny_row_id" + $(this).attr("id_produto")).remove();
          $(".venda_preview_body tbody").append(
            '<tr class="tiny_row_id' +
              $(this).attr("id_produto") +
              '"><td>' +
              $(this).attr("nome_produto") +
              "</td><td class='quantidade_produto' id_produto='" +
              $(this).attr("id_produto") +
              "'>" +
              $(".row_id_" + $(this).attr("id_produto")).length +
              "x</td><td>R$" +
              $(this).text() +
              "</td><td>R$" +
              parseFloat(
                (
                  parseFloat($(this).text().toString().replace(",", ".")) *
                  parseFloat($(".row_id_" + $(this).attr("id_produto")).length)
                ).toFixed(2)
              ) +
              '</td><td><i class="fa-regular fa-trash-can" style="color: rgba(230, 13, 46, 1); font-size: 10px;"></i></td></tr>'
          );
          console.log($("#row_id_" + row.id).length);
        });
        $(".valor_total strong").text(
          "R$:" + total_valor.toFixed(2).toString().replace(".", ",")
        );
        $(".venda_preview_bottom").text(
          "Subtotal: R$:" + total_valor.toFixed(2).toString().replace(".", ",")
        );
        $("#valor_compra").text(
          "R$" + total_valor.toFixed(2).toString().replace(".", ",")
        );
        darker = !darker;
      });
      console.log("Código de barras lido:", barcode);
      $("#codigo_produto").val("");
      $("#desc_produto").val("");
    }
  }, 350);
}
//Mascara de moeda
String.prototype.reverse = function () {
  return this.split("").reverse().join("");
};

function mascaraMoeda(campo, evento) {
  var tecla = !evento ? window.event.keyCode : evento.which;
  var valor = campo.value.replace(/[^\d]+/gi, "").reverse();
  var resultado = "";
  var mascara = "##.###.###,##".reverse();
  for (var x = 0, y = 0; x < mascara.length && y < valor.length; ) {
    if (mascara.charAt(x) != "#") {
      resultado += mascara.charAt(x);
      x++;
    } else {
      resultado += valor.charAt(y);
      y++;
      x++;
    }
  }
  campo.value = resultado.reverse();
}
