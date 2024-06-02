@extends('admin-layout')

@section('title', 'WhizCycle | Upload Artikel')

@section('content')

<main id="main" class="main">

  <section class="section">
    <div class="row">
      <div class="col-md-12">
        <h2 class="mt-4">Upload Artikel</h2>

        <div class="card p-4">
          <div class="mb-3">
            <label for="formFile" class="form-label">Drag your photo or browse</label>
            <input class="form-control" type="file" id="formFile">
          </div>
          <p class="text-muted">Max 10 MB files are allowed. Only support .jpg, .png files.</p>

          <div class="mb-3">
            <label for="artikelTitle" class="form-label">Add your title</label>
            <input type="text" class="form-control" id="artikelTitle" placeholder="Enter title">
          </div>
          <div class="mb-3">
            <label for="artikelDeskripsi" class="form-label">Add Your Description</label>
            <textarea class="form-control" id="artikelDeskripsi" rows="3" placeholder="Enter description"></textarea>
          </div>
          <div class="text-center">
            <button type="submit" class="btn-custom btn-lg px-5"> Publish </button>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>

@endsection
