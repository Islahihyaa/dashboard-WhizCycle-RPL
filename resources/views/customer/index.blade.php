@extends('layout')

@section('title', 'WhizCycle')

@section('home', 'active')

@section('content')


    <main id="main" class="main">
        <!-- Page Content  -->
        <div class="pagetitle">
            <h1>Beranda</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <h1 class="card-title">Jadwalkan Pengambilan Sampah Anda Sekarang! Dengan Mudah dan Efisien!</h1>
                                    <p class="card-content">Aplikasi WhizCycle adalah solusi untuk menyelesaikan masalah sosial tentang kebersihan lingkungan.
                                        <span>
                                            Mulai sekarang, atur jadwal pengambilan sampah Anda dengan mudah! Pilih tanggal dan tentukan waktu pengumpulan sampah Anda. Kami siap membantu Anda menjaga lingkungan bersih dan memberikan layanan yang praktis dan efisien. Ayo beraksi sekarang!
                                        </span>
                                    </p>

                                    <div class="text-start">
                                        <a href ="order" name="order" class="btn-custom btn-lg">Pesan Ojol</a>
                                    </div>
                            </div>
                            <div class="col-md-3 card-img-container">
                                <img src="images/Driver.png" alt="image" class="card-img">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Selamat!</h5>
                                <h1 class="card-total">{{ $user_data->total_daur_ulang}} Kg</h1>
                                <p class="card-subtext">Sampah Anda berhasil di daur ulang!</p>
                                <a href="riwayat" class="card-ref">ketuk untuk lihat riwayatmu</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Terima Kasih!</h5>
                                <h1 class="card-total">{{ $user_data->total_points}} Points</h1>
                                <p class="card-subtext">Nikmati manfaatnya dengan menukarkan poin Anda!</p>
                                <a href="<?= url('redeem-point') ?>" class="card-ref">ketuk untuk menukar point</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Artikel WhizCycle</h5>
                        <div class="row">
                            @foreach($data_article as $data)
                                <div class="col-md-3 mb-4">
                                    <div class="card p-3">
                                        <img src="{{ asset('storage/' . $data->image_article) }}" class="card-img-top my-4" alt="Article Image" width="180" height="190">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $data->title }}</h5>
                                            <p class="card-text">{{ Str::limit($data->content, 100) }}</p>
                                            <a href="{{url('article/'.$data->article_id.'/detail')}}" class="btn-custom">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a href="{{url('/article')}}" class="card-ref">ketuk untuk melihat artikel lainnya</a>
                    </div>
            </div>
        </section>

    </main>

@endsection
