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
            <table class="table table-bordered w-100" id="liste_orders">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Date demande</th>
                        <th>Date d'envoie</th>
                        <th>Client</th>
                        <th>Magasin</th>
                        <th>Agent</th>
                        <th>Actions</th>
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
<!-- End of Include modals -->
@endsection

@push('scripts')
<script src="js/sales/orders.js"></script>
@endpush