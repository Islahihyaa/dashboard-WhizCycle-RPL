@extends('admin-layout')

@section('title', 'WhizCycle | Laporan')

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
                        <h5 class="card-title">Reports</h5>
                        <hr>
                        <div class="col">
                            <!-- Export Button -->
                            <button id="exportButton" class="btn btn-success mb-3">Export to XLSX</button>
                            <table class="table datatable" id="manageVehiclesTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID Kendaraan</th>
                                        <th>Nama Kendaraan</th>
                                        <th>Jenis Kendaraan</th>
                                        <th>Deskripsi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataVehicle as $data)
                                        <tr>
                                            <td scope="row">{{ $data->vehicle_id }}</td>
                                            <td scope="row">{{ $data->name_vehicle }}</td>
                                            <td scope="row">{{ $data->category_vehicle }}</td>
                                            <td scope="row">{{ $data->description_vehicle }}</td>
                                            <td scope="row">
                                                <div class="d-flex align-items-center">
                                                    @if ($data->status_vehicle == 'Sudah Baik')
                                                        <p class="fw-bolder text-todo m-0">Sudah Baik</p>
                                                    @elseif ($data->status_vehicle == 'Butuh Perbaikan')
                                                        <p class="fw-bolder text-inprogress m-0">Butuh Perbaikan</p>
                                                    @elseif ($data->status_vehicle == 'Sedang Dalam Perbaikan')
                                                        <p class="fw-bolder text-closed m-0">Sedang Dalam Perbaikan</p>
                                                    @elseif ($data->status_vehicle == 'Tidak Dapat Digunakan')
                                                        <p class="fw-bolder text-closed m-0">Tidak Dapat Digunakan</p>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js" integrity="sha512-EvoztQwjcMpfM/lX7OgQmJQ4k3HnH1J8Gn9BY/ArqyrO9R8/4fbLQvdXc1ClxriHwTTmAOKwlsKiTFsYneEayg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    document.getElementById('exportButton').addEventListener('click', function() {
        var wb = XLSX.utils.table_to_book(document.getElementById('manageVehiclesTable'), {sheet: "Sheet JS"});
        XLSX.writeFile(wb, 'manageVehicles.xlsx');
    });
</script>
@endsection
