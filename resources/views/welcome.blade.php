@extends('layouts.default')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card shadow">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Utilisateurs</h6>
                <span id="addUser" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Nouvel</span>
            </div>
        </div>
        <div class="card-body">
            <!-- <div class="table-responsive"> -->
            <table class="table table-bordered w-100" id="liste_users">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <!-- </div> -->
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<!-- Include modals -->
@include('element.modal_users')
<!-- End of Include modals -->
@endsection

@push('scripts')
<script src="js/ba_users.js"></script>
@endpush