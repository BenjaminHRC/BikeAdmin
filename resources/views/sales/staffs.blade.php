@extends('layouts.default')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card shadow">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Liste des agents</h6>
                <span id="addStaff" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Nouveau</span>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered w-100" id="liste_staffs">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Active</th>
                        <th>Magasins</th>
                        <th>Manageur</th>
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
@include('element.modals.modal_staffs')
<!-- End of Include modals -->
@endsection

@push('scripts')
<script src="js/sales/staffs.js"></script>
@endpush