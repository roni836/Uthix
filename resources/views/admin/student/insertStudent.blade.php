@extends('admin.layout')
@section('title', 'Insert Users')
@section('content')


    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">

            <!-- Basic with Icons -->
            <div class="col-xxl">
                <div class="card mb-6">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Add New Student</h5>
                    </div>
                    <div class="card-body">
                        <form id="insertStudent" method="post">
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Name</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="ti ti-user"></i></span>
                                        <input type="text" class="form-control" name="name"
                                            id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe"
                                            aria-describedby="basic-icon-default-fullname2" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Email</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="ti ti-mail"></i></span>
                                        <input type="text" id="basic-icon-default-email" name="email"
                                            class="form-control" placeholder="john.doe" aria-label="john.doe"
                                            aria-describedby="basic-icon-default-email2" />
                                        <span id="basic-icon-default-email2" class="input-group-text">@example.com</span>
                                    </div>
                                    <div class="form-text">You can use letters, numbers & periods</div>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-sm-2 form-label" for="basic-icon-default-phone">Phone
                                    No</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                class="ti ti-phone"></i></span>
                                        <input type="tel" name="phone" id="basic-icon-default-phone"
                                            class="form-control phone-mask" placeholder="658 799 8941"
                                            aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-sm-2 form-label">classroom</label>
                                <div class="col-sm-10">
                                    <select name="classroom_id" class="form-control">
                                        <option value="">-- Select Class --</option>
                                        @foreach ($classroom as $class)
                                            <option value="{{ $class->id }}">{{ $class->class_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Save </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->



    <!-- / Layout wrapper -->

    <script>
        $(document).ready(function() {
            $("#insertStudent").submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                let token = localStorage.getItem("auth_token");
                // Send AJAX request
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.student.store') }}",
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
                        $("#insertStudent").trigger("reset");
                        window.open("{{ url('/manage-student') }}", "_self");
                    },
                    error: function(xhr, status, error) {
                        // alert(error);
                        swal("Error", xhr.responseText, "error");
                    }
                });
            });
        });
    </script>
@endsection
