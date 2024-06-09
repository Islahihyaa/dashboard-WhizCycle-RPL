@extends('admin-layout')

@section('title', 'WhizCycle | Kelola Kendaran')

@section('manage-driver', 'active')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
    <h1>Kelola Driver</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Driver</h5>
                        <hr>
                        <div class="text-start my-5">
                            <a href ="add-driver" name="add-driver" class="btn-custom" dusk="add-driver"><i class="bi bi-plus-circle"></i><span class="m-2">Tambah Driver</span></a>
                        </div>

                        <div class="col">
                            <table class="table datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>ID Driver</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Nomor Telephone</th>
                                    <th>Nomor Lisensi</th>
                                    <th>Kendaraan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data_driver as $data)
                                    <tr>
                                        <td scope="row">{{ $data -> driver_id }}</td>
                                        <td scope="row">
                                            <img src="{{ asset('storage/' . $data->image_driver) }}" class="profile-img" alt="Driver Image">
                                        </td>
                                        <td scope="row">{{ $data -> name_driver}}</td>
                                        <td scope="row">{{ $data -> phoneNo_driver}}</td>
                                        <td scope="row">{{ $data -> license_number }}</td>
                                        <td scope="row">{{ $data -> vehicle -> name_vehicle }}</td>
                                        <td scope="row">
                                            <a class="icon" href="{{ route('edit-driver-data', ['driver_id' => $data->driver_id] ) }}" dusk="update-driver">
                                                <i class="bi bi-pencil-fill icon-background edit-icon"></i>
                                            </a>
                                            <i class="bi bi-trash3-fill icon-background delete-icon" data-bs-toggle="modal" data-bs-target="#modal{{ $data->driver_id }}" dusk="delete-driver"></i>
                                            <form action="{{ route('data-driver.delete', ['driver_id' => $data->driver_id]) }}">
                                            @csrf
                                            @method('DELETE')
                                                <!-- Modal Trigger -->  

                                                <!-- Modal -->  
                                                <div class="modal fade" id="modal{{ $data->driver_id }}" tabindex="-1">
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
                                                            <button type="submit" class="btn btn-danger">
                                                                Hapus
                                                            </button>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div><!-- End Modal-->
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                                @if (Session::has('successDeleteDriver'))
                                    <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                                    {{ Session::get('successDeleteDriver') }}
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @elseif (Session::has('failDeleteDriver'))
                                    <div class="alert alert-warning bg-warning text-light border-0 alert-dismissible fade show" role="alert">
                                    {{ Session::get('failDeleteDriver') }}
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                @elseif(Session::has('successEditDriver'))
                                <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                                    {{ Session::get('successEditDriver') }}
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
