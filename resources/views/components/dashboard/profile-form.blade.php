@extends('layout.sidenav-layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="card px-5 py-5">
                    <div class="row justify-content-between ">
                        <div class="align-items-center col">
                            <h4>Admin Details</h4>
                        </div>
                        <hr class="bg-dark" />
                        <form enctype="multipart/form-data" action="{{ '/update-admin' }}" method="post">
                            @csrf
                            <div class="container">
                                <div class="row">

                                    <div class="col-12 p-1">
                                        <label class="form-label mt-2">Name</label>
                                        <input value="{{ $admin->name }}" name="name" type="text"
                                            class="form-control">

                                        <label class="form-label mt-2">Email</label>
                                        <input value="{{ $admin->email }}" name="email" type="email"
                                            class="form-control">

                                        <label class="form-label mt-2"> Mobile </label>
                                        <input value="{{ $admin->phone_number }}" name="phone_number" type="text"
                                            class="form-control">

                                        <label class="form-label mt-2"> Address </label>
                                        <input value="{{ $admin->address }}" name="address" type="text"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class=" text-center mt-3">
                                    <button type="submit" id="save-btn"
                                        class="btn btn-lg bg-gradient-success">Update</button>
                                </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('success'))
        <div id="notification" class=" row justify-content-center">
            <div class="position-absolute top-50 start-50 translate-middle col-sm-3 alert alert-success text-center text-white"
                role="alert">
                {{ session()->get('success') }}
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div id="notification" class=" row justify-content-center">
            <div class="position-absolute top-50 start-50 translate-middle col-sm-3 alert alert-danger text-white text-center"
                role="alert">
                {{ session()->get('error') }}
            </div>
        </div>
    @endif
    
@endsection()
