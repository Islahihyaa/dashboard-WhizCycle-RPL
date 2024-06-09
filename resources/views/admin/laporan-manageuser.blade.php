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
                            <table class="table datatable" id="userManagementTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Create Date</th>
                                        <th>Point</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td style="@if ($user->role_id == 2) background-color: lightgreen; @endif">
                                            @if ($user->role_id == 1)
                                                User
                                            @elseif ($user->role_id == 2)
                                                Admin
                                            @else
                                                {{ $user->role }}
                                            @endif
                                        </td>
                                        <td>{{ $user->created_at ? $user->created_at->format('d M, Y') : 'N/A' }}</td>
                                        <td>{{ $user->total_points }}</td>
                                        <td>
                                        <div class="filter">
                                                <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots m-3"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                    <li class="dropdown-header text-start">
                                                        <h6>Actions</h6>
                                                    </li>
                                                    <form method="POST" action="{{ route('admin.delete', ['user_id' => $user->user_id]) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('admin.edit', ['user_id' => $user->user_id]) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                                        <button class="btn btn-delete">Delete</button>
                                                    </form>
                                                </ul>
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

<!-- Include SheetJS Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
<!-- Export to XLSX Script -->
<script>
    document.getElementById('exportButton').addEventListener('click', function() {
        // Extract table data
        var table = document.getElementById('userManagementTable');
        var wb = XLSX.utils.table_to_book(table, {sheet: "Sheet JS"});

        // Export to XLSX
        XLSX.writeFile(wb, 'user_management_table.xlsx');
    });
</script>
@endsection
