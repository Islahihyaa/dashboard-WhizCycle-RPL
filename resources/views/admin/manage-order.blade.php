@extends('admin-layout')

@section('title', 'WhizCycle | Order')

@section('manage-order', 'active')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>WhizCycle</h1>
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
                                <tr>
                                    <th>Nomor</th>
                                    <th>Nama Customer</th>
                                    <th>Tanggal Penjemputan</th>
                                    <th>Kategori Sampah</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_order as $index => $order)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td scope="row">{{ $order -> pickup_date }} / {{ $order -> pickup_time }}</td>
                                    <td scope="row">{{ $order -> category_trash }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>
                                        <a href="{{ route('manage-order-detail', ['schedule_id' => $order->schedule_id]) }}">
                                            <button type="button" class="btn btn-success">Detail</button>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </tbody>
                    @if (Session::has('successDeleteDriver'))
                        <div class="alert alert-danger alert-lg"> {{ Session::get('successDeleteDriver') }}</div>
                    @elseif (Session::has('failDeleteDriver'))
                        <div class="alert alert-danger alert-lg"> {{ Session::get('failDeleteDriver') }}</div>
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
