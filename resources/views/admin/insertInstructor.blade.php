@extends('admin.layout')
@section('title', 'Insert Users')
@section('content')

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Basic Layout & Basic with Icons -->
                        <div class="row">

                            <!-- Basic with Icons -->
                            <div class="col-xxl">
                                <div class="card mb-6">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="mb-0">Add New Instructor</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id="insertInstructor" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="ti ti-user"></i></span>
                                                        <input type="text" class="form-control" name="name"
                                                            placeholder="John Doe" required>
                                                    </div>
                                                    <span class="text-danger error-text name_error"></span>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="ti ti-mail"></i></span>
                                                        <input type="email" class="form-control" name="email"
                                                            placeholder="john.doe@example.com" required>
                                                    </div>
                                                    <span class="text-danger error-text email_error"></span>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label">Qualification</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="qualification"
                                                        placeholder="Enter qualification" required>
                                                    <span class="text-danger error-text qualification_error"></span>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label">Bio</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" name="bio" placeholder="Short bio" rows="3" required></textarea>
                                                    <span class="text-danger error-text bio_error"></span>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label">Experience (Years)</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" name="experience"
                                                        min="0" placeholder="Years of experience" required>
                                                    <span class="text-danger error-text experience_error"></span>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label">Specialization</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="specialization"
                                                        placeholder="Specialization (Optional)">
                                                    <span class="text-danger error-text specialization_error"></span>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label">Profile Image</label>
                                                <div class="col-sm-10">
                                                    <input type="file" class="form-control" name="profile_image"
                                                        accept="image/*">
                                                    <span class="text-danger error-text profile_image_error"></span>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label">Active</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="is_active">
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row justify-content-end">
                                                <div class="col-sm-10">
                                                    <button type="submit" class="btn btn-primary">Save
                                                        Instructor</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                    , made with ❤️ by <a href="https://pixinvent.com" target="_blank"
                                        class="footer-link">Pixinvent</a>
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
    <!-- / Layout wrapper -->

    <script>
        $(document).ready(function() {
            $("#insertInstructor").submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                let token = localStorage.getItem("auth_token");
                // Send AJAX request
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.instructor.store') }}",
                    data: formData,
                    dataType: "JSON",
                    contentType: false,
                    cache: false,
                    processData: false,
                    headers: {
                        "Authorization": "Bearer " + token // Pass token in headers
                    },
                    success: function(response) {
                        swal("Success", response.message, "success");
                        $("#insertInstructor").trigger("reset");
                        window.open("{{ url('/manage-instructor') }}", "_self");
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.error;
                            $.each(errors, function(key, value) {
                                $("." + key + "_error").text(value[0]);
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
