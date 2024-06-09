@extends('admin-layout')

@section('title', 'WhizCycle')

@section('voucher', 'active')

@section('content')

<main id="main" class="main">
    <!-- Page Content  -->
    <div class="pagetitle">
        <h1>Redeem Point</h1>
    </div>

    <section class="section" id="main-redeem">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-12 text-end">
                                <!-- Button to trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVoucherModal">
                                    Add Voucher
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Voucher</th>
                                            <th>Point</th>
                                            <th>DateTime</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach($vouchers as $v)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $v->voucher }}</td>
                                            <td>{{ $v->point }}</td>
                                            <td>{{ $v->created_at }}</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" onclick="openEditModal('{{ $v->id }}', '{{ $v->voucher }}', '{{ $v->point }}')"><i class="bi bi-pencil-square"></i> Edit</button>
                                                <button class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $v->id }}')"><i class="bi bi-trash-fill"></i> Delete</button>
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
        </div>
    </section>
</main>

<!-- Add Voucher Modal -->
<div class="modal fade" id="addVoucherModal" tabindex="-1" aria-labelledby="addVoucherModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addVoucherModalLabel">Add Voucher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add your form for adding voucher here -->
                <!-- Example form -->
                <form id="addVoucherForm" action="{{ route('voucher.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="voucher" class="form-label">Voucher</label>
                        <input type="text" class="form-control" id="voucher" name="voucher">
                    </div>
                    <div class="mb-3">
                        <label for="point" class="form-label">Point</label>
                        <input type="number" class="form-control" id="point" name="point">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Voucher Modal -->
<div class="modal fade" id="editVoucherModal" tabindex="-1" aria-labelledby="editVoucherModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editVoucherModalLabel">Edit Voucher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editVoucherForm" action="{{ url('voucher-update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="voucher_id" id="voucher_id">
                    <div class="mb-3">
                        <label for="edit_voucher" class="form-label">Voucher</label>
                        <input type="text" class="form-control" id="edit_voucher" name="voucher">
                    </div>
                    <div class="mb-3">
                        <label for="edit_point" class="form-label">Point</label>
                        <input type="number" class="form-control" id="edit_point" name="point">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section("script")
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function openEditModal(id, voucher, point) {
        $('#editVoucherModal #voucher_id').val(id);
        $('#editVoucherModal #edit_voucher').val(voucher);
        $('#editVoucherModal #edit_point').val(point);
        $('#editVoucherModal').modal('show');
    }

    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this voucher?')) {
            // Perform deletion action here, like redirecting to delete route
            window.location.href = '/voucher-delete/' + id ;
        }
    }
</script>

@endsection
