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
                            <table class="table datatable" id="CSTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Complaint ID</th>
                                    <th>Nama User</th>
                                    <th>Subjek</th>
                                    <th>Deskripsi</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($complaintdata as $data)                            
                                    <tr>
                                        <td scope="row">{{ $data -> complaint_id }}</td>
                                        <td scope="row">{{ $data -> user -> name}}</td>
                                        <td scope="row">{{ $data -> subjek }}</td>
                                        <td scope="row">{{ $data -> description }}</td>
                                        <td scope="row" >{{ $data -> updated_at }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                @if (Session::has('deleteComplaint'))
                                    <div class="alert alert-danger alert-lg"> {{ Session::get('deleteComplaint') }}</div>
                                @endif

                                @if(session('updateStatus'))
                                    <div class="alert alert-primary alert-lg"> {{ Session::get('updateStatus') }}</div>
                                @endif
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
        var table = document.getElementById('CSTable');
        var wb = XLSX.utils.table_to_book(table, {sheet: "Sheet JS"});
        
        // Export to XLSX
        XLSX.writeFile(wb, 'data_customer_service.xlsx');
    });
</script>
@endsection
