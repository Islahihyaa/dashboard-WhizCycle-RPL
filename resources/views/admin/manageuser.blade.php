@extends('admin-layout')

@section('title', 'WhizCycle | User Management')

@section('manageuser', 'active')

@section('content')

<style>
    .main {
        padding: 20px;
        background-color: #f4f7fa;
    }

    .pagetitle h1 {
        color: #333;
        font-size: 24px;
    }

    .search-bar {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    .search-bar input[type="text"], .search-bar select {
        flex-grow: 1;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .btn-primary, .btn-sort {
        background-color: #0d6efd;
        border: none;
        padding: 10px 20px;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .table th, .table td {
        padding: 12px;
        border-bottom: 1px solid #dee2e6;
        cursor: pointer; /* Make headers clickable */
    }

    .table th {
        background-color: #f8f9fa;
        color: #212529;
    }

    .table td {
        vertical-align: middle;
    }

    .btn-edit, .btn-delete {
        padding: 5px 10px;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-edit {
        background-color: #0d6efd;
    }

    .btn-delete {
        background-color: #dc3545;
    }

    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination .page-item {
        margin: 0 5px;
    }

    .pagination .page-link {
        color: #0d6efd;
        text-decoration: none;
        padding: 8px 12px;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 5px;
    }

    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
    }
</style>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>User Management</h1>
    </div>
    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">User Management</h5>
                        <hr>
                        <div class="col">
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
                                        <td>{{ $user->created_at->format('d M, Y') }}</td>
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
                                                    <form method="POST" action="{{ route('admin.edit', ['user_id' => $user->user_id]) }}">
                                                        @csrf
                                                        @method('PUT')
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

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<!-- Initialize DataTables -->
<script>
    $(document).ready(function() {
        $('#userManagementTable').DataTable({
            "order": [[ 0, "asc" ]], // Default sort by first column (Name)
            "columnDefs": [
                { "orderable": true, "targets": 0 }, // Name column
                { "orderable": true, "targets": 1 }, // Role column
                { "orderable": true, "targets": 2 }, // Create Date column
                { "orderable": true, "targets": 3 }, // Point column
                { "orderable": false, "targets": 4 } // Actions column, disable sorting
            ]
        });
    });
</script>
@endsection
