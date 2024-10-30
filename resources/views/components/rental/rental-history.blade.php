@extends('layout.sidenav-layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="card px-5 py-5">
                    <div class="row justify-content-between ">
                        <div class="align-items-center col">
                            <h4>Total Rental = <span class="text-muted">{{ $rentals->count() }}</span></h4>
                            <h4>Total Spent  = <span class="text-muted">{{ $rentals->sum('total_price') }}</span></h4>
                        </div>
                    </div>
                    <hr class="bg-dark " />

                    <div class="col-md-12 col-sm-12">
                        <div style="overflow-x: auto;">
                            <table class="table" id="tableData">
                                <thead>
                                    <tr class="bg-light">
                                        <th>Vehicle Name</th>
                                        <th>Rental Start Date</th>
                                        <th>Rental End Date</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rentals as $rental)
                                        <tr>
                                            <form id="deleteForm" action="{{ route('delete-rental', $rental->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            <td>{{ $rental->car->car_name }}</td>
                                            <td>{{ $rental->rental_start_date }}</td>
                                            <td>{{ $rental->rental_end_date }}</td>
                                            <td>{{ $rental->total_price }}</td>
                                            <td> @if ($rental->status === 'completed')
                                                    <span class="badge bg-success">Completed</span>
                                                @elseif($rental->status === 'cancelled')
                                                    <span class="badge bg-danger">cancelled</span>
                                                @elseif($rental->status === 'ongoing')
                                                    <span class="badge bg-warning text-dark">Ongoing</span>
                                                @endif
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


    {{-- Delete Script --}}
    <script>
        document.getElementById('confirmDelete').addEventListener('click', function() {
            document.getElementById('deleteForm').submit();
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
