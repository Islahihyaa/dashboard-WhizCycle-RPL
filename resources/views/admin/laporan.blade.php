@extends('admin-layout')

@section('title', 'WhizCycle | Laporan')

@section('laporan', 'active')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Laporan</h1>
    </div>
    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Cetak Laporan</h5>
                        <div class="row">
                            <!-- Top row with 3 buttons -->
                            <div class="col-md-4 col-sm-6 mb-3">
                                <a href="{{ url('/data-point') }}" class="btn-custom d-block"><i class="bi bi-plus-circle"></i><span class="m-2">Data Tukar Point</span></a>
                            </div>
                            <div class="col-md-4 col-sm-6 mb-3">
                                <a href="{{ url('/data-cs') }}" class="btn-custom d-block"><i class="bi bi-plus-circle"></i><span class="m-2">Data Customer Service</span></a>
                            </div>
                            <div class="col-md-4 col-sm-6 mb-3">
                                <a href="{{ url('/data-user') }}" class="btn-custom d-block"><i class="bi bi-plus-circle"></i><span class="m-2">Data User</span></a>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Bottom row with 2 buttons -->
                            <div class="col-md-6 col-sm-6 mb-3">
                                <a href="{{ url('/data-vehicles') }}" class="btn-custom d-block"><i class="bi bi-plus-circle"></i><span class="m-2">Data Kendaraan</span></a>
                            </div>
                            <div class="col-md-6 col-sm-6 mb-3">
                                <a href="{{ url('/data-driver') }}" class="btn-custom d-block"><i class="bi bi-plus-circle"></i><span class="m-2">Data Driver</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
