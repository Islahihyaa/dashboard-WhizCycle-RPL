@extends('layout')

@section('title', 'WhizCycle | Riwayat Pemesanan')

@section('riwayat', 'active')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
    <h1>Riwayat</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Order Customer</h5>
                        <hr>
                        <div class="col">
                            <table class="table datatable">
                            <thead class="table-light">
                                <th>Urutan</th>
                                <th>ID</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Waktu Pemesanan</th>
                                <th>Jenis</th>
                                <th>Berat</th>
                                <th>Catatan</th>
                                <th>Status</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_order as $order)
                                    <tr>
                                        <td>{{ $order->schedule_id }}</td>
                                        <td>{{ $order->user_id }}</td>
                                        <td>{{ $order->pickup_date }}</td>
                                        <td>{{ $order->pickup_time }}</td>
                                        <td>{{ $order->category_trash }}</td>
                                        <td>{{ $order->amount }}</td>
                                        <td>{{ $order->notes }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>
                                            <form action="{{ route('history.delete', ['id' => $order->schedule_id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection