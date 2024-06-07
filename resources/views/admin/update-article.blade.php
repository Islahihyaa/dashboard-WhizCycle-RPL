@extends('admin-layout')

@section('title', 'Admin Article')

@section('update-article', 'active')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
    <h1>Edit Artikel WhizCycle</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Detail artikel</h5>
                        <hr>

                        <form method="POST" action="/articleupp/{{ $article->article_id }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="inputTitle" class="col-sm-2 col-form-label">Judul Artikel</label>
                                <div class="col-sm-10">
                                    <input name="title" class="form-control" type="text" value="{{ $article->title }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputContent" class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <input name="content" class="form-control" type="text" value="{{ $article->content }}" required>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn-custom px-5">Publish Edit</button>
                            </div>
                        </form>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        @if(Session::has('status'))
                            <div class="alert alert-success"> {{ Session::get('status') }}</div>
                        @endif
                        @if(Session::has('notSetDataMessage'))
                            <div class="alert alert-success"> {{ Session::get('notSetDataMessage') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

    </main>

@endsection