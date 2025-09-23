@extends('admin.layout')
@section('title', 'Insert Vendor')
@section('content')

  

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Basic Layout & Basic with Icons -->
                        <div class="row">
                            <!-- Basic with Icons -->
                            <div class="col-xl ">
                                <div class="card mb-6">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="mb-0">Add New Vendor</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id="insertVendor">
                                            <div class="row mb-6">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-fullname">Name</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2"
                                                            class="input-group-text"><i class="ti ti-user"></i></span>
                                                        <input type="text" name="name" class="form-control"
                                                            id="basic-icon-default-fullname" placeholder="John Doe"
                                                            aria-label="John Doe"
                                                            aria-describedby="basic-icon-default-fullname2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="col-sm-2 form-label" for="basic-icon-default-phone">Phone
                                                    No</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                                class="ti ti-phone"></i></span>
                                                        <input type="text" name="phone" id="basic-icon-default-phone"
                                                            class="form-control phone-mask" placeholder="658 799 8941"
                                                            aria-label="658 799 8941"
                                                            aria-describedby="basic-icon-default-phone2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-email">Email</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i class="ti ti-mail"></i></span>
                                                        <input type="email" name="email" id="basic-icon-default-email"
                                                            class="form-control" placeholder="john.doe"
                                                            aria-label="john.doe"
                                                            aria-describedby="basic-icon-default-email2" />
                                                       
                                                    </div>
                                                    <div class="form-text">You can use letters, numbers & periods</div>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-fullname">Gender</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2"
                                                            class="input-group-text"><i class="ti ti-user"></i></span>
                                                       
                                                            <select name="gender" id="" class="form-select">
                                                                <option value="">Select gender</option>
                                                                <option value="male">Male</option>
                                                                <option value="female">Female</option>
                                                                <option value="others">Others</option>
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-fullname">Date of Birth</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2"
                                                            class="input-group-text"><i class="ti ti-user"></i></span>
                                                        <input type="date" name="dob" class="form-control"
                                                            id="basic-icon-default-fullname" placeholder="John Doe"
                                                            aria-label="John Doe"
                                                            aria-describedby="basic-icon-default-fullname2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-fullname">Store Name</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2"
                                                            class="input-group-text"><i class="ti ti-user"></i></span>
                                                        <input type="text" name="store_name" class="form-control"
                                                            id="basic-icon-default-fullname" placeholder="John Doe"
                                                            aria-label="John Doe"
                                                            aria-describedby="basic-icon-default-fullname2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="col-sm-2 form-label"
                                                    for="basic-icon-default-message">Store Address</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-message2" class="input-group-text"><i
                                                                class="ti ti-message-dots"></i></span>
                                                        <textarea id="basic-icon-default-message" name="store_address" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?"
                                                            aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="row mb-6">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-fullname">Logo</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2"
                                                            class="input-group-text"><i class="ti ti-user"></i></span>
                                                        <input type="file" name="logo" class="form-control"
                                                            id="basic-icon-default-fullname" placeholder="John Doe"
                                                            aria-label="John Doe"
                                                            aria-describedby="basic-icon-default-fullname2" />
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="row mb-6">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-company">School</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-company2" class="input-group-text"><i
                                                                class="ti ti-building"></i></span>
                                                        <input type="text" name="school" id="basic-icon-default-company"
                                                            class="form-control" placeholder="ACME Inc."
                                                            aria-label="ACME Inc."
                                                            aria-describedby="basic-icon-default-company2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-company">Counter</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-company2" class="input-group-text"><i
                                                                class="ti ti-building"></i></span>
                                                        <input type="text" name="counter" id="basic-icon-default-company"
                                                            class="form-control" placeholder="ACME Inc."
                                                            aria-label="ACME Inc."
                                                            aria-describedby="basic-icon-default-company2" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="row mb-6">
                                                <label class="col-sm-2 form-label"
                                                    for="basic-icon-default-message">Vendor Address</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-message2" class="input-group-text"><i
                                                                class="ti ti-message-dots"></i></span>
                                                        <textarea id="basic-icon-default-message" name="address" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?"
                                                            aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-company">Create Password</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-company2" class="input-group-text"><i
                                                                class="ti ti-building"></i></span>
                                                        <input type="password" name="password" id="basic-icon-default-company"
                                                            class="form-control" placeholder="ACME Inc."
                                                            aria-label="ACME Inc."
                                                            aria-describedby="basic-icon-default-company2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-company">Confirm Password</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-company2" class="input-group-text"><i
                                                                class="ti ti-building"></i></span>
                                                        <input type="password" name="confirmed_password" id="basic-icon-default-company"
                                                            class="form-control" placeholder="ACME Inc."
                                                            aria-label="ACME Inc."
                                                            aria-describedby="basic-icon-default-company2" />
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            <div class="row justify-content-end">
                                                <div class="col-sm-10">
                                                    <button type="submit" class="btn btn-primary">Send</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

    <script>
        $(document).ready(function() {
            $("#insertVendor").submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                let token = localStorage.getItem("auth_token");
                // Send AJAX request
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.vendor.store') }}",
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
                        $("#insertVendor").trigger("reset");
                        window.open("{{ url('/manage-vendor') }}", "_self");
                    },
                    error: function(xhr, status, error) {
                        swal("Error", xhr.responseText, "error");
                    }
                });
            });
        });
    </script>
@endsection
