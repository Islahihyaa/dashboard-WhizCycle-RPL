@extends('layout')

@section('title', 'WhizCycle | Detail Artikel')

@section('article', 'active')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Read More Artikel</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <hr>
                        <img src="{{ asset('storage/' . $article->image_article) }}" alt="Article Image" class="w-100" style="height: 500px; object-fit: cover;">
                        <p class="text-muted mt-4 text-justify">{{ $article->content }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection
