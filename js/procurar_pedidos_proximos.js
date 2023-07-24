function minhaFuncao() {
    data = {};
    
     $.post("Models/post_receivers/select_pedidos.php", data, function(ret) {
        let pedidos = JSON.parse(ret)
        if(!$.isEmptyObject(pedidos)){
            $('#notification').css("display",'block')
            console.log("aqui")
            pedidos.forEach(element => {
            let data = element.data_entrega.split(' ')

                $('#notification section').append("<span onclick='editarPedido(this)' pedido='"+JSON.stringify(element).replace(/\\r/g, '').replace(/\\n/g, '').replace("Array",'')+"'>O pedido do "+element.cliente+" para as "+data[1]+" do dia "+data[0]+" está próximo da hora da entrega<span><br>")
            
            });
        }
     
     })

}

// Chame a função pela primeira vez (opcional, caso queira executá-la imediatamente)
minhaFuncao();

var intervalo = 10 * 60 * 1000;

// Use a função setInterval para executar a função a cada intervalo de tempo definido
setInterval(minhaFuncao, intervalo);