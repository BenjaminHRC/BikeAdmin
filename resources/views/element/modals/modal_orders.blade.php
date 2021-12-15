<div id="orderModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouvelle facture</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="orderForm" action="test" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="order_id" class="form-control" id="orderId">
                    <label for="order_date">Status</label>
                    <input type="text" name="order_date" class="form-control" id="orderDate" required>
                    <br>
                    <label for="required_date">Année du modèle</label>
                    <input type="text" name="model_year" class="form-control" id="orderModelYear" required>
                    <br>
                    <label for="list_price">Prix</label>
                    <input type="text" name="list_price" class="form-control" id="orderListPrice" required>
                    <br>
                    <label for="brand_id">Marque</label>
                    <select name="brand_id" class="form-control" id="orderBrandId" required></select>
                    <br>
                    <label for="category_id">Catégorie</label>
                    <select name="category_id" class="form-control" id="orderCategoryId" required></select>
                    <br>
                    <label for="store_id">Magasin</label>
                    <select name="store_id" class="form-control" id="orderStoreId"></select>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Sauvegarder</button>
            </div>
        </div>
    </div>
</div>