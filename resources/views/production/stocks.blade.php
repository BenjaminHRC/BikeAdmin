@extends('layouts.default')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card shadow">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Liste des stocks</h6>
                <span id="addStock" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Nouveau</span>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered w-100" id="liste_stocks">
                <thead>
                    <tr>
                        <th>Magasin</th>
                        <th>Produit</th>
                        <th>Quantité</th>
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
@include('element.modals.modal_stocks')
<!-- @include('element.modals.modal_products') -->
<!-- End of Include modals -->
@endsection

@push('scripts')
<script src="js/production/stocks.js"></script>
<!-- <script src="js/production/products.js"></script> -->
@endpush