var product;
var productSelect;
var product_form;
var product_modal;
var liste_products;
var liste_products_select;
var liste_brands;
var liste_categories;

const productProperties = (action, _id) => {
    switch (action) {
        case "new":
            product_form = $("#productForm");
            $("#productId").val("");
            product_form[0].reset();
            productGenerateOptionInput();

            $("#productModal").modal();
            break;

        case "edit":
            console.log("edit");
            product_form = $("#productForm");
            $.ajax({
                url: "viewProduct/" + _id,
                type: "GET",
                dataType: "json",
                success: (json) => {
                    console.log(json);
                    product = json;
                    productGenerateOptionInput();

                    $("#productId").val(product.product_id);
                    $("#productName").val(product.product_name);
                    $("#productModelYear").val(product.model_year);
                    $("#productListPrice").val(product.list_price);
                    $("#productBrandId").val(product.brand_id);
                    $("#productCategoryId").val(product.category_id);

                    $("#productModal").modal();
                },
                error: (error) => {
                    console.log(error);
                },
            });
            break;

        case "save":
            var formData = new FormData(product_form[0]);
            console.log(product_form[0]);
            console.log(formData);
            $.ajax({
                url: "saveProduct",
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
                        liste_products.ajax.reload();
                        $("#productModal").modal("hide");
                    }
                },
                error: (error) => {
                    console.log(error);
                },
            });
            break;

        case "delete":
            $.ajax({
                url: "deleteProduct/" + _id,
                type: "POST",
                cache: false,
                headers: {
                    "X-CSRF-Token": crsf_token,
                },
                dataType: "json",
                success: (json) => {
                    console.log(json);
                    if (json.status === 0) {
                        liste_products.ajax.reload();
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
                type: "GET",
                url: "viewProduct/" + _id,
                dataType: "json",
                success: function (json) {
                    console.log(json);
                    productSelect = json;
                    $("#orderItemProductId").val(productSelect.product_id);
                    $("#orderItemFakeProductName").val(
                        productSelect.product_name
                    );
                    $("#orderItemQuantity").val(1);
                    $("#orderItemDiscount").val(0);
                    $("#orderItemListPrice").val(productSelect.list_price);
                    $("#orderItemTotal").val(productSelect.list_price);
                    $("#productSelectModal").modal("hide");
                    console.log($("#orderItemQuantity").val());
                },
            });
            break;
    }
};

const productGenerateOptionInput = () => {
    $.each(liste_brands, (k, v) => {
        $("#productBrandId").append(
            $('<option value="' + v.brand_id + '">').html(v.brand_name)
        );
    });

    $.each(liste_categories, (k, v) => {
        $("#productCategoryId").append(
            $('<option value="' + v.category_id + '">').html(v.category_name)
        );
    });
};

$(() => {
    // datatable
    liste_products = $("#liste_products").DataTable({
        order: [[0, "desc"]],
        ajax: "listProduct",
        // pagingType: "full_numbers",
        columns: [
            {
                data: "product_id",
                render: (data, type, row, meta) => {
                    // console.log(data);
                    return $("<span>")
                        .addClass("btn btn-secondary btn-sm")
                        .html(
                            data === "" ? $("<i>").html("non renseigné") : data
                        )
                        .attr(
                            "onClick",
                            "productProperties('view','" + row.id + "');"
                        )[0].outerHTML;
                },
            },
            {
                data: "product_name",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "model_year",
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
                data: "brand.brand_name",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "category.category_name",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "product_id",
                render: (data, type, row) => {
                    var edit = $("<button>")
                        .attr("class", "btn btn-info btn-sm my-1")
                        .attr(
                            "onClick",
                            "productProperties('edit'," + row.product_id + ")"
                        )
                        .html(
                            $("<i>").addClass("fas fa-fw fa-edit")
                        )[0].outerHTML;

                    var del = $("<button>")
                        .attr("class", "btn btn-danger btn-sm")
                        .attr(
                            "onClick",
                            "productProperties('delete'," + row.product_id + ")"
                        )
                        .html(
                            $("<i>").addClass("fas fa-fw fa-backspace")
                        )[0].outerHTML;

                    return edit + "&nbsp;" + del;
                },
            },
        ],
    });

    liste_products_select = $("#liste_products_select").DataTable({
        order: [[0, "desc"]],
        ajax: "listProduct",
        columns: [
            {
                data: "product_name",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "brand.brand_name",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "category.category_name",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "model_year",
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
                data: "product_id",
                render: (data, type, row) => {
                    return (edit = $("<button>")
                        .attr("class", "btn btn-success btn-sm my-1")
                        .attr(
                            "onClick",
                            "productProperties('select'," + row.product_id + ")"
                        )
                        .html(
                            $("<i>").addClass("fas fa-fw fa-mouse-pointer")
                        )[0].outerHTML);
                },
            },
        ],
    });

    $.ajax({
        type: "get",
        url: "indexProduct",
        dataType: "json",
        success: (json) => {
            console.log(json);
            liste_brands = json.brands;
            liste_categories = json.categories;
        },
        error: (error) => {
            console.log(error);
        },
    });

    $("#addProduct").click(() => {
        productProperties("new");
    });

    $("#productModal .btn-primary").click(() => {
        productProperties("save");
    });
});
