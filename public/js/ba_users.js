var user;
var user_form;
var user_modal;
var liste_users;

function userProperties(action, _id) {
    switch (action) {

        case "new":
            user_form = $("#userForm");
            user_form[0].reset();
            $("#userPassword").attr("required", "required").removeAttr("disabled").val("");
            $("#userModal").modal();
            break;

        case "edit":
            console.log("edit");
            $.ajax({
                url: 'viewUser/' + _id,
                type: 'GET',
                dataType: 'json',
                success: function (json) {
                    console.log(json[0]);
                    user = json[0];

                    $("#userId").val(user.id);
                    $("#userName").val(user.name);
                    $("#userEmail").val(user.email);
                    $("#userPassword").attr("disabled", "disabled").removeAttr("required");

                    $("#userModal").modal();
                },
                error: function (error) {
                    console.log(error);
                }
            });
            break;

        case "save":
            var formData = new FormData(user_form[0]);
            console.log(user_form[0]);
            console.log(formData);
            $.ajax({
                url: 'saveUser',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': crsf_token
                },
                success: function (json) {
                    console.log(json);
                    if (json.status == 0) {
                        liste_users.ajax.reload();
                        $("#userModal").modal('hide');
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
            break;

        case "delete":
            $.ajax({
                url: 'deleteUser/' + _id,
                type: 'POST',
                cache: false,
                headers: {
                    'X-CSRF-Token': crsf_token
                },
                dataType: 'json',
                success: function (json) {
                    console.log(json);
                    if (json.status === 0) {
                        liste_users.ajax.reload();
                        $("#userModal").modal('hide');
                    }
                },
                error: function (error) {
                    console.log(error);
                    // swal("Erreur!", "Impossible de supprimer la NIP", "error");
                }
            });
            break;

        case "connect":
            var formData = new FormData($("#")[0]);
            $.ajax({
                type: "POST",
                url: "loginConnexion",
                // data: "data",
                dataType: "dataType",
                success: function (response) {
                    
                }
            });
            break;
    }
}

$(function () {
    // datatable
    liste_users = $("#liste_users").DataTable({
        order: [[0, "asc"]],
        ajax: "listeUser",
        processing: true,
        serverSide: true,
        // autoWidth: false,
        columns: [
            {
                data: "id", render: function (data, type, row, meta) {
                    console.log(data);
                    return $('<span>')
                        .addClass('btn btn-secondary btn-sm')
                        .html(data === '' ? $('<i>').html('non renseigné') : data)
                        .attr('onClick', "nipProperties('view','" + row.id + "');")[0].outerHTML;
                }
            },
            {
                data: "name", render: function (data, type, row, meta) {
                    return data != null ? data : "-";
                }
            },
            {
                data: "email", render: function (data, type, row, meta) {
                    return data != null ? data : "-";
                }
            },
            {
                data: "id",
                render: function (data, type, row) {
                    var edit = $("<button>")
                        .attr("class", "btn btn-info btn-sm")
                        .attr('onClick', "userProperties('edit'," + row.id + ")")
                        .html($("<i>").addClass("bi bi-pencil-square"))
                    [0].outerHTML;

                    var del = $("<button>")
                        .attr("class", "btn btn-danger btn-sm")
                        .attr('onClick', "userProperties('delete'," + row.id + ")")
                        .html($("<i>").addClass("bi bi-x-square"))
                    [0].outerHTML;

                    return edit + "&nbsp;" + del;
                },
            }
        ]
    });

    $("#addUser").click(function () {
        userProperties("new");
    });

    $("#userModal .btn-primary").click(function () {
        userProperties("save");
    });
});