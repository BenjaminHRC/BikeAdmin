let user;
let user_form;
let user_modal;
let liste_users;
let list_roles;

const userProperties = (action, _id) => {
    switch (action) {
        case "new":
            user_form = $("#userForm");
            user_form[0].reset();
            $("#userId").val("");
            $("#userPassword")
                .attr("required", "required")
                .removeAttr("readonly")
                .val("");
            userGenerateOptionInput();
            $("#userModal").modal();
            break;

        case "edit":
            console.log("edit");
            $.ajax({
                url: "viewUser/" + _id,
                type: "GET",
                dataType: "json",
                success: (json) => {
                    console.log(json);
                    user = json;
                    userGenerateOptionInput();
                    $("#userId").val(user.id);
                    $("#userName").val(user.name);
                    $("#userEmail").val(user.email);
                    $("#userPassword")
                        .attr("readonly", "true")
                        .val(user.password);
                    $("#userRoleId").val(user.role_id);

                    $("#userModal").modal();
                },
                error: (error) => {
                    console.log(error);
                },
            });
            break;

        case "save":
            user_form = $("#userForm");
            console.log(user_form);
            let formData = new FormData(user_form[0]);
            console.log(user_form[0]);
            console.log(formData);
            $.ajax({
                url: "saveUser",
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
                        liste_users.ajax.reload();
                        $("#userModal").modal("hide");
                    }
                },
                error: (error) => {
                    console.log(error);
                },
            });
            break;

        case "delete":
            $.ajax({
                url: "deleteUser/" + _id,
                type: "POST",
                cache: false,
                headers: {
                    "X-CSRF-Token": crsf_token,
                },
                dataType: "json",
                success: (json) => {
                    console.log(json);
                    if (json.status === 0) {
                        liste_users.ajax.reload();
                        $("#userModal").modal("hide");
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

const userGenerateOptionInput = () => {
    $("#userRoleId").empty();
    $.each(liste_roles, (k, v) => {
        $("#userRoleId").append(
            $('<option value="' + v.role_id + '">').html(v.name)
        );
    });
};

$(() => {
    // datatable
    liste_users = $("#liste_users").DataTable({
        order: [[0, "asc"]],
        ajax: "listUser",
        columns: [
            {
                data: "id",
                render: (data, type, row, meta) => {
                    console.log(data);
                    return $("<span>")
                        .addClass("btn btn-secondary btn-sm")
                        .html(
                            data === "" ? $("<i>").html("non renseigné") : data
                        )
                        .attr(
                            "onClick",
                            "userProperties('view','" + row.id + "');"
                        )[0].outerHTML;
                },
            },
            {
                data: "name",
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
                data: "role.name",
                render: (data, type, row, meta) => {
                    return data != null ? data : "-";
                },
            },
            {
                data: "id",
                render: (data, type, row) => {
                    let edit = $("<button>")
                        .attr("class", "btn btn-info btn-sm")
                        .attr(
                            "onClick",
                            "userProperties('edit'," + row.id + ")"
                        )
                        .html(
                            $("<i>").addClass("fas fa-fw fa-edit")
                        )[0].outerHTML;

                    let del = $("<button>")
                        .attr("class", "btn btn-danger btn-sm")
                        .attr(
                            "onClick",
                            "userProperties('delete'," + row.id + ")"
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
        url: "indexUser",
        dataType: "json",
        success: function (json) {
            console.log(json);
            liste_roles = json.roles;
        },
    });

    $("#addUser").click(() => {
        userProperties("new");
    });

    $("#userModal .btn-primary").click(() => {
        userProperties("save");
    });
});
