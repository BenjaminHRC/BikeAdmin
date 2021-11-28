<div id="productModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouveau produit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="productForm" action="test" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="product_id" class="form-control" id="productId">
                    <label for="brand_name">Nom</label>
                    <input type="text" name="product_name" class="form-control" id="productName" required>
                    <br>
                    <label for="model_year">Année du modèle</label>
                    <input type="text" name="model_year" class="form-control" id="productModelYear" required>
                    <br>
                    <label for="list_price">Prix</label>
                    <input type="text" name="list_price" class="form-control" id="productListPrice" required>
                    <br>
                    <label for="brand_id">brand_id *tmp*</label>
                    <input type="text" name="brand_id" class="form-control" id="productBrandId" required>
                    <br>
                    <label for="category_id">category_id *tmp*</label>
                    <input type="text" name="category_id" class="form-control" id="productCategoryId" required>
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