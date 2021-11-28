var product;
var product_form;
var product_modal;
var liste_products;

const productProperties = (action, _id) => {
    switch (action) {

        case "new":
            product_form = $("#productForm");
            product_form[0].reset();

            $("#productModal").modal();
            break;

        case "edit":
            console.log("edit");
            $.ajax({
                url: 'viewproduct/' + _id,
                type: 'GET',
                dataType: 'json',
                success: (json) => {
                    console.log(json[0]);
                    product = json[0];

                    $("#productId").val(product.id);
                    $("#productName").val(product.name);
                    $("#productEmail").val(product.email);
                    $("#productPassword").attr("disabled", "disabled").removeAttr("required");

                    $("#productModal").modal();
                },
                error: (error) => {
                    console.log(error);
                }
            });
            break;

        case "save":
            var formData = new FormData(product_form[0]);
            console.log(product_form[0]);
            console.log(formData);
            $.ajax({
                url: 'saveProduct',
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
                        liste_products.ajax.reload();
                        $("#productModal").modal('hide');
                    }
                },
                error: (error) => {
                    console.log(error);
                }
            });
            break;

        case "delete":
            $.ajax({
                url: 'deleteProduct/' + _id,
                type: 'POST',
                cache: false,
                headers: {
                    'X-CSRF-Token': crsf_token
                },
                dataType: 'json',
                success: (json) => {
                    console.log(json);
                    if (json.status === 0) {
                        liste_products.ajax.reload();
                        // $("#productModal").modal('hide');
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

$(() => {
    // datatable
    liste_products = $("#liste_products").DataTable({
        order: [[0, "desc"]],
        ajax: "listProduct",
        processing: true,
        serverSide: true,
        // autoWidth: false,
        columns: [
            {
                data: "id", render: (data, type, row, meta) => {
                    // console.log(data);
                    return $('<span>')
                        .addClass('btn btn-secondary btn-sm')
                        .html(data === '' ? $('<i>').html('non renseigné') : data)
                        .attr('onClick', "productProperties('view','" + row.id + "');")[0].outerHTML;
                }
            },
            {
                data: "name", render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                }
            },
            {
                data: "model_year", render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                }
            },
            {
                data: "price", render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                }
            },
            {
                data: "brand_id", render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                }
            },
            {
                data: "category", render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                }
            },
            {
                data: "id",
                render: (data, type, row) => {
                    var edit = $("<button>")
                        .attr("class", "btn btn-info btn-sm")
                        .attr('onClick', "productProperties('edit'," + row.id + ")")
                        .html($("<i>").addClass("fas fa-fw fa-edit"))
                    [0].outerHTML;

                    var del = $("<button>")
                        .attr("class", "btn btn-danger btn-sm")
                        .attr('onClick', "productProperties('delete'," + row.id + ")")
                        .html($("<i>").addClass("fas fa-fw fa-backspace"))
                    [0].outerHTML;

                    return edit + "&nbsp;" + del;
                },
            }
        ]
    });

    $("#addProduct").click(() => {
        productProperties("new");
    });

    $("#productModal .btn-primary").click(() => {
        productProperties("save");
    });
});