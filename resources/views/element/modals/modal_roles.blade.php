<div id="roleModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouveau role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="roleForm" action="test" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="role_id" class="form-control" id="roleId">
                    <label for="code">Code</label>
                    <input type="text" name="code" class="form-control" id="roleCode" required>
                    <br>
                    <label for="name">Nom</label>
                    <input type="text" name="name" class="form-control" id="roleName" required>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Sauvegarder</button>
            </div>
        </div>
    </div>
</div>