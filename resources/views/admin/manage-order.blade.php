@extends('admin-layout')

@section('title', 'WhizCycle | Order')

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
                                    <th>No</th>
                                    <th>Nama Customer</th>
                                    <th>Detail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data_order as $data)
                                    <tr>
                                        <td scope="row">{{ $loop -> iteration }}</td>
                                        <td scope="row">{{ $data -> user -> name }}</td>
                                        <td scope="row">
                                            <a href="{{ route('manage-order-detail', ['schedule_id' => $data->schedule_id]) }}">
                                            <button type="button" class="btn btn-success">Detail</button>
                                            </a>
                                        </td>
                                        <td scope="row">{{ $data -> status }}</td>
                                    </tr>
                                @endforeach

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

