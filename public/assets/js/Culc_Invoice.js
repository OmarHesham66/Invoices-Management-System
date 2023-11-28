$(function () {
    $("#Rate_VAT").on("change", function () {
        var com = parseFloat($("#Commission").val());
        var dis = parseFloat($("#Discount").val() ?? 0);
        var vat = parseFloat($("#Rate_VAT").val());
        if (!com) {
            alert("Please Enter Commission");
        } else {
            let com_after_dis = com - dis;
            let value_vat = com_after_dis * vat;
            let total_after_vat = value_vat + com_after_dis;
            $("#Value_VAT").val(value_vat.toFixed(2));
            $("#Total").val(total_after_vat.toFixed(2));
        }
    });
    $("#bank").on("change", function () {
        $.ajax({
            type: "get",
            url: "/get_products_by_bank/" + $(this).val(),
            dataType: "json",
            success: function (response) {
                if (response.products.length > 0) {
                    response.products.forEach((element) => {
                        $("#product").empty();
                        $(
                            `<option value=${element.id}>${element.name}</option>`
                        ).appendTo("#product");
                    });
                }
            },
        });
    });
});
