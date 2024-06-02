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
                            <table class="table" id="redeemPointTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Voucher</th>
                                        <th>Point</th>
                                        <th>DateTime</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach($history as $v)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $v->name }}</td>
                                        <td>{{ $v->voucher }}</td>
                                        <td>{{ $v->point }}</td>
                                        <td>{{ $v->created_at }}</td>
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
        var table = document.getElementById('redeemPointTable');
        var wb = XLSX.utils.table_to_book(table, {sheet: "Sheet JS"});
        
        // Export to XLSX
        XLSX.writeFile(wb, 'point_history_report.xlsx');
    });
</script>
@endsection
