<div id="staffModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouvel agent</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="staffForm" action="test" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="staff_id" class="form-control" id="staffId">
                    <label for="first_name">Prénom</label>
                    <input type="text" name="first_name" class="form-control" id="staffFirstName" required>
                    <br>
                    <label for="last_name">Nom</label>
                    <input type="text" name="last_name" class="form-control" id="staffLastName" required>
                    <br>
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" id="staffEmail" required>
                    <br>
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" class="form-control" id="staffPhone" required>
                    <br>
                    <label for="active">Active</label>
                    <input type="text" name="active" class="form-control" id="staffActive" required>
                    <br>
                    <label for="store_id">Magasin</label>
                    <select type="text" name="store_id" class="form-control" id="staffStoreId" required></select>
                    <br>
                    <label for="manager_id">Manageur</label>
                    <input type="text" name="manager_id" class="form-control" id="staffManagerId" required>
                    <br>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Sauvegarder</button>
            </div>
        </div>
    </div>
</div>