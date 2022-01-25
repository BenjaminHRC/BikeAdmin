<div id="stockModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouveau stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="stockForm" action="test" enctype="multipart/form-data" method="post">
                    <label for="store_id">Magasin</label>
                    <select type="text" name="store_id" class="form-control" id="stockStoreId"></select>
                    <br>
                    <label for="product_id">Produit</label>
                    <select type="text" name="product_id" id="stockProductId" class="form-control"></select>
                    <br>
                    <label for="last_name">Quantité</label>
                    <input type="number" name="quantity" class="form-control" id="stockQuantity" required>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Sauvegarder</button>
            </div>
        </div>
    </div>
</div>