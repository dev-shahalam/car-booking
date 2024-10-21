@extends('layout.sidenav-layout')
@section('content')
<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>Customer</h4>
                </div>
            </div>
            <hr class="bg-dark "/>

            <div class="col-md-12 col-sm-12">
                <div style="overflow-x: auto;">
                    <table class="table" id="tableData">
                        <thead>
                            <tr class="bg-light">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Total Spent</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                            <tr>
                                <form id="deleteForm" action="{{ route('delete-customer', $customer->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone_number }}</td>
                                <td>{{ $customer->rentals->sum('total_price')}}</td>
                                <td>
                                    <a href="{{'rental-history/'.$customer->id}}" class="px-3 btn me-3 text-white btn-sm bg-info">Rental History<a>
                                    <a href="{{'update-customer/'.$customer->id}}" class="px-3 btn me-3 text-white btn-sm btn-primary">View</a>
                                    <a type="button" class="px-3 btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal">Delete</a>
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

