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
                    <form enctype="multipart/form-data" action="{{'/create-car'}}" method="post">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-6 p-1">
                                    <label class="form-label mt-2">Car Name</label>
                                    <input name="car_name" type="text" class="form-control" id="carName">

                                    <label class="form-label mt-2">Model</label>
                                    <input name="model" type="text" class="form-control" id="model">

                                    <label class="form-label mt-2"> Status </label>
                                    <select name="status" type="text" class="form-control form-select" id="status">
                                        {{--                                    <option value="">Select Status</option>--}}
                                        <option value="available" selected>Available</option>
                                        <option value="rented">Rented</option>
                                        <option value="under_maintenance">Under Maintenance</option>
                                    </select>

                                </div>
                                <div class="col-6 p-1">
                                    <label class="form-label mt-2">Make Year</label>
                                    <input name="make_year" type="text" class="form-control" id="makeYear">

                                    <label class="form-label mt-2">Daily Rent</label>
                                    <input name="daily_rent" type="text" class="form-control" id="dailyRent">

                                    <label class="form-label mt-2"> Description </label>
                                    <input name="description" type="text" class="form-control" id="description">

                                </div>


                                <div class="col-12 p-1">
                                    <br/>
                                    <img class="w-15" id="image" src="{{asset('images/default.jpg')}}"/>
                                    <br/>

                                    <label class="form-label">Image</label>
                                    <input name="image" oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file"
                                           class="form-control" id="productImg">
                                </div>

                            </div>
                        </div>
                        <div class=" text-center mt-3">
                            <button type="submit" id="save-btn" class="btn btn-lg bg-gradient-success">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
