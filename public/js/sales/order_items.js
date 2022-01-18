let arr_order_item = [];
let old_arr_order_item = [];
let order_item_form;
let liste_order_items;
let item_rank;

const orderItemProperties = (action, rank) => {
    switch (action) {
        case "new":
            item_rank = null;
            order_item_form = $("#orderItemForm");
            $("#orderItemOrderId").val(order.order_id ? order.order_id : "");
            $("#orderItemItemId").val("");
            $("#orderItemProductId").val("");
            $("#orderItemFakeProductName").html("*** Produit ***");
            order_item_form[0].reset();
            $("#orderItemModal").modal();
            break;

        case "edit":
            console.log(arr_order_item[rank - 1]);
            console.log(rank);
            item_rank = rank - 1;
            // fill hidden field
            $("#orderItemOrderId").val(
                arr_order_item[item_rank].order_id
                    ? arr_order_item[item_rank].order_id
                    : ""
            );
            $("#orderItemItemId").val(
                arr_order_item[item_rank].item_id
                    ? arr_order_item[item_rank].item_id
                    : ""
            );
            $("#orderItemProductId").val(arr_order_item[item_rank].product_id);
            // fill field
            $("#orderItemFakeProductName").val(
                arr_order_item[item_rank].product.product_name
            );
            $("#orderItemListPrice").val(arr_order_item[item_rank].list_price);
            $("#orderItemQuantity").val(
                arr_order_item[item_rank].quantity
                    ? arr_order_item[item_rank].quantity
                    : 0
            );
            $("#orderItemDiscount").val(
                arr_order_item[item_rank].discount
                    ? arr_order_item[item_rank].discount
                    : 0
            );
            orderItemCalcTotal();
            // show modal
            $("#orderItemModal").modal();
            break;

        case "save":
            console.log(arr_order_item.length);
            if (item_rank === null) {
                let o = {
                    order_id: $("#orderItemOrderId").val(),
                    item_id: arr_order_item.length + 1,
                    product_id: $("#orderItemProductId").val(),
                    product: {
                        product_name: $("#orderItemFakeProductName").val(),
                    },
                    quantity: $("#orderItemQuantity").val(),
                    list_price: $("#orderItemListPrice").val(),
                    discount: $("#orderItemDiscount").val(),
                    created: true,
                };
                arr_order_item.push(o);
                // console.log(arr_order_item);
            } else {
                console.log(arr_order_item);
                arr_order_item[item_rank].order_id =
                    $("#orderItemOrderId").val();
                arr_order_item[item_rank].item_id = $("#orderItemItemId").val();
                arr_order_item[item_rank].product_id = $(
                    "#orderItemProductId"
                ).val();
                arr_order_item[item_rank].product.product_name = $(
                    "#orderItemFakeProductName"
                ).val();
                arr_order_item[item_rank].quantity =
                    $("#orderItemQuantity").val();
                arr_order_item[item_rank].list_price = $(
                    "#orderItemListPrice"
                ).val();
                arr_order_item[item_rank].discount =
                    $("#orderItemDiscount").val();
                arr_order_item[item_rank].created = false;
            }
            // functions
            orderItemGenerateTableDraw();
            // hide modal
            $("#orderItemModal").modal("hide");
            break;
        case "view":
            $.ajax({
                type: "GET",
                url: "viewOrderItem/" + rank,
                dataType: "json",
                success: function (json) {
                    // console.log(json);
                    arr_order_item = json.data;
                    let tab = $("#orderItemView>tbody");
                    let total_item_price_hr = [];
                    let total_item_price_discount = [];

                    tab.empty();
                    $.each(arr_order_item, (k, v) => {
                        let item_price_hr =
                            parseFloat(v.list_price) * parseFloat(v.quantity);
                        let item_price_discount =
                            parseFloat(v.list_price) *
                            (1 - parseFloat(v.discount)) *
                            parseFloat(v.quantity);
                        total_item_price_hr.push(item_price_hr);
                        total_item_price_discount.push(item_price_discount);
                        tab.append(
                            $("<tr>")
                                .append($("<td>").html(v.item_id))
                                .append($("<td>").html(v.product.product_name))
                                .append($("<td>").html(v.quantity))
                                .append($("<td>").html(v.list_price))
                                .append($("<td>").html(item_price_hr))
                        );

                        let total_price_hr = total_item_price_hr.reduce(
                            (a, b) => a + b,
                            0
                        );
                        let total_price_discount =
                            total_item_price_discount.reduce(
                                (a, b) => a + b,
                                0
                            );
                        $("#orderTotalHorsReductionView").html(
                            total_price_hr.toFixed(2)
                        );
                        $("#orderTotalView").html(
                            total_price_discount.toFixed(2)
                        );
                    });
                },
            });
            break;

        case "delete":
            old_arr_order_item.push(
                arr_order_item.find((element) => element.item_id == rank)
            );
            arr_order_item.splice(rank - 1, 1);
            for (i = 0; i < arr_order_item.length; i++) {
                arr_order_item[i].item_id = i + 1;
            }
            orderItemGenerateTableDraw();
            break;
    }
};

const orderItemGenerateTableDraw = () => {
    // dessine le tableau
    liste_order_items.clear();
    liste_order_items.rows.add(arr_order_item);
    liste_order_items.draw();
    // creer des champs hidden pour enregistrement en bdd
    // console.log(arr_order_item);
    // console.log(old_arr_order_item);
    let d = $("#orderItemHiddenInput");
    d.empty();
    $.each(arr_order_item, function (k, v) {
        d.append(
            $("<input>")
                .attr("type", "hidden")
                .attr("name", "order_items[" + k + "][order_id]")
                .val(v.order_id)
        );
        d.append(
            $("<input>")
                .attr("type", "hidden")
                .attr("name", "order_items[" + k + "][item_id]")
                .val(v.item_id)
        );
        d.append(
            $("<input>")
                .attr("type", "hidden")
                .attr("name", "order_items[" + k + "][product_id]")
                .val(v.product_id)
        );
        d.append(
            $("<input>")
                .attr("type", "hidden")
                .attr("name", "order_items[" + k + "][quantity]")
                .val(v.quantity)
        );
        d.append(
            $("<input>")
                .attr("type", "hidden")
                .attr("name", "order_items[" + k + "][list_price]")
                .val(v.list_price)
        );
        d.append(
            $("<input>")
                .attr("type", "hidden")
                .attr("name", "order_items[" + k + "][discount]")
                .val(v.discount)
        );
        d.append(
            $("<input>")
                .attr("type", "hidden")
                .attr("name", "order_items[" + k + "][created]")
                .val(v.created)
        );
    });
    $.each(old_arr_order_item, (k, v) => {
        d.append(
            $("<input>")
                .attr("type", "hidden")
                .attr("name", "order_items[" + k + "][old_order_id]")
                .val(v.order_id)
        );
        d.append(
            $("<input>")
                .attr("type", "hidden")
                .attr("name", "order_items[" + k + "][old_item_id]")
                .val(v.item_id)
        );
    });
};

const generateDataTableOrderItems = () => {
    console.log(order.order_id);
    liste_order_items = $("#liste_order_items").DataTable({
        order: [[0, "asc"]],
        ajax: "viewOrderItem/" + order.order_id,
        dom: "t",
        destroy: true,
        paging: false,
        columns: [
            {
                data: "item_id",
                render: (data, type, row, meta) => {
                    // console.log(data);
                    return data != null ? data : "-";
                },
            },
            {
                data: "product.product_name",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "list_price",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "discount",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "item_id",
                render: (data, type, row, meta) => {
                    var edit = $("<span>")
                        .attr("class", "btn btn-info btn-sm my-1")
                        .attr(
                            "onClick",
                            "orderItemProperties('edit'," + data + ")"
                        )
                        .html(
                            $("<i>").addClass("fas fa-fw fa-edit")
                        )[0].outerHTML;

                    var del = $("<span>")
                        .attr("class", "btn btn-danger btn-sm")
                        .attr(
                            "onClick",
                            "orderItemProperties('delete'," + data + ")"
                        )
                        .html(
                            $("<i>").addClass("fas fa-fw fa-backspace")
                        )[0].outerHTML;

                    return edit + "&nbsp;" + del;
                },
            },
        ],
    });
};

const orderItemCalcTotal = () => {
    if ($("#orderItemDiscount").val() !== 0) {
        $("#orderItemTotal").val(
            parseFloat($("#orderItemListPrice").val()) *
                parseInt($("#orderItemQuantity").val()) *
                (1 - parseFloat($("#orderItemDiscount").val()))
        );
    } else {
        $("#orderItemTotal").val(
            parseFloat($("#orderItemListPrice").val()) *
                parseInt($("#orderItemQuantity").val())
        );
    }
};

$(() => {
    $("#addOrderItem").click(() => {
        orderItemProperties("new");
    });

    $("#orderItemBtnSave").click(() => {
        orderItemProperties("save");
    });
    $("#orderItemFakeProductName").click(() => {
        $("#productSelectModal").modal();
    });

    $("#orderItemQuantity").change(() => {
        orderItemCalcTotal();
    });

    $("#orderItemDiscount").change(() => {
        orderItemCalcTotal();
    });
});
