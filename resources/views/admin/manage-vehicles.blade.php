@extends('admin-layout')

@section('title', 'WhizCycle | Kelola Kendaran')

@section('manage-vehicles', 'active')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
    <h1>Kelola Kendaraan</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Kendaraan</h5>
                        <hr>
                        <div class="text-start my-5">
                            <a href ="add-vehicles" name="add-vehicle" class="btn-custom"><i class="bi bi-plus-circle"></i><span class="m-2">Tambah Kendaraan</span></a>
                        </div>

                        <div class="col">
                            <table class="table datatable" id="manageVehiclesTable">
                            <thead class="table-light">
                                <tr>
                                    <th>ID Kendaraan</th>
                                    <th>Nama Kendaraan</th>
                                    <th>Jenis Kendaraan</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data_vehicle as $data)
                                    <tr>
                                        <td scope="row">{{ $data -> vehicle_id }}</td>
                                        <td scope="row">{{ $data -> name_vehicle}}</td>
                                        <td scope="row">{{ $data -> category_vehicle}}</td>
                                        <td scope="row">{{ $data -> description_vehicle }}</td>
                                        <td scope="row">
                                        <div class="d-flex align-items-center">
                                            @if ($data->status_vehicle == 'Sudah Baik')
                                                <p class="fw-bolder text-status text-todo m-0">Sudah Baik</p> 
                                            @elseif ($data->status_vehicle == 'Butuh Perbaikan')
                                                <p class="fw-bolder text-status text-inprogress m-0">Butuh Perbaikan</p>
                                            @elseif ($data->status_vehicle == 'Sedang Dalam Perbaikan')
                                                <p class="fw-bolder text-status text-closed m-0">Sedang Dalam Perbaikan</p>
                                            @elseif ($data->status_vehicle == 'Tidak Dapat Digunakan')
                                                <p class="fw-bolder text-status text-notusable m-0">Tidak Dapat Digunakan</p>
                                            @endif
                                        </div>

                                        </td>
                                        <td scope="row">
                                            <div class="filter">
                                                <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots m-3"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                                    <li class="dropdown-header text-start">
                                                        <h6>Ubah Status</h6>
                                                    </li>
                                                    <form method="POST" action="{{ route('status-vehicle.update', ['vehicle_id' => $data->vehicle_id]) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="dropdown-item" name="status_vehicle" value="Sudah Baik">Sudah Baik</button>
                                                        <button type="submit" class="dropdown-item" name="status_vehicle" value="Butuh Perbaikan">Butuh Perbaikan</button>
                                                        <button type="submit" class="dropdown-item" name="status_vehicle" value="Sedang Dalam Perbaikan">Sedang Dalam Perbaikan</button>
                                                        <button type="submit" class="dropdown-item" name="status_vehicle" value="Tidak Dapat Digunakan">Tidak Dapat Digunakan</button>
                                                    </form>
                                                </ul>
                                                    <i class="bi bi-trash3-fill icon-background delete-icon" data-bs-toggle="modal" data-bs-target="#modal{{ $data->vehicle_id }}"></i>
                                                <!-- Modal -->  
                                                <div class="modal fade" id="modal{{ $data->vehicle_id }}" tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title">Konfirmasi Hapus Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                        Apakah Anda yakin menghapus data yang dipilih?
                                                        </div>
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <a class="btn btn-danger" href="{{ route('data-vehicle.delete', ['vehicle_id' => $data->vehicle_id]) }}">
                                                            Hapus
                                                        </a>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div><!-- End Modal-->
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                                @if (Session::has('successDeleteVehicle'))
                                    <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                                    {{ Session::get('successDeleteVehicle') }}
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @elseif (Session::has('failDeleteVehicle'))
                                    <div class="alert alert-warning bg-warning text-light border-0 alert-dismissible fade show" role="alert">
                                    {{ Session::get('failDeleteVehicle') }}
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @elseif (session('updateStatusVehicle'))
                                    <div class="alert alert-primary bg-primary text-light border-0 alert-dismissible fade show" role="alert">
                                    {{ Session::get('updateStatusVehicle') }}
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                            </table>
                        </div>
                    
                    
                    </div>
                
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection
