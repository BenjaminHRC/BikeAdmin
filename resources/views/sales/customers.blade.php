@extends('layouts.default')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card shadow">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Liste des clients</h6>
                <span id="addCustomer" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Nouveau</span>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered w-100" id="liste_customers">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Rue</th>
                        <th>Ville</th>
                        <th>Etat</th>
                        <th>Code postal</th>
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
@include('element.modals.modal_customers')
<!-- End of Include modals -->
@endsection

@push('scripts')
<script src="js/sales/customers.js"></script>
@endpush