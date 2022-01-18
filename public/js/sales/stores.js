var store;
var store_form;
var store_modal;
var liste_stores;

const storeProperties = (action, _id) => {
    switch (action) {
        case "new":
            store_form = $("#storeForm");
            $("#storeId").val("");
            store_form[0].reset();

            $("#storeModal").modal();
            break;

        case "edit":
            console.log("edit");
            store_form = $("#storeForm");
            $.ajax({
                url: "viewStore/" + _id,
                type: "GET",
                dataType: "json",
                success: (json) => {
                    console.log(json);
                    store = json;

                    $("#storeId").val(store.store_id);
                    $("#storeName").val(store.store_name);
                    $("#storePhone").val(store.phone);
                    $("#storeEmail").val(store.email);
                    $("#storeStreet").val(store.street);
                    $("#storeCity").val(store.city);
                    $("#storeState").val(store.state);
                    $("#storeZipCode").val(store.zip_code);

                    $("#storeModal").modal();
                },
                error: (error) => {
                    console.log(error);
                },
            });
            break;

        case "save":
            var formData = new FormData(store_form[0]);
            console.log(store_form[0]);
            console.log(formData);
            $.ajax({
                url: "saveStore",
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
                        liste_stores.ajax.reload();
                        $("#storeModal").modal("hide");
                    }
                },
                error: (error) => {
                    console.log(error);
                },
            });
            break;

        case "delete":
            $.ajax({
                url: "deleteStore/" + _id,
                type: "POST",
                cache: false,
                headers: {
                    "X-CSRF-Token": crsf_token,
                },
                dataType: "json",
                success: (json) => {
                    console.log(json);
                    if (json.status === 0) {
                        liste_stores.ajax.reload();
                    }
                },
                error: (error) => {
                    console.log(error);
                    // swal("Erreur!", "Impossible de supprimer la NIP", "error");
                },
            });
            break;

        case "view":
            console.log("guest_" + _id);
            break;
    }
};

$(() => {
    // datatable
    liste_stores = $("#liste_stores").DataTable({
        store: [[0, "desc"]],
        ajax: "listStore",
        columns: [
            {
                data: "store_id",
                render: (data, type, row, meta) => {
                    // console.log(data);
                    return $("<span>")
                        .addClass("btn btn-secondary btn-sm")
                        .html(
                            data === "" ? $("<i>").html("non renseigné") : data
                        )
                        .attr(
                            "onClick",
                            "storeProperties('view','" + row.id + "');"
                        )[0].outerHTML;
                },
            },
            {
                data: "store_name",
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
                data: "store_id",
                render: (data, type, row) => {
                    var edit = $("<button>")
                        .attr("class", "btn btn-info btn-sm my-1")
                        .attr(
                            "onClick",
                            "storeProperties('edit'," + row.store_id + ")"
                        )
                        .html(
                            $("<i>").addClass("fas fa-fw fa-edit")
                        )[0].outerHTML;

                    var del = $("<button>")
                        .attr("class", "btn btn-danger btn-sm")
                        .attr(
                            "onClick",
                            "storeProperties('delete'," + row.store_id + ")"
                        )
                        .html(
                            $("<i>").addClass("fas fa-fw fa-backspace")
                        )[0].outerHTML;

                    return edit + "&nbsp;" + del;
                },
            },
        ],
    });

    $("#addStore").click(() => {
        storeProperties("new");
    });

    $("#storeModal .btn-primary").click(() => {
        storeProperties("save");
    });
});
