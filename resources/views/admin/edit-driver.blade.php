@extends('admin-layout')

@section('title', 'Admin WhizCycle')

@section('manage-driver', 'active')

@section('content')

    <main id="main" class="main">
        <!-- Page Content  -->
        <div class="pagetitle">
            <h1>Kelola Driver</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">Ubah Data Driver</h5>
                        <hr>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                        @endif
                        @if(Session::has('status'))
                        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                            {{ Session::get('status') }}
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <!-- Add Driver Form Elements -->
                        <form method="post" action="{{ route('edit-driver.submit', ['driver_id' => $editDriver->driver_id] ) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputImage" class="col-sm-2 col-form-label">Foto Driver</label>
                                <div class="col-sm-10">
                                    <img src="{{ asset('storage/' . $editDriver->image_driver) }}" class="profile-img" alt="Driver Image">
                                    <input name="image_driver" class="form-control mt-4" type="file" accept="image/png, image/jpeg"></input>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputName" class="col-sm-2 col-form-label">Nama Driver</label>
                                <div class="col-sm-10">
                                    <input name="name_driver" style="background-color: #F3F2F2;" class="form-control" type="text" value="{{ $editDriver->name_driver }}"></input>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPhoneNo" class="col-sm-2 col-form-label">Nomor Telephone</label>
                                <div class="col-sm-10">
                                    <input name="phoneNo_driver" style="background-color: #F3F2F2;" class="form-control" type="number" value="{{ $editDriver->phoneNo_driver }}"></input>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Nomor Lisensi</label>
                                <div class="col-sm-10">
                                    <input name="license_number" style="background-color: #F3F2F2;" class="form-control" type="text" value="{{ $editDriver->license_number }}"></input>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Kendaraan</label>
                                <div class="col-sm-10">
                                    <select name="vehicle_id" style="background-color: #F3F2F2;" class="form-select" required>
                                        <option value="{{ $editDriver -> vehicle_id }}">{{$editDriver -> vehicle -> name_vehicle}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-end">
                                <a href="{{ url('/manage-driver') }}" class="btn-back px-5">KEMBALI</a>
                                <button type="submit" class="btn-custom px-5"> SUBMIT</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

@endsection