<div id="orderViewModal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">order</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-5">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="rotate-n-15">
                                <span style="color:#4e73df;">
                                    <i class="fas fa-fw fa-biking fa-2x"></i>
                                </span>
                            </div>
                            <div class="ml-2 d-flex align-items-center">
                                <h3 class="font-weight-bold" style="color: #4e73df;">BIKEADMIN</h3>
                            </div>
                        </div>
                        <div>
                            <h1>Facture #<span id="orderIdView" class="font-weight-bold"></span>
                            </h1>
                            <p class="text-right">Date: <span id="orderDateView" class="font-weight-bold"></span></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 p-5 align-items-center">
                            <table class="table w-100">
                                <thead class="bg-primary">
                                    <tr>
                                        <th style="color:white" class="font-weight-bold">Vendeur</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Nom: <span id="orderVendorNameView" class="font-weight-bold"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Localisation: <span id="orderStoreLocationView" class="font-weight-bold"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Numéro de téléphone: <span id="orderVendorPhoneView" class="font-weight-bold"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Email: <span id="orderVendorEmailView" class="font-weight-bold"></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-6 p-5 align-items-center">
                            <table class="table w-100">
                                <thead class="bg-primary">
                                    <tr>
                                        <th style="color:white" class="font-weight-bold">Lieux de livraison</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Nom: <span id="orderCustomerNameView" class="font-weight-bold"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Localisation: <span id="orderCustomerLocationView" class="font-weight-bold"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Numéro de téléphone: <span id="orderCustomerPhoneView" class="font-weight-bold"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Email: <span id="orderCustomerEmailView" class="font-weight-bold"></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <table id="orderTableView" class="table table-bordered table-stripped w-100">
                        <thead class="bg-primary">
                            <tr style="color:white" class="font-weight-bold">
                                <th>Date de demande</th>
                                <th>Date d'envoie</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td id="orderRequiredDateView">-</td>
                            <td id="orderShippedDateView">-</td>
                        </tbody>
                    </table>
                    <table id="orderItemView" class="table table-bordered table-stripped w-100">
                        <thead class="bg-primary">
                            <tr style="color:white" class="font-weight-bold">
                                <th>Item</th>
                                <th>Description</th>
                                <th>Quantité</th>
                                <th>Prix unitaire</th>
                                <th>Prix total</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot style="background-color:rgba(78, 115, 223, 0.1)">
                            <tr>
                                <td colspan="4" class="font-weight-bold">TOTAL HORS REDUCTION:</td>
                                <td id="orderTotalHorsReductionView" class="font-weight-bold"></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="font-weight-bold">TOTAL:</td>
                                <td id="orderTotalView" class="font-weight-bold"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning">Modifier</button>
            </div>
        </div>
    </div>
</div>

<div id="orderModal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
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
                    <input type="hidden" name="order_status" class="form-control" id="orderStatus">
                    <input type="hidden" name="order_date" class="form-control" id="orderDate">
                    <input type="hidden" name="customer_id" class="form-control" id="orderCustomerId">
                    <div id="orderItemHiddenInput"></div>
                    <div class="row">
                        <div class="col-4">
                            <label for="staff_id">Personnel</label>
                            <select name="staff_id" class="form-control" id="orderStaffId" required></select>
                        </div>
                        <div class="col-4">
                            <label for="fake_customer_name">Client</label>
                            <input name="fake_customer_name" class="form-control" id="orderFakeCustomerName" required>
                        </div>
                        <div class="col-4">
                            <label for="store_id">Magasin</label>
                            <select name="store_id" class="form-control" id="orderStoreId" required></select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="required_date">Date demandée</label>
                            <input type="date" name="required_date" class="form-control" id="orderRequiredDate" required>
                        </div>
                        <div class="col-6">
                            <label for="shipped_date">Date d'envoie</label>
                            <input type="date" name="shipped_date" class="form-control" id="orderShippedDate" required>
                        </div>
                    </div>
                    <div id="orderItemHide">
                        <div class="d-flex justify-content-end my-3">
                            <span id="addOrderItem" class="btn btn-primary">Nouvelle item</span>
                        </div>
                        <table class="table table-bordered w-100" id="liste_order_items">
                            <thead>
                                <th>Item</th>
                                <th>Produit</th>
                                <th>Prix</th>
                                <th>Réduction</th>
                                <th>Actions</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" id="orderBtnSave" class="btn btn-primary">Sauvegarder</button>
            </div>
        </div>
    </div>
</div>

<div id="orderItemModal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouveau produit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="orderItemForm" action="test" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="order_id" class="form-control" id="orderItemOrderId">
                    <input type="hidden" name="item_id" class="form-control" id="orderItemItemId">
                    <input type="hidden" name="product_id" class="form-control" id="orderItemProductId">
                    <label for="fake_product_name">Produit</label>
                    <input type="text" name="fake_product_name" class="form-control" id="orderItemFakeProductName">
                    <div class="row">
                        <div class="col-4">
                            <label for="list_price">Prix du produit</label>
                            <input type="text" readonly="true" min="1" step=".01" name="list_price" class="form-control" id="orderItemListPrice">
                        </div>
                        <div class="col-4">
                            <label for="quantity">Quantité</label>
                            <input type="number" min="1" name="quantity" class="form-control" id="orderItemQuantity">
                        </div>
                        <div class="col-4">
                            <label for="discount">Réduction</label>
                            <input type="number" min="0" max="1" step=".01" name="discount" class="form-control" id="orderItemDiscount">

                        </div>
                    </div>
                    <label for="total">Total</label>
                    <input type="text" readonly="true" min="1" name="total" class="form-control" id="orderItemTotal">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" id="orderItemBtnSave" class="btn btn-primary">Sauvegarder</button>
            </div>
        </div>
    </div>
</div>