$(function () {

    $("#formLot").submit(function (e) {

        e.preventDefault();

        var indexChecked = null,
            formData = new FormData(),
            quantitySelected = $("#quantitySelected"),
            btn = $(this).find("button");

        //verificando qual lote foi selecionado para montar o form que sera enviado ao backend
        $(this).find("input[type=radio]").each(function (i, v) {

            //buscando o inice do lot selecionado
            if ($(v).is(":checked")) {
                indexChecked = $(v).attr('id').split("_");
                indexChecked = indexChecked[1];
            }
        });

        //validando no front se a quantidade informada e menor ou igual a zero ou acima do limite disponivel

        var quantitySelectedInt = parseInt(quantitySelected.val()),
            availableQuantity = $("#availableQuantity_" + indexChecked),
            v = $("#v_" + indexChecked);

        if (isNaN(quantitySelectedInt) || quantitySelectedInt <= 0 || quantitySelectedInt > parseInt(availableQuantity.val())) {
            alert("A quantidade de entradas não pode ser menor ou igual a zero ou acima da quantidade disponível");
            return false;
        }

        //montando o form
        formData.append('availableQuantity', availableQuantity.val());
        formData.append('event_id', $("#event_id_" + indexChecked).val());
        formData.append('ticket_id', $("#lot_" + indexChecked).val());
        formData.append('quantitySelected', quantitySelected.val());
        formData.append('v', v.val());

        $.ajax({
            type: "POST",
            url: "/data/checkout/add-to-cart",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                btn.attr('disabled', 'disabled');
            },
            complete: function () {
                btn.removeAttr('disabled');
            },
            success: function (data) {
                Cookies.set('cart', JSON.stringify(data.data), {expires: (1 / 48) / 2});
                window.location.href = "/data/checkout";
            },
            error: function (data) {
                alert(data.responseJSON.message);
            }
        });
    });

    if (window.location.pathname === "/data/checkout") {

        var cart = Cookies.get('cart');

        if (cart) {
            cart = JSON.parse(cart);
            var timer = $("#timer");

            //criando a contagem para a compra do ticket.
            var countDownDate = new Date(cart.cart_expires_at.date).getTime();

            var x = setInterval(function () {

                var now = new Date().getTime();
                var distance = countDownDate - now;

                timer.empty();
                timer.append("<p><span>Tempo para conclusão da compra: </span></p>" + Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)) + "m " + Math.floor((distance % (1000 * 60)) / 1000) + "s ");

                if (distance < 0) {

                    clearInterval(x);

                    //liberando o carrinho e devolvendo as entradas para o ticket
                    $.ajax({
                        type: "GET",
                        url: "/data/checkout/remove-from-cart/" + cart.cart_id,
                        cache: false,
                        success: function (data) {
                            window.location.reload();
                        }
                    });
                }
            }, 1000);
        }
    }

    $("#order").submit(function (e) {

        e.preventDefault();

        var formData = new FormData($(this)[0]),
            btn = $(this).find("button"),
            alertErr = $("#alertErr");

        $.ajax({
            type: "POST",
            url: "/data/checkout/order",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                btn.attr('disabled', 'disabled');
                alertErr.empty();
                alertErr.css({display: "none"});
            },
            complete: function () {
                btn.removeAttr('disabled');
            },
            success: function (data) {
                Cookies.remove('cart');
                window.location.href = "/data/index/success";
            },
            error: function (data) {

                if (data.responseJSON.fields) {
                    for (var i = 0; i < data.responseJSON.fields.length; i++) {

                        var field = $("#" + data.responseJSON.fields[i]);
                        if (field.length) {
                            field.css({border: "1px solid red"});
                        }
                    }
                }

                if (data.responseJSON.message) {
                    alertErr.css({display: "block"});
                    alertErr.append(data.responseJSON.message);
                }
            }
        });
    });
});