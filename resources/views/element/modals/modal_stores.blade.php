<div id="storeModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouveau magasin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="storeForm" action="test" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="store_id" class="form-control" id="storeId">
                    <label for="store_name">Nom</label>
                    <input type="text" name="store_name" class="form-control" id="storeName" required>
                    <br>
                    <label for="phone">Téléphone</label>
                    <input type="text" name="phone" class="form-control" id="storePhone" required>
                    <br>
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" id="storeEmail" required>
                    <br>
                    <label for="street">Rue</label>
                    <input type="text" name="street" class="form-control" id="storeStreet" required>
                    <br>
                    <label for="city">Ville</label>
                    <input type="text" name="city" class="form-control" id="storeCity" required>
                    <br>
                    <label for="state">Etat</label>
                    <input type="text" name="state" class="form-control" id="storeState" required>
                    <br>
                    <label for="zip_code">Code postal</label>
                    <input type="text" name="zip_code" class="form-control" id="storeZipCode" required>
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