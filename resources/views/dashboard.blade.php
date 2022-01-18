@extends('layouts.default')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tableaud de bord</h1>
        <div class="d-flex justify-content-end align-items-center">
            <span id="last_year">
                <i class="fas fa-arrow-circle-left fa-lg text-gray-800"></i>
            </span>
            <span id="select_year" class="mx-1 h5 pt-1 font-weight-bold">2022</span>
            </span>
            <span id="next_year">
                <i class="fas fa-arrow-circle-right fa-lg text-gray-800"></i>
            </span>
        </div>
    </div>
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Santa Cruz Bikes (annuel)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="santa_ca"></span></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Baldwin Bikes (annuel)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="baldwin_ca"></span></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Rowlett Bikes (annuel)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="rowlett_ca"></span></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card shadow mb-5">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Top personnels</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div id="chartTopStaff"></div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card shadow mb-5">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Stocks (volume)</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div id="chartNbProduct"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card shadow">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Top produits (volume)</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div id="chartTopProduct"></div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card shadow">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Top marques (volume)</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div id="chartTopBrand"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Heading -->

</div>
<!-- /.container-fluid -->
<!-- Include modals -->

<!-- End of Include modals -->
@endsection

@push('scripts')
<!-- <script src="sb-admin/vendor/chart.js/Chart.min.js"></script> -->
<script src="my-plugins/apexChart/dist/apexcharts.min.js"></script>
<script src="js/dashboard.js"></script>
@endpush