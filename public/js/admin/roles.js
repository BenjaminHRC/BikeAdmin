let role;
let role_form;
let role_modal;
let liste_roles;

const roleProperties = (action, _id) => {
    switch (action) {
        case "new":
            role_form = $("#roleForm");
            role_form[0].reset();
            $("#roleId").val("");
            $("#roleModal").modal();
            break;

        case "edit":
            console.log(_id);
            console.log("edit");
            $.ajax({
                url: "viewRole/" + _id,
                type: "GET",
                dataType: "json",
                success: (json) => {
                    console.log(json);
                    role = json;

                    $("#roleId").val(role.role_id);
                    $("#roleCode").val(role.code);
                    $("#roleName").val(role.name);

                    $("#roleModal").modal();
                },
                error: (error) => {
                    console.log(error);
                },
            });
            break;

        case "save":
            role_form = $("#roleForm");
            let formData = new FormData(role_form[0]);
            $.ajax({
                url: "saveRole",
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
                        liste_roles.ajax.reload();
                        $("#roleModal").modal("hide");
                    }
                },
                error: (error) => {
                    console.log(error);
                },
            });
            break;

        case "delete":
            $.ajax({
                url: "deleteRole/" + _id,
                type: "POST",
                cache: false,
                headers: {
                    "X-CSRF-Token": crsf_token,
                },
                dataType: "json",
                success: (json) => {
                    console.log(json);
                    if (json.status == 0) {
                        liste_roles.ajax.reload();
                        $("#roleModal").modal("hide");
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

$(() => {
    // datatable
    liste_roles = $("#liste_roles").DataTable({
        order: [[0, "asc"]],
        ajax: "listRole",
        columns: [
            {
                data: "role_id",
                render: (data, type, row, meta) => {
                    return data != null ? data : "";
                },
            },
            {
                data: "code",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "name",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "role_id",
                render: (data, type, row, meta) => {
                    let edit = $("<button>")
                        .attr("class", "btn btn-info btn-sm")
                        .attr(
                            "onClick",
                            "roleProperties('edit'," + row.role_id + ")"
                        )
                        .html(
                            $("<i>").addClass("fas fa-fw fa-edit")
                        )[0].outerHTML;

                    let del = $("<button>")
                        .attr("class", "btn btn-danger btn-sm")
                        .attr(
                            "onClick",
                            "roleProperties('delete'," + row.role_id + ")"
                        )
                        .html(
                            $("<i>").addClass("fas fa-fw fa-backspace")
                        )[0].outerHTML;

                    return edit + "&nbsp;" + del;
                },
            },
        ],
    });

    $("#addRole").click(() => {
        roleProperties("new");
    });

    $("#roleModal .btn-primary").click(() => {
        roleProperties("save");
    });
});
