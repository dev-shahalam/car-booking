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

                                            <button type="button" class="btn btn-sm btn-primary editStatusBtn"
                                                data-id="{{ $rental->id }}" data-status="{{ $rental->status }}"
                                                data-bs-toggle="modal" data-bs-target="#update-modal">
                                                Update
                                            </button>
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


    <!-- Edit status Modal -->
    <div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="update-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStatusLabel">Edit Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCategoryForm" method="POST" action="{{ route('update-status') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="statusId" name="statusId">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" name="status" class="form-control">
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="ongoing">Ongoing</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-5">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // $('#tableData').DataTable({
        //     responsive: true
        // });

        $(document).ready(function() {
            $('#tableData').DataTable({
                responsive: false,
            });
        });
    </script>


    <script>
        // On clicking the edit button, fill in the modal fields with the current data
        document.querySelectorAll('.editStatusBtn').forEach(button => {
            button.addEventListener('click', function() {
                const dataId = this.getAttribute('data-id');
                const dataStatus = this.getAttribute('data-status');

                document.getElementById('statusId').value = dataId;
                document.getElementById('status').value = dataStatus;
            });
        });
    </script>


    {{-- For data table  --}}


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
