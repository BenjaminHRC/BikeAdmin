var order;

var order_form;
var order_modal;
var liste_orders;
var liste_customers;
var liste_staffs;
var liste_stores;

const orderProperties = (action, _id) => {
    switch (action) {
        case "new":
            order_form = $("#orderForm");
            $("#orderId").val("");
            order_form[0].reset();
            generateOptionInput();

            $("#orderModal").modal();
            break;

        case "edit":
            // console.log("edit");
            order_form = $("#orderForm");

            $.ajax({
                url: "viewOrder/" + order.order_id,
                type: "GET",
                dataType: "json",
                success: (json) => {
                    // console.log(json);
                    order = json;
                    $("#orderModal .modal-title").html(
                        "Facture #" + order.order_id
                    );
                    generateOptionInput();
                    $("#orderId").val(order.order_id);
                    $("#orderStatus").val(order.order_status);
                    $("#orderDate").val(order.order_date);
                    $("#orderStoreId").val(order.store_id);
                    $("#orderStaffId").val(order.staff_id);
                    $("#orderCustomerId").val(order.customer_id);
                    $("#orderFakeCustomerName").val(
                        order.customer.first_name +
                            " " +
                            order.customer.last_name
                    );
                    $("#orderRequiredDate").val(
                        order.required_date ? order.required_date : ""
                    );
                    $("#orderShippedDate").val(
                        order.shipped_date ? order.shipped_date : ""
                    );
                    $("#orderModal").modal();
                },
                error: (error) => {
                    console.log(error);
                },
            });
            break;

        case "save":
            var formData = new FormData(order_form[0]);
            console.log(order_form[0]);
            console.log(formData);
            $.ajax({
                url: "saveOrder",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": crsf_token,
                },
                success: (json) => {
                    console.log(json);
                    if (json.orders.status == 0) {
                        liste_orders.ajax.reload();
                        orderProperties("view", order.order_id);
                        $("#orderModal").modal("hide");
                    }
                },
                error: (error) => {
                    console.log(error);
                },
            });
            break;

        case "delete":
            $.ajax({
                url: "deleteOrder/" + _id,
                type: "POST",
                cache: false,
                headers: {
                    "X-CSRF-Token": crsf_token,
                },
                dataType: "json",
                success: (json) => {
                    console.log(json);
                    if (json.status === 0) {
                        liste_orders.ajax.reload();
                    }
                },
                error: (error) => {
                    console.log(error);
                    // swal("Erreur!", "Impossible de supprimer la NIP", "error");
                },
            });
            break;

        case "view":
            $.ajax({
                url: "viewOrder/" + _id,
                type: "GET",
                dataType: "json",
                success: (json) => {
                    // console.log(json);
                    order = json;
                    // orderCommon = json[0];
                    // console.log(order);
                    // console.log(order.order_date);
                    $("#orderViewModal .modal-title").html(
                        "Facture N°" + order.order_id
                    );
                    $("#orderIdView").html(order.order_id);
                    $("#orderDateView").html(
                        order.order_date
                            ? moment(order.order_date).format("DD/MM/YYYY")
                            : "-"
                    );
                    $("#orderVendorNameView").html(
                        order.store.store_name ? order.store.store_name : "-"
                    );
                    $("#orderStoreLocationView").html(
                        order.store.street &&
                            order.store.city &&
                            order.store.state &&
                            order.store.zip_code
                            ? order.store.street +
                                  " " +
                                  order.store.city +
                                  " " +
                                  order.store.state +
                                  " " +
                                  order.store.zip_code
                            : "-"
                    );
                    $("#orderVendorPhoneView").html(
                        order.store.phone ? order.store.phone : "-"
                    );
                    $("#orderVendorEmailView").html(
                        order.store.email ? order.store.email : "-"
                    );
                    $("#orderCustomerNameView").html(
                        order.customer.first_name && order.customer.last_name
                            ? order.customer.first_name +
                                  " " +
                                  order.customer.last_name
                            : "-"
                    );
                    $("#orderCustomerLocationView").html(
                        order.customer.street &&
                            order.customer.city &&
                            order.customer.state &&
                            order.customer.zip_code
                            ? order.customer.street +
                                  " " +
                                  order.customer.city +
                                  " " +
                                  order.customer.state +
                                  " " +
                                  order.customer.zip_code
                            : "-"
                    );
                    $("#orderCustomerPhoneView").html(
                        order.customer.phone ? order.customer.phone : "-"
                    );
                    $("#orderCustomerEmailView").html(
                        order.customer.email ? order.customer.email : "-"
                    );
                    $("#orderRequiredDateView").html(
                        order.required_date
                            ? moment(order.required_date).format("DD/MM/YYYY")
                            : "-"
                    );
                    $("#orderShippedDateView").html(
                        order.shipped_date
                            ? moment(order.shipped_date).format("DD/MM/YYYY")
                            : "-"
                    );
                    generateDataTableOrderItems();
                    orderItemProperties("view", _id);
                    $("#orderViewModal").modal();
                },
                error: (error) => {
                    console.log(error);
                },
            });
            break;
    }
};

const generateOptionInput = () => {
    $("#orderStoreId").empty();
    $.each(liste_stores, (k, v) => {
        $("#orderStoreId").append(
            $('<option value="' + v.store_id + '">').html(v.store_name)
        );
    });
    $.each(liste_staffs, (k, v) => {
        // console.log(v);
        $("#orderStaffId").append(
            $('<option value="' + v.staff_id + '">').html(
                v.first_name + " " + v.last_name
            )
        );
    });
};

$(() => {
    // datatable
    liste_orders = $("#liste_orders").DataTable({
        order: [[0, "desc"]],
        ajax: "listOrder",
        columns: [
            {
                data: "order_id",
                render: (data, type, row, meta) => {
                    // console.log(data);
                    return $("<span>")
                        .addClass("btn btn-secondary btn-sm")
                        .html(
                            data === "" ? $("<i>").html("non renseigné") : data
                        )
                        .attr(
                            "onClick",
                            "orderProperties('view','" + row.order_id + "');"
                        )[0].outerHTML;
                },
            },
            {
                data: "order_status",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "order_date",
                render: (data, type, row, meta) => {
                    return data != null
                        ? moment(data).format("DD/MM/YYYY")
                        : "-";
                },
            },
            {
                data: "required_date",
                render: (data, type, row, meta) => {
                    return data != null
                        ? moment(data).format("DD/MM/YYYY")
                        : "-";
                },
            },
            {
                data: "shipped_date",
                render: (data, type, row, meta) => {
                    return data != null
                        ? moment(data).format("DD/MM/YYYY")
                        : "-";
                },
            },
            {
                data: "customer.first_name",
                render: (data, type, row, meta) => {
                    return data != null
                        ? data + " " + row.customer.last_name
                        : "-";
                },
            },
            {
                data: "store.store_name",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "staff.first_name",
                render: (data, type, row, meta) => {
                    return data != null
                        ? data + " " + row.staff.last_name
                        : "-";
                },
            },
        ],
    });

    $.ajax({
        type: "get",
        url: "indexOrder",
        dataType: "json",
        success: (json) => {
            // console.log(json);
            liste_customers = json.customers;
            liste_stores = json.stores;
            liste_staffs = json.staffs;
        },
        error: (error) => {
            console.log(error);
        },
    });

    $("#addOrder").click(() => {
        orderProperties("new");
    });
    $("#orderBtnSave").click(() => {
        orderProperties("save");
    });
    $("#orderViewModal .btn-warning").click(() => {
        orderProperties("edit");
    });
    $("#orderViewModal .btn-danger").click(() => {
        orderProperties("delete");
    });
    $("#orderFakeCustomerName").click(() => {
        $("#customerSelectModal").modal();
    });
});
