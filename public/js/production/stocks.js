let stock;
let stock_form;
let stock_modal;
let liste_stocks;
let liste_stores;
let liste_products;

const stockProperties = (action, _store_id, _product_id) => {
    switch (action) {
        case "new":
            $("#stockModal .modal-title").html("Nouveau stock");
            stock_form = $("#stockForm");
            $("#stockId").val("");
            stock_form[0].reset();
            stockGenerateOptionInput();

            $("#stockModal").modal();
            break;

        case "edit":
            console.log("edit");
            stock_form = $("#stockForm");
            $.ajax({
                url: "viewStock/" + _store_id + "/" + _product_id,
                type: "GET",
                dataType: "json",
                success: (json) => {
                    console.log(json);
                    stock = json;
                    $("#stockModal .modal-title").html(
                        stock.store.store_name +
                            " / " +
                            stock.product.product_name
                    );
                    stockGenerateOptionInput();

                    $("#stockStoreId").val(stock.store_id);
                    $("#stockProductId").val(stock.product_id);
                    $("#stockQuantity").val(stock.quantity);

                    $("#stockModal").modal();
                },
                error: (error) => {
                    console.log(error);
                },
            });
            break;

        case "save":
            let formData = new FormData(stock_form[0]);
            console.log(stock_form[0]);
            console.log(formData);
            $.ajax({
                url: "saveStock",
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
                        liste_stocks.ajax.reload();
                        $("#stockModal").modal("hide");
                    }
                },
                error: (error) => {
                    console.log(error);
                },
            });
            break;

        case "delete":
            $.ajax({
                url: "deleteStock/" + _store_id + "/" + _product_id,
                type: "POST",
                cache: false,
                headers: {
                    "X-CSRF-Token": crsf_token,
                },
                dataType: "json",
                success: (json) => {
                    console.log(json);
                    if (json.status === 0) {
                        liste_stocks.ajax.reload();
                    }
                },
                error: (error) => {
                    console.log(error);
                    // swal("Erreur!", "Impossible de supprimer la NIP", "error");
                },
            });
            break;
    }
};

const stockGenerateOptionInput = () => {
    $.each(liste_stores, (k, v) => {
        $("#stockStoreId").append(
            $('<option value="' + v.store_id + '">').html(v.store_name)
        );
    });

    $.each(liste_products, (k, v) => {
        $("#stockProductId").append(
            $('<option value="' + v.product_id + '">').html(v.product_name)
        );
    });
};

$(() => {
    // datatable
    liste_stocks = $("#liste_stocks").DataTable({
        order: [[0, "desc"]],
        ajax: "listStock",
        // pagingType: "full_numbers",
        columns: [
            {
                data: "store.store_name",
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
                data: "quantity",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "store_id",
                render: (data, type, row) => {
                    let edit = $("<button>")
                        .attr("class", "btn btn-info btn-sm my-1")
                        .attr(
                            "onClick",
                            "stockProperties('edit'," +
                                row.store_id +
                                ", " +
                                row.product_id +
                                ")"
                        )
                        .html(
                            $("<i>").addClass("fas fa-fw fa-edit")
                        )[0].outerHTML;

                    let del = $("<button>")
                        .attr("class", "btn btn-danger btn-sm")
                        .attr(
                            "onClick",
                            "stockProperties('delete'," +
                                row.store_id +
                                ", " +
                                row.product_id +
                                ")"
                        )
                        .html(
                            $("<i>").addClass("fas fa-fw fa-backspace")
                        )[0].outerHTML;

                    return edit + "&nbsp;" + del;
                },
            },
        ],
    });

    $.ajax({
        type: "get",
        url: "indexStock",
        dataType: "json",
        success: (json) => {
            console.log(json);
            liste_stores = json.stores;
            liste_products = json.products;
        },
        error: (error) => {
            console.log(error);
        },
    });

    $("#addStock").click(() => {
        stockProperties("new");
    });

    $("#stockModal .btn-primary").click(() => {
        stockProperties("save");
    });
});
