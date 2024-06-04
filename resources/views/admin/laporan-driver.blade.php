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
                            <table class="table datatable" id="driverManagementTable">
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
                                            <a class="icon" href="{{ route('edit-driver-data', ['driver_id' => $data->driver_id] ) }}" >
                                                <i class="bi bi-pencil-fill icon-background edit-icon"></i>
                                            </a>
                                            <i class="bi bi-trash3-fill icon-background delete-icon" data-bs-toggle="modal" data-bs-target="#modal{{ $data->driver_id }}"></i>
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
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Include SheetJS Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
<!-- Export to XLSX Script -->
<script>
    document.getElementById('exportButton').addEventListener('click', function() {
        // Extract table data
        var table = document.getElementById('driverManagementTable');
        var wb = XLSX.utils.table_to_book(table, {sheet: "Sheet JS"});
        
        // Export to XLSX
        XLSX.writeFile(wb, 'driver_management_table.xlsx');
    });
</script>
@endsection
