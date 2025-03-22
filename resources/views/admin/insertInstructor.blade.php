@extends('admin.layout')
@section('title', 'Insert Users')
@section('content')

   

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
