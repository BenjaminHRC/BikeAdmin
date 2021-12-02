var brand;
var brand_form;
var brand_modal;
var liste_brands;

const brandProperties = (action, _id) => {
    switch (action) {

        case "new":
            brand_form = $("#brandForm");
            $("#brandId").val('');
            brand_form[0].reset();

            $("#brandModal").modal();
            break;

        case "edit":
            console.log("edit");
            brand_form = $("#brandForm");
            $.ajax({
                url: 'viewBrand/' + _id,
                type: 'GET',
                dataType: 'json',
                success: (json) => {
                    console.log(json[0]);
                    brand = json[0];

                    $("#brandId").val(brand.brand_id);
                    $("#brandName").val(brand.brand_name);

                    $("#brandModal").modal();
                },
                error: (error) => {
                    console.log(error);
                }
            });
            break;

        case "save":
            var formData = new FormData(brand_form[0]);
            console.log(brand_form[0]);
            console.log(formData);
            $.ajax({
                url: 'saveBrand',
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
                        liste_brands.ajax.reload();
                        $("#brandModal").modal('hide');
                    }
                },
                error: (error) => {
                    console.log(error);
                }
            });
            break;

        case "delete":
            $.ajax({
                url: 'deleteBrand/' + _id,
                type: 'POST',
                cache: false,
                headers: {
                    'X-CSRF-Token': crsf_token
                },
                dataType: 'json',
                success: (json) => {
                    console.log(json);
                    if (json.status === 0) {
                        liste_brands.ajax.reload();
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
    liste_brands = $("#liste_brands").DataTable({
        order: [[0, "desc"]],
        ajax: "listBrand",
        pagingType: "full_numbers",
        // scrollX: true,
        columns: [
            {
                data: "id", render: (data, type, row, meta) => {
                    // console.log(data);
                    return $('<span>')
                        .addClass('btn btn-secondary btn-sm')
                        .html(data === '' ? $('<i>').html('non renseigné') : data)
                        .attr('onClick', "brandProperties('view','" + row.id + "');")[0].outerHTML;
                }
            },
            {
                data: "name", render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                }
            },
            {
                data: "id",
                render: (data, type, row) => {
                    var edit = $("<button>")
                        .attr("class", "btn btn-info btn-sm my-1")
                        .attr('onClick', "brandProperties('edit'," + row.id + ")")
                        .html($("<i>").addClass("fas fa-fw fa-edit"))
                    [0].outerHTML;

                    var del = $("<button>")
                        .attr("class", "btn btn-danger btn-sm")
                        .attr('onClick', "brandProperties('delete'," + row.id + ")")
                        .html($("<i>").addClass("fas fa-fw fa-backspace"))
                    [0].outerHTML;

                    return edit + "&nbsp;" + del;
                },
            }
        ]
    });

    $("#addBrand").click(() => {
        brandProperties("new");
    });

    $("#brandModal .btn-primary").click(() => {
        brandProperties("save");
    });
});