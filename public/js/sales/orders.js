var order;
var order_form;
var order_modal;
var liste_orders;
var liste_brands;
var liste_categories;

const orderProperties = (action, _id) => {
    switch (action) {

        case "new":
            order_form = $("#orderForm");
            $("#orderId").val('');
            order_form[0].reset();
            // generateOptionInput();

            $("#orderModal").modal();
            break;

        case "edit":
            console.log("edit");
            order_form = $("#orderForm");
            $.ajax({
                url: 'viewOrder/' + _id,
                type: 'GET',
                dataType: 'json',
                success: (json) => {
                    console.log(json[0]);
                    order = json[0];
                    generateOptionInput();

                    $("#orderId").val(order.order_id);
                    $("#orderName").val(order.order_name);
                    $("#orderModelYear").val(order.model_year);
                    $("#orderListPrice").val(order.list_price);
                    $("#orderBrandId").val(order.brand_id);
                    $("#orderCategoryId").val(order.category_id);

                    $("#orderModal").modal();
                },
                error: (error) => {
                    console.log(error);
                }
            });
            break;

        case "save":
            var formData = new FormData(order_form[0]);
            console.log(order_form[0]);
            console.log(formData);
            $.ajax({
                url: 'saveOrder',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': crsf_token
                },
                success: (json) => {
                    console.log(json);
                    if (json.status == 0) {
                        liste_orders.ajax.reload();
                        $("#orderModal").modal('hide');
                    }
                },
                error: (error) => {
                    console.log(error);
                }
            });
            break;

        case "delete":
            $.ajax({
                url: 'deleteOrder/' + _id,
                type: 'POST',
                cache: false,
                headers: {
                    'X-CSRF-Token': crsf_token
                },
                dataType: 'json',
                success: (json) => {
                    console.log(json);
                    if (json.status === 0) {
                        liste_orders.ajax.reload();
                    }
                },
                error: (error) => {
                    console.log(error);
                    // swal("Erreur!", "Impossible de supprimer la NIP", "error");
                }
            });
            break;

        case "view":
            console.log("guest_" + _id);
            break;
    }
}

const generateOptionInput = () => {
    $.each(liste_brands, (k, v) => {
        $("#orderBrandId").append($('<option value="' + v.id + '">').html(v.name));
    });

    $.each(liste_categories, (k, v) => {
        $("#orderCategoryId").append($('<option value="' + v.id + '">').html(v.name));
    });
}

$(() => {
    // datatable
    liste_orders = $("#liste_orders").DataTable({
        order: [[0, "desc"]],
        ajax: "listOrder",
        columns: [
            {
                data: "id", render: (data, type, row, meta) => {
                    // console.log(data);
                    return $('<span>')
                        .addClass('btn btn-secondary btn-sm')
                        .html(data === '' ? $('<i>').html('non renseigné') : data)
                        .attr('onClick', "orderProperties('view','" + row.id + "');")[0].outerHTML;
                }
            },
            {
                data: "order_status", render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                }
            },
            {
                data: "order_date", render: (data, type, row, meta) => {
                    return data != null ? moment(data).format("DD/MM/YYYY") : "-";
                }
            },
            {
                data: "required_date", render: (data, type, row, meta) => {
                    return data != null ? moment(data).format("DD/MM/YYYY") : "-";
                }
            },
            {
                data: "shipped_date", render: (data, type, row, meta) => {
                    return data != null ? moment(data).format("DD/MM/YYYY") : "-";
                }
            },
            {
                data: "customer_id", render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                }
            },
            {
                data: "store_id", render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                }
            },
            {
                data: "staff_id", render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                }
            },
            {
                data: "id",
                render: (data, type, row) => {
                    var edit = $("<button>")
                        .attr("class", "btn btn-info btn-sm my-1")
                        .attr('onClick', "orderProperties('edit'," + row.id + ")")
                        .html($("<i>").addClass("fas fa-fw fa-edit"))
                    [0].outerHTML;

                    var del = $("<button>")
                        .attr("class", "btn btn-danger btn-sm")
                        .attr('onClick', "orderProperties('delete'," + row.id + ")")
                        .html($("<i>").addClass("fas fa-fw fa-backspace"))
                    [0].outerHTML;

                    return edit + "&nbsp;" + del;
                },
            }
        ]
    });

    // $.ajax({
    //     type: "get",
    //     url: "indexOrder",
    //     dataType: "json",
    //     success: (json) => {
    //         console.log(json);

    //     },
    //     error: (error) => {
    //         console.log(error);
    //     }
    // });

    $("#addOrder").click(() => {
        orderProperties("new");
    });

    $("#orderModal .btn-primary").click(() => {
        orderProperties("save");
    });
});