@extends('admin.layout')
@section('title', 'Manage classes')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Hoverable Table rows -->
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Manage classes</h5>
                <button type="submit" class="btn btn-primary hover" data-bs-toggle="modal" data-bs-target="#default-modal">Add
                    New classes</button>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Name</th>
                            <th>Capacity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($classes as $i=>$data)
                            <tr>
                                <td>
                                    <span class="fw-medium">{{ $i + 1 }}</span>
                                </td>
                                <td>
                                    <span class="fw-medium capitalize">{{ $data->class_name }}</span>
                                </td>
                                <td><span class="badge bg-label-primary me-1">{{ $data->capacity }}</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item edit-class" href="javascript:void(0);"
                                                data-id="{{ $data->id }}">
                                                <i class="ti ti-pencil me-1"></i> Edit
                                            </button>
                                            <button class="dropdown-item delete-class" href="javascript:void(0);"
                                                data-id="{{ $data->id }}">
                                                <i class="ti ti-trash me-1"></i> Delete
                                            </button>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Hoverable Table rows -->
    </div>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="default-modal" tabindex="-1" aria-labelledby="editHirePlanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editHirePlanModalLabel">Add New class</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="insertClass" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="class_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Capacity</label>
                            <input type="number" id="capacity" name="capacity" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-default-modal" tabindex="-1" aria-labelledby="editclass" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editHirePlanModalLabel">Edit class</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editclass" method="PUT" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label">Title</label>
                            <input type="hidden" id="edit_id" name="id" class="form-control" required>
                            <input type="text" id="edit_cat_title" name="cat_title" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#insertClass").submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                let token = localStorage.getItem("auth_token");

                $.ajax({
                    type: "POST",
                    url: "{{ route('classroom.store') }}",
                    data: formData,
                    dataType: "JSON",
                    contentType: false,
                    cache: false,
                    processData: false,
                    headers: {
                        "Authorization": "Bearer " + token
                    },
                    success: function(response) {
                        swal("Success", response.message, "success");
                        $("#insertClass").trigger("reset");
                        location.reload();
                    },
                    error: function(xhr) {
                        swal("Error", xhr.responseText, "error");
                    }
                });
            });

            $(document).on('click', '.delete-class', function() {
                let id = $(this).data('id');
                let token = localStorage.getItem("auth_token");

                if (confirm("Are you sure you want to delete this data?")) {
                    $.ajax({
                        type: 'DELETE',
                        url: `{{ url('/api/classroom/') }}/${id}`,
                        headers: {
                            "Authorization": "Bearer " + token
                        },
                        success: function(response) {
                            swal("Success", response.message, "success");
                            location.reload();
                        },
                        error: function(xhr) {
                            alert('Something went wrong. Please try again.');
                        }
                    });
                }
            });

            $(document).on('click', '.edit-class', function() {
                let id = $(this).data('id');


                $.ajax({
                    type: 'GET',
                    url: `{{ url('/api/show-class/') }}/${id}`,
                    success: function(response) {
                        $('#edit_id').val(response.category.id);
                        $('#edit_name').val(response.category.name);
                        $('#edit_status').val(response.category.status);
                        $('#edit-default-modal').modal('show');
                    },
                    error: function(xhr) {
                        console.error('Error fetching details for editing:', xhr.responseText);
                    }
                });
            });

            $('#editclass').submit(function(e) {
                e.preventDefault();

                let id = $('#edit_id').val();
                let token = localStorage.getItem("auth_token");



                // Create a new FormData object
                let formData = new FormData();
                formData.append("name", $('#edit_name').val());

                // If your backend expects a PUT request but cannot handle multipart PUT,
                // you can use POST and override the method with _method
                formData.append("_method", "PUT");

                $.ajax({
                    url: `{{ url('/api/class') }}/${id}`,
                    type: 'POST', // using POST with method override
                    data: formData,
                    processData: false, // Prevent jQuery from processing the data
                    contentType: false, // Let the browser set the content type, including the boundary
                    headers: {
                        "Authorization": "Bearer " + token
                    },
                    success: function(response) {
                        swal("Success", response.message, "success");
                        $('#edit-default-modal').modal('hide');
                        location.reload();
                    },
                    error: function(xhr) {
                        console.error('Error updating Data:', xhr.responseText);
                    }
                });
            });

            $('#cancelEdit').click(function() {
                $('#edit-default-modal').modal('hide');
            });
        });
    </script>

@endsection
