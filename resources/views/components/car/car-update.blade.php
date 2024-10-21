@extends('layout.sidenav-layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Add Car</h4>
                    </div>
                    <hr class="bg-dark"/>
                    <form enctype="multipart/form-data" action="{{'/update-car/'.$car->id}}" method="post">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-6 p-1">
                                    <label class="form-label mt-2">Car Name</label>
                                    <input value="{{$car->car_name}}" name="car_name" type="text" class="form-control" id="carName">

                                    <label class="form-label mt-2">Model</label>
                                    <input value="{{$car->model}}" name="model" type="text" class="form-control" id="model">

                                    <label class="form-label mt-2"> Status </label>

                                    <select name="status" class="form-control form-select" id="status">
                                        <option value="available" @selected($car->status == 'available')>Available</option>
                                        <option value="rented" @selected($car->status == 'rented')>Rented</option>
                                        <option value="under_maintenance" @selected($car->status == 'under_maintenance')>Under Maintenance</option>
                                    </select>


                                </div>
                                <div class="col-6 p-1">
                                    <label class="form-label mt-2">Make Year</label>
                                    <input value="{{$car->make_year}}" name="make_year" type="text" class="form-control" id="makeYear">

                                    <label class="form-label mt-2">Daily Rent</label>
                                    <input value="{{$car->daily_rent}}" name="daily_rent" type="text" class="form-control" id="dailyRent">

                                    <label class="form-label mt-2"> Description </label>
                                    <input value="{{$car->description}}" name="description" type="text" class="form-control" id="description">
                                </div>
                                <div class="col-12 p-1">
                                    <!-- Display current image with defined width using Bootstrap class -->
                                    <img class="w-15" id="image" src="{{ asset($car->image) }}" alt="Car Image" />
                                    <br/>

                                    <label class="form-label">Image</label>
                                    <!-- Added 'image' ID here for setting preview src -->
                                    <input name="image" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])"
                                           type="file" class="form-control">
                                </div>


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
@endsection
