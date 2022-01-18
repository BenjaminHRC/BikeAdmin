<div id="userModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouvel utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="userForm" action="test" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="id" class="form-control" id="userId">
                    <label for="name">Nom</label>
                    <input type="text" name="name" class="form-control" id="userName" required>
                    <br>
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="userEmail" required>
                    <br>
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" class="form-control" id="userPassword" required>
                    <br>
                    <label for="role_id"></label>
                    <select name="role_id" id="userRoleId" class="form-control"></select>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Sauvegarder</button>
            </div>
        </div>
    </div>
</div>