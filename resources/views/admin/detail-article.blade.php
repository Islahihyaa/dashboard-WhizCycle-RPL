@extends('admin-layout')

@section('title', 'Admin Article')

@section('detail-article', 'active')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
    <h1>Artikel WhizCycle</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <hr>
                          <img src="{{asset('storage/'. $article->image_article)}}" class="card-img-top my-4" alt="article-image" class="w-100" height="190" object-fit: cover;>

                          <p class="text-muted mt-4 text-align-justify w-100">{{$article->content}}</p>

                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection
