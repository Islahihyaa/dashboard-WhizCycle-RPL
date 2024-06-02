@extends('admin-layout')

@section('title', 'WhizCycle | Update Order')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
    <h1>WhizCycle</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Detail</h5>
                    <hr>

                        <form method="post">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input class="form-control" style="background-color: #F3F2F2;" value="{{ $updateOrder->user->name }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input class="form-control" style="background-color: #F3F2F2;" value="{{ $updateOrder->user->address }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Tanggal Penjemputan</label>
                                <div class="col-sm-10">
                                    <input class="form-control" style="background-color: #F3F2F2;" value="{{ $updateOrder->pickup_date }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Waktu Penjemputan</label>
                                <div class="col-sm-10">
                                    <input class="form-control" style="background-color: #F3F2F2;" value="{{ $updateOrder->pickup_time }}" readonly>
                                </div>
                            </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kategori Sampah</h5>
                        <hr>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Kategori Sampah</label>
                                <div class="col-sm-10">
                                    <input class="form-control" style="background-color: #F3F2F2;" value="{{ $updateOrder->category_trash }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Berat</label>
                                <div class="col-sm-10">
                                    <input class="form-control" style="background-color: #F3F2F2;" value="{{ $updateOrder->amount }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Catatan</label>
                                <div class="col-sm-10">
                                    <input class="form-control" style="background-color: #F3F2F2;" value="{{ $updateOrder->notes }}" readonly>
                                </div>
                            </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Update Status</h5>
                        <hr>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-select" required>
                                        <option value="Menunggu Proses Verifikasi">Menunggu Proses Verifikasi </option>
                                        <option value="Menjemput">Menjemput</option>
                                        <option value="Selesai">Selesai</option>
                                        <option value="Dibatalkan">Dibatalkan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn-custom px-5"> SUBMIT</button>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>
            </div>

        </div>
    </section>

</main><!-- End #main -->

@endsection
