let staff;
let staff_form;
let staff_modal;
let liste_staffs;
let liste_stores;
let liste_managers;

const staffProperties = (action, _id) => {
    switch (action) {
        case "new":
            staff_form = $("#staffForm");
            $("#staffId").val("");
            staff_form[0].reset();
            generateOptionInput();

            $("#staffModal").modal();
            break;

        case "edit":
            console.log("edit");
            staff_form = $("#staffForm");
            $.ajax({
                url: "viewStaff/" + _id,
                type: "GET",
                dataType: "json",
                success: (json) => {
                    console.log(json);
                    staff = json;
                    generateOptionInput();

                    $("#staffId").val(staff.staff_id);
                    $("#staffFirstName").val(
                        staff.first_name ? staff.first_name : ""
                    );
                    $("#staffLastName").val(
                        staff.last_name ? staff.last_name : ""
                    );
                    $("#staffEmail").val(staff.email ? staff.email : "");
                    $("#staffPhone").val(staff.phone ? staff.phone : "");
                    $("#staffActive").prop("checked", staff.active);
                    $("#staffStoreId").val(
                        staff.store_id ? staff.store_id : ""
                    );
                    $("#staffManagerId").val(
                        staff.manager_id ? staff.manager_id : ""
                    );

                    $("#staffModal").modal();
                },
                error: (error) => {
                    console.log(error);
                },
            });
            break;

        case "save":
            let formData = new FormData(staff_form[0]);
            console.log(staff_form[0]);
            console.log(formData);
            $.ajax({
                url: "saveStaff",
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
                        liste_staffs.ajax.reload();
                        $("#staffModal").modal("hide");
                    }
                },
                error: (error) => {
                    console.log(error);
                },
            });
            break;

        case "delete":
            $.ajax({
                url: "deleteStaff/" + _id,
                type: "POST",
                cache: false,
                headers: {
                    "X-CSRF-Token": crsf_token,
                },
                dataType: "json",
                success: (json) => {
                    console.log(json);
                    if (json.status === 0) {
                        liste_staffs.ajax.reload();
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

const generateOptionInput = () => {
    console.log(liste_stores);
    $("#staffStoreId").empty();
    $("#staffManagerId").empty();
    $.each(liste_stores, (k, v) => {
        $("#staffStoreId").append(
            $('<option value="' + v.store_id + '">').html(v.store_name)
        );
    });
    $.each(liste_managers, (k, v) => {
        $("#staffManagerId").append(
            $('<option value="' + v.staff_id + '">').html(
                v.first_name + " " + v.last_name
            )
        );
    });
};

$(() => {
    // datatable
    liste_staffs = $("#liste_staffs").DataTable({
        staff: [[0, "desc"]],
        ajax: "listStaff",
        columns: [
            {
                data: "staff_id",
                render: (data, type, row, meta) => {
                    // console.log(data);
                    return $("<span>")
                        .addClass("btn btn-secondary btn-sm")
                        .html(
                            data === "" ? $("<i>").html("non renseigné") : data
                        )
                        .attr(
                            "onClick",
                            "staffProperties('view','" + row.id + "');"
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
                data: "email",
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
                data: "active",
                render: (data, type, row, meta) => {
                    return data == 1
                        ? $('<span style="color:#198754;">').append(
                              $('<i class="fas fa-fw fa-check"></i>')
                          )[0].outerHTML
                        : $('<span style="color:#dc3545;">').append(
                              $('<i class="fas fa-fw fa-remove"></i>')
                          )[0].outerHTML;
                },
            },
            {
                data: "store.store_name",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "manager_id",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "id",
                render: (data, type, row) => {
                    let edit = $("<button>")
                        .attr("class", "btn btn-info btn-sm my-1")
                        .attr(
                            "onClick",
                            "staffProperties('edit'," + row.staff_id + ")"
                        )
                        .html(
                            $("<i>").addClass("fas fa-fw fa-edit")
                        )[0].outerHTML;

                    let del = $("<button>")
                        .attr("class", "btn btn-danger btn-sm")
                        .attr(
                            "onClick",
                            "staffProperties('delete'," + row.staff_id + ")"
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
        url: "indexStaff",
        dataType: "json",
        success: (json) => {
            console.log(json);
            liste_stores = json.stores;
            liste_managers = json.managers;
        },
        error: (error) => {
            console.log(error);
        },
    });

    $("#addStaff").click(() => {
        staffProperties("new");
    });

    $("#staffModal .btn-primary").click(() => {
        staffProperties("save");
    });
});
