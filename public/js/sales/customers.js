var customer;
var customer_form;
var customer_modal;
var liste_customers;
var liste_customers_select;

const customerProperties = (action, _id) => {
    switch (action) {
        case "new":
            $("#customerModal .modal-title").html("Nouveau client");
            customer_form = $("#customerForm");
            $("#customerId").val("");
            customer_form[0].reset();

            $("#customerModal").modal();
            break;

        case "edit":
            console.log("edit");
            customer_form = $("#customerForm");
            $.ajax({
                url: "viewCustomer/" + _id,
                type: "GET",
                dataType: "json",
                success: (json) => {
                    console.log(json);
                    customer = json;
                    $("#customerModal .modal-title").html(
                        customer.first_name + " " + customer.last_name
                    );
                    $("#customerId").val(customer.customer_id);
                    $("#customerFirstName").val(customer.first_name);
                    $("#customerLastName").val(customer.last_name);
                    $("#customerPhone").val(customer.phone);
                    $("#customerEmail").val(customer.email);
                    $("#customerStreet").val(customer.street);
                    $("#customerCity").val(customer.city);
                    $("#customerState").val(customer.state);
                    $("#customerZipCode").val(customer.zip_code);

                    $("#customerModal").modal();
                },
                error: (error) => {
                    console.log(error);
                },
            });
            break;

        case "save":
            var formData = new FormData(customer_form[0]);
            console.log(customer_form[0]);
            console.log(formData);
            $.ajax({
                url: "saveCustomer",
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
                    if (json.status == 0) {
                        liste_customers.ajax.reload();
                        $("#customerModal").modal("hide");
                    }
                },
                error: (error) => {
                    console.log(error);
                },
            });
            break;

        case "delete":
            $.ajax({
                url: "deleteCustomer/" + _id,
                type: "POST",
                cache: false,
                headers: {
                    "X-CSRF-Token": crsf_token,
                },
                dataType: "json",
                success: (json) => {
                    console.log(json);
                    if (json.status === 0) {
                        liste_customers.ajax.reload();
                    }
                },
                error: (error) => {
                    console.log(error);
                    // swal("Erreur!", "Impossible de supprimer la NIP", "error");
                },
            });
            break;

        case "select":
            $.ajax({
                url: "viewCustomer/" + _id,
                type: "GET",
                dataType: "json",
                success: (json) => {
                    console.log(json);
                    $("#orderCustomerId").val(json.customer_id);
                    $("#orderFakeCustomerName").val(
                        json.first_name + " " + json.last_name
                    );
                    $("#customerSelectModal").modal("hide");
                },
                error: (error) => {
                    console.log(error);
                },
            });
            break;
    }
};

$(() => {
    // datatable
    liste_customers = $("#liste_customers").DataTable({
        customer: [[0, "desc"]],
        ajax: "listCustomer",
        columns: [
            {
                data: "customer_id",
                render: (data, type, row, meta) => {
                    // console.log(data);
                    return $("<span>")
                        .addClass("btn btn-secondary btn-sm")
                        .html(
                            data === "" ? $("<i>").html("non renseigné") : data
                        )
                        .attr(
                            "onClick",
                            "customerProperties('view','" + data + "');"
                        )[0].outerHTML;
                },
            },
            {
                data: "first_name",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "last_name",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "phone",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "email",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "street",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "city",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "state",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "zip_code",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "customer_id",
                render: (data, type, row) => {
                    console.log(row);
                    var edit = $("<button>")
                        .attr("class", "btn btn-info btn-sm my-1")
                        .attr(
                            "onClick",
                            "customerProperties('edit'," + data + ")"
                        )
                        .html(
                            $("<i>").addClass("fas fa-fw fa-edit")
                        )[0].outerHTML;

                    var del = $("<button>")
                        .attr("class", "btn btn-danger btn-sm")
                        .attr(
                            "onClick",
                            "customerProperties('delete'," + data + ")"
                        )
                        .html(
                            $("<i>").addClass("fas fa-fw fa-backspace")
                        )[0].outerHTML;

                    return edit + "&nbsp;" + del;
                },
            },
        ],
    });

    liste_customers_select = $("#liste_customers_select").DataTable({
        customer: [[0, "desc"]],
        ajax: "listCustomer",
        columns: [
            {
                data: "customer_id",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "first_name",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "last_name",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "phone",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "email",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "street",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "city",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "state",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "zip_code",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "customer_id",
                render: (data, type, row) => {
                    // console.log(row);
                    var edit = $("<span>")
                        .attr("class", "btn btn-success btn-sm my-1")
                        .attr(
                            "onClick",
                            "customerProperties('select'," +
                                row.customer_id +
                                ")"
                        )
                        .html(
                            $("<i>").addClass("fas fa-fw fa-mouse-pointer")
                        )[0].outerHTML;

                    var del = $("<span>")
                        .attr("class", "btn btn-info btn-sm")
                        .attr(
                            "onClick",
                            "customerProperties('edit'," + row.id + ")"
                        )
                        .html(
                            $("<i>").addClass("fas fa-fw fa-edit")
                        )[0].outerHTML;

                    return edit + "&nbsp;" + del;
                },
            },
        ],
    });

    $("#addCustomer").click(() => {
        customerProperties("new");
    });

    $("#customerModal .btn-primary").click(() => {
        customerProperties("save");
    });
});
