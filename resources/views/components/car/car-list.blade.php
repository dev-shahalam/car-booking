<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">

            <div class="card px-5 py-3">
                <div class="row justify-content-between ">
                    <div class="align-items-center col-8 d-flex">
                        <h4>Cars</h4>
                        {{-- Search car by status --}}

                        <select class="form-select w-40 ms-3" id="statusFilter" onchange="filterCars()">
                            <option value="">All</option>
                            <option value="available">Available</option>
                            <option value="rented">Rented</option>
                            <option value="under_maintenance">Under Maintenance</option>
                        </select>

                    </div>

                    <div class="align-items-center col-4">
                        <a href="{{'/car-create'}}" class="float-end btn m-0  bg-gradient-primary">Add Car</a>
                    </div>
                </div>
                {{--                <hr class="bg-dark"/>--}}
            </div>
        </div>

        <div class="row mt-4" id="carList" >
            @foreach ( $cars as $car )
            <div class=" car-item col-md-6 col-sm-12 mt-3" data-status="{{ $car->status }}">
                <div class="card p-3" >
                    <div class="d-flex">
                        <div class="w-40">
                            <img class="img-fluid" src="{{$car->image}}">
                            <div class=" col-md-12.col-lg-12:d-flex justify-content-center col-sm-12 justify-contect-center mt-2">
                                <a href="{{'/car-update/'.$car->id}}" class="px-3 btn me-3 text-white btn-sm btn-primary">Update</a>
                                  <a type="button" class="px-3 btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal">
                                    Delete
                                </a>
                            </div>

                        </div>
                        <div class="w-60 ps-3">
                            <h5>{{$car->car_name}}</h5>
                            <span> {{$car->model}} {{$car->make_year}}</span>
                            <br>
                            <span>{{$car->description}}</span>
                            <br>
                            <span class="badge bg-info text-dark">{{$car->daily_rent}}</span>
                            @if($car->status === 'available')
                                <span class="badge bg-success">Available</span>
                            @elseif($car->status === 'rented')
                                <span class="badge bg-danger">Rented</span>
                            @elseif($car->status === 'under_maintenance')
                                <span class="badge bg-warning text-dark">Under Maintenance</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>



{{-- Delete Car start --}}

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this item? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>



{{-- Delete Form --}}

<form id="deleteForm" action="{{ route('delete-car', $car->id) }}" method="POST">
    @csrf
    @method('DELETE')
</form>



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



{{-- Delete Script --}}
<script>
    document.getElementById('confirmDelete').addEventListener('click', function() {
        document.getElementById('deleteForm').submit();
    });
 </script>

{{-- Delete Car End --}}


{{-- Filter Cars Script --}}

<script>
    function filterCars() {
        const selectedStatus = document.getElementById('statusFilter').value;

        // Get all car items
        const carItems = document.querySelectorAll('.car-item');

        carItems.forEach(car => {
            const carStatus = car.getAttribute('data-status');

            if (selectedStatus === "" || carStatus === selectedStatus) {
                car.style.display = 'block';
            } else {
                car.style.display = 'none';
            }
        });
    }
</script>


