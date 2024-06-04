@extends('admin-layout')

@section('title', 'WhizCycle | Redeem Point History')

@section('redeem-point-history', 'active')

@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Redeem Point History</h1>
    </div>
    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Redeem Point History</h5>
                        <hr>
                        <div class="col">
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
@endsection

@section("js")
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+5hb7Bp6LW2HLhtM5x5o0s8JwE6rA0X7yCZjlf8" crossorigin="anonymous"></script>
@endsection