@extends('layout.sidenav-layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Customer Details</h4>
                    </div>
                    <hr class="bg-dark"/>
                    <form enctype="multipart/form-data" action="{{'/update-customer/'.$customer->id}}" method="post">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-12 p-1">
                                    <label class="form-label mt-2">Name</label>
                                    <input value="{{$customer->name}}" name="name" type="text" class="form-control">

                                    <label class="form-label mt-2">Email</label>
                                    <input value="{{$customer->email}}" name="email" type="email" class="form-control">

                                    <label class="form-label mt-2"> Mobile </label>
                                    <input value="{{$customer->phone_number}}" name="phone_number" type="text" class="form-control">

                                    <label class="form-label mt-2"> Address </label>
                                    <input value="{{$customer->address}}" name="address" type="text" class="form-control">
                            </div>
                        </div>
                        <div class=" text-center mt-3">
                            <button type="submit" id="save-btn" class="btn btn-lg bg-gradient-success">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection()
