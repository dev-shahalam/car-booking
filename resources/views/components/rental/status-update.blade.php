{{-- @extends('layout.sidenav-layout')

@extends('layout.auth')

 <!-- The Modal -->
 <div class="modal fade" id="status-update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Rental Status</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="categorySelect" class="form-label">Select Status</label>
              <select class="form-select" id="status" name="status">

                {{-- @foreach ($rentals as $rental) --}}
                {{-- <option value="{{$rental->status}}">{{$rental->status}}</option> --}}

                {{-- @if ($rental->status !== 'completed')
                <option selected disabled>Completed</option>
                @elseif($rental->status !== 'cancelled')
                <option selected disabled>Cancelled</option>
                @elseif($rental->status !== 'ongoing')
                <option selected disabled>Ongoing</option>
                @endif --}}
                {{-- @endforeach --}}
                {{-- <option id="" value="completed"></option> --}}
                {{-- <option value="ongoing">Ongoing</option>
                <option value="cancelled">Cancelled</option> --}}
              {{-- </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div> --}}
{{-- </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Check if the session flash message is set
    @if(session('openModal'))
        const exampleModal = new bootstrap.Modal(document.getElementById('exampleModal'));
        exampleModal.show();
    @endif



    const urlParams = new URLSearchParams(window.location.search);
    const openModal = urlParams.get('openModal');

    if (openModal) {
        // Open the modal automatically using Bootstrap's JS
        const exampleModal = new bootstrap.Modal(document.getElementById('exampleModal'));
        exampleModal.show();
    }
</script>  --}}


<div class="container mt-5">
    <!-- The Modal -->
    <div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select Option Modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="categorySelect" class="form-label">Select a Category</label>
                            <select class="form-select" id="categorySelect" name="category">
                                <option selected disabled>Select a category</option>
                                <option value="1">Category 1</option>
                                <option value="2">Category 2</option>
                                <option value="3">Category 3</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
