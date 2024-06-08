@extends('admin-layout')

@section('title', 'WhizCycle | Order')

@section('manage-order', 'active')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>WhizCycle</h1>
    </div>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data Order Customer</h5>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Customer</th>
                                            <th>Detail</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($data_order as $index => $order)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $order->user->name }}</td>
                                                <td>
                                                    <a href="{{ route('manage-order-detail', ['schedule_id' => $order->schedule_id]) }}">
                                                        <button type="button" class="btn btn-success">Detail</button>
                                                    </a>
                                                </td>
                                                <td>{{ $order->status }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            @if (Session::has('successDeleteDriver'))
                                <div class="alert alert-danger alert-lg">{{ Session::get('successDeleteDriver') }}</div>
                            @elseif (Session::has('failDeleteDriver'))
                                <div class="alert alert-danger alert-lg">{{ Session::get('failDeleteDriver') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection
