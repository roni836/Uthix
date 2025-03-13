@extends('admin.layout')
@section('title', 'Manage Category')
@section('content')

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->


                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">

                        <!-- Hoverable Table rows -->
                        <div class="card">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Manage Category</h5>
                                <button type="submit" class="btn btn-primary hover" data-bs-toggle="modal"
                                    data-bs-target="#default-modal">Add New Category</button>
                            </div>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Description</th>
                                            <th>Status</th>
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

                                                <td><span class="badge bg-label-primary me-1">{{ $data->status }}</span>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="ti ti-pencil me-1"></i> Edit</a>
                                                            <button class="dropdown-item delete-category"
                                                                href="javascript:void(0);" data-id="{{ $data->id }}">
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
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl">
                            <div
                                class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                                <div class="text-body">
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>
                                    , made with ❤️ by <a href="https://trapigo.in/" target="_blank"
                                        class="footer-link">Trapigo</a>
                                </div>
                                <div class="d-none d-lg-inline-block">
                                    <a href="https://themeforest.net/licenses/standard" class="footer-link me-4"
                                        target="_blank">License</a>
                                    <a href="https://1.envato.market/pixinvent_portfolio" target="_blank"
                                        class="footer-link me-4">More Themes</a>

                                    <a href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation/"
                                        target="_blank" class="footer-link me-4">Documentation</a>

                                    <a href="https://pixinvent.ticksy.com/" target="_blank"
                                        class="footer-link d-none d-sm-inline-block">Support</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>


    <!-- Bootstrap Modal -->
    <div class="modal fade" id="default-modal" tabindex="-1" aria-labelledby="editHirePlanModalLabel"
        aria-hidden="true">
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

    <script>
        $(document).ready(function() {
            $("#insertCategory").submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                let token = localStorage.getItem("auth_token");
                // Send AJAX request
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
                    error: function(xhr, status, error) {
                        swal("Error", xhr.responseText, "error");
                    }
                });
            });

            $(document).on('click', '.delete-category', function() {
                let id = $(this).data('id');
                let token = localStorage.getItem("auth_token");

                if (confirm("Are you sure you want to delete this Data?")) {
                    $.ajax({
                        type: 'DELETE',
                        url: `/api/categories/${id}`, // Correct URL formatting
                        headers: {
                            "Authorization": "Bearer " + token
                        },
                        success: function(response) {
                            swal("Success", response.message, "success");
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.error('Error deleting Data:', error);
                            alert('Something went wrong. Please try again.');
                        }
                    });
                }
            });

            // $(document).on('click', '.editBtn', function() {
            //     let id = $(this).data('id');
            //     $.ajax({
            //         type: 'GET',
            //         url: `{{ url('/api/hire-plan/view/${id}') }}`,
            //         success: function(response) {
            //             $('#id').val(response.data.id);
            //             $('#name').val(response.data.name);
            //             $('#features').val(response.data.features);
            //             $('#price').val(response.data.price);
            //             $('#default-modal').removeClass('hidden');
            //         },
            //         error: function(xhr, status, error) {
            //             console.error('Error fetching  details for editing:', error);
            //         }
            //     });
            // });

            // $('#editForm').submit(function(e) {
            //     e.preventDefault();
            //     let id = $('#id').val();
            //     let formData = {
            //         name: $('#name').val(),
            //         features: $('#features').val(),
            //         price: $('#price').val(),
            //     };

            //     // let features = $("#features").val().split("\n");

            //     // features = features.filter(feature => feature.trim() !== '');
            //     // formData.append('features', JSON.stringify(features));
            //     $.ajax({
            //         type: 'PUT',
            //         url: `{{ url('/api/hire-plan/edit/${id}') }}`,
            //         data: formData,
            //         success: function(response) {
            //             swal("Success", response.message, "message");
            //             $('#default-modal').addClass('hidden');
            //             swal("Success", response.message, "message");
            //             callingPlans();
            //         },
            //         error: function(xhr, status, error) {
            //             console.error('Error updating Data:', error);
            //         }
            //     });
            // });

            // // Cancel edit Doctor button click handler
            // $('#cancelEdit').click(function() {
            //     $('#default-modal').addClass('hidden');
            // });

        });
    </script>

@endsection
