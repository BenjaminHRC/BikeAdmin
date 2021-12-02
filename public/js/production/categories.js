var category;
var category_form;
var category_modal;
var liste_categories;

const categoryProperties = (action, _id) => {
    switch (action) {

        case "new":
            category_form = $("#categoryForm");
            $("#categoryId").val('');
            category_form[0].reset();

            $("#categoryModal").modal();
            break;

        case "edit":
            console.log("edit");
            category_form = $("#categoryForm");
            $.ajax({
                url: 'viewCategory/' + _id,
                type: 'GET',
                dataType: 'json',
                success: (json) => {
                    console.log(json[0]);
                    category = json[0];

                    $("#categoryId").val(category.category_id);
                    $("#categoryName").val(category.category_name);

                    $("#categoryModal").modal();
                },
                error: (error) => {
                    console.log(error);
                }
            });
            break;

        case "save":
            var formData = new FormData(category_form[0]);
            console.log(category_form[0]);
            console.log(formData);
            $.ajax({
                url: 'saveCategory',
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
                        liste_categories.ajax.reload();
                        $("#categoryModal").modal('hide');
                    }
                },
                error: (error) => {
                    console.log(error);
                }
            });
            break;

        case "delete":
            $.ajax({
                url: 'deleteCategory/' + _id,
                type: 'POST',
                cache: false,
                headers: {
                    'X-CSRF-Token': crsf_token
                },
                dataType: 'json',
                success: (json) => {
                    console.log(json);
                    if (json.status === 0) {
                        liste_categories.ajax.reload();
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
    liste_categories = $("#liste_categories").DataTable({
        order: [[0, "desc"]],
        ajax: "listCategory",
        pagingType: "full_numbers",
        // scrollX: true,
        columns: [
            {
                data: "id", render: (data, type, row, meta) => {
                    // console.log(data);
                    return $('<span>')
                        .addClass('btn btn-secondary btn-sm')
                        .html(data === '' ? $('<i>').html('non renseigné') : data)
                        .attr('onClick', "categoryProperties('view','" + row.id + "');")[0].outerHTML;
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
                        .attr('onClick', "categoryProperties('edit'," + row.id + ")")
                        .html($("<i>").addClass("fas fa-fw fa-edit"))
                    [0].outerHTML;

                    var del = $("<button>")
                        .attr("class", "btn btn-danger btn-sm")
                        .attr('onClick', "categoryProperties('delete'," + row.id + ")")
                        .html($("<i>").addClass("fas fa-fw fa-backspace"))
                    [0].outerHTML;

                    return edit + "&nbsp;" + del;
                },
            }
        ]
    });

    $("#addCategory").click(() => {
        categoryProperties("new");
    });

    $("#categoryModal .btn-primary").click(() => {
        categoryProperties("save");
    });
});