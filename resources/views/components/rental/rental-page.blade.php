@extends('layout.sidenav-layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="card px-5 py-5">
                    <div class="row justify-content-between ">
                        <div class="align-items-center col">
                            <h4>Rental Management</h4>
                        </div>
                    </div>
                    <hr class="bg-dark " />

                    <div class="col-md-12 col-sm-12">
                        <div style="overflow-x: auto;">
                            <table class="table" id="tableData">
                                <thead>
                                    <tr class="bg-light">
                                        <th>Customer Name</th>
                                        <th>Car Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rentals as $rental)
                                        {{-- <tr>
                                <form id="deleteForm" action="{{ route('delete-customer', $customer->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form> --}}

                                        <td>{{ $rental->user->name }}</td>
                                        <td>{{ $rental->car->car_name }}</td>
                                        <td>{{ $rental->rental_start_date }}</td>
                                        <td>{{ $rental->rental_end_date }}</td>
                                        <td>{{ $rental->total_price }}</td>

                                        <td>
                                            @if ($rental->status == 'completed')
                                                <span class="badge bg-success">Completed</span>
                                            @elseif($rental->status == 'cancelled')
                                                <span class="badge bg-danger">cancelled</span>
                                            @elseif($rental->status == 'ongoing')
                                                <span class="badge bg-warning text-dark">Ongoing</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{-- <a href="{{'update-customer/'.$rental->id}}" class="px-3 btn me-3 text-white btn-sm bg-info">Rental History<a> --}}
                                            {{-- <a href="{{'update-status/'.$rental->id}}" class="px-3 btn me-3 text-white btn-sm btn-primary">Update</a> --}}
                                            <a type="button"
                                            class="px-3 btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteConfirmationModal">Delete</a>

                                        </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Car start --}}

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationLabel">Update Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {{-- <div class="modal-body">
                <p>Are you sure you want to update status</p>
                </div> --}}
                <form id="updateStatusForm" action="{{ route('update-status', $rental->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">

                        <select name="status" id="status" class="form-select">
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                            <option selected value="ongoing">Ongoing</option>
                        </select>

                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>

            </div>
        </div>
    </div>


    {{-- Delete Form --}}


    {{-- Delete Script --}}
    <script>
        document.getElementById('confirmDelete').addEventListener('click', function() {
            document.getElementById('updateStatusForm').submit();
        });
    </script>

    {{-- Delete Car End --}}





    {{-- For data table  --}}
    <script>
        $(document).ready(function() {
            $('#tableData').DataTable({
                responsive: true,
            });
        });
    </script>
@endsection()
