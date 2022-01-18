@extends('layouts.default')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card shadow">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Liste des factures</h6>
                <span id="addOrder" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Nouvelle</span>
            </div>
        </div>
        <div class="card-body">

            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#one">Active</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#two">Link</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade in active" id="one">
                    <p>Tab one content</p>
                </div>
                <div class="tab-pane fade" id="two">
                    <p>Tab two content</p>
                </div>
            </div>

            <table class="table table-bordered w-100" id="liste_orders">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Date demande</th>
                        <th>Date d'envoie</th>
                        <th>Client</th>
                        <th>Magasin</th>
                        <th>Agent</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<!-- Include modals -->
@include('element.modals.modal_orders')
@include('element.modals.modal_customers')
@include('element.modals.modal_products')
<!-- End of Include modals -->
@endsection

@push('scripts')
<script src="js/sales/orders.js"></script>
<script src="js/sales/order_items.js"></script>
<script src="js/sales/customers.js"></script>
<script src="js/production/products.js"></script>
@endpush