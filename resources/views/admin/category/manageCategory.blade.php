@extends('admin.layout')
@section('title', 'Manage Category')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Hoverable Table rows -->
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Manage Category</h5>
                <button type="submit" class="btn btn-primary hover" data-bs-toggle="modal" data-bs-target="#default-modal">Add
                    New Category</button>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Description</th>
                            {{-- <th>Status</th> --}}
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($category as $data)
                            <tr>
                                <td>
                                    <span class="fw-medium">{{ $data->cat_title }}</span>
                                </td>
                                <td><img src="{{ asset('storage/image/category/' . $data->cat_image) }}"
                                        alt="Category Image" width="100"></td>
                                <td>{{ $data->cat_description }}</td>

                                {{-- <td><smpan class="badge bg-label-primary me-1">{{ $data->status }}</span> --}}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item edit-category" href="javascript:void(0);"
                                                data-id="{{ $data->id }}">
                                                <i class="ti ti-pencil me-1"></i> Edit
                                            </button>
                                            <button class="dropdown-item delete-category" href="javascript:void(0);"
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
                    <h5 class="modal-title" id="editHirePlanModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="insertCategory" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label">Title</label>
                            <input type="text" id="name" name="cat_title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="parent_category_id" class="form-label">Parent Category</label>
                            <select name="parent_category_id" id="parent_category_id" class="form-control">
                                <option value="">Select Parent Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->cat_title }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="mb-3">
                            <label for="cat_description" class="form-label">Description</label>
                            <textarea name="cat_description" id="cat_description" rows="3" class="form-control" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="cat_image" class="form-label">Category Image</label>
                            <input type="file" id="cat_image" name="cat_image" class="form-control" required>
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

    <div class="modal fade" id="edit-default-modal" tabindex="-1" aria-labelledby="editCategory" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editHirePlanModalLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCategory" method="PUT" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label">Title</label>
                            <input type="hidden" id="edit_id" name="id" class="form-control" required>
                            <input type="text" id="edit_cat_title" name="cat_title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="parent_category_id" class="form-label">Parent Category</label>
                            <select name="parent_category_id" id="edit_parent_category_id" class="form-control">
                                <option value="">Select Parent Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->cat_title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="cat_description" class="form-label">Description</label>
                            <textarea name="cat_description" id="edit_cat_description" rows="3" class="form-control" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="cat_image" class="form-label">Category Image</label>
                            <input type="file" id="edit_cat_image" name="cat_image" class="form-control">
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
            $("#insertCategory").submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                let token = localStorage.getItem("auth_token");

                $.ajax({
                    type: "POST",
                    url: "{{ route('categories.store') }}",
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
                        $("#insertCategory").trigger("reset");
                        window.open("{{ url('/manage-category') }}", "_self");
                    },
                    error: function(xhr) {
                        swal("Error", xhr.responseText, "error");
                    }
                });
            });

            $(document).on('click', '.delete-category', function() {
                let id = $(this).data('id');
                let token = localStorage.getItem("auth_token");

                if (confirm("Are you sure you want to delete this data?")) {
                    $.ajax({
                        type: 'DELETE',
                        url: `{{ url('/api/categories/') }}/${id}`,
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

            $(document).on('click', '.edit-category', function() {
                let id = $(this).data('id');


                $.ajax({
                    type: 'GET',
                    url: `{{ url('/api/show-category/') }}/${id}`,
                    success: function(response) {
                        $('#edit_id').val(response.category.id);
                        $('#edit_cat_title').val(response.category.cat_title);
                        $('#edit_parent_category_id').val(response.category.parent_category_id);
                        $('#edit_cat_description').val(response.category.cat_description);
                        $('#edit-default-modal').modal('show');
                    },
                    error: function(xhr) {
                        console.error('Error fetching details for editing:', xhr.responseText);
                    }
                });
            });

            $('#editCategory').submit(function(e) {
                e.preventDefault();

                let id = $('#edit_id').val();
                // let formData = {
                //     cat_title: $('#edit_cat_title').val(),
                //     cat_description: $('#edit_cat_description').val(),
                //     parent_category_id: $('#edit_parent_category_id').val(),
                //     cat_image: $('#edit_cat_image').val(),
                // };

                let token = localStorage.getItem("auth_token");



                // Create a new FormData object
                let formData = new FormData();
                formData.append("cat_title", $('#edit_cat_title').val());
                formData.append("cat_description", $('#edit_cat_description').val());
                formData.append("parent_category_id", $('#edit_parent_category_id').val());

                // Append the file if one is selected
                let fileInput = $('#edit_cat_image')[0];
                if (fileInput.files.length > 0) {
                    formData.append("cat_image", fileInput.files[0]);
                }

                // If your backend expects a PUT request but cannot handle multipart PUT,
                // you can use POST and override the method with _method
                formData.append("_method", "PUT");

                $.ajax({
                    url: `{{ url('/api/categories') }}/${id}`,
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
