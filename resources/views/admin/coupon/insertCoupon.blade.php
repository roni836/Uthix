@extends('admin.layout')
@section('title', 'Insert Coupon')
@section('content')

   
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Basic Layout & Basic with Icons -->
                        <div class="row">
                            <!-- Basic with Icons -->
                            <div class="col-xl ">
                                <div class="card mb-6">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="mb-0">Add New Coupon</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id="insertCoupon">
                                           
                                           
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="code">Code</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i class="ti ti-user"></i></span>
                                                        <input type="text" name="code" class="form-control" id="code" placeholder="BUYONE12" required />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="discount_type">Discount Type</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i class="ti ti-tag"></i></span>
                                                        <select name="discount_type" class="form-control" id="discount_type" required>
                                                            <option value="percentage">Percentage</option>
                                                            <option value="fixed">Fixed</option>
                                                            <option value="freeShipping">Free Shipping</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="discount_value">Discount Value</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                                                        <input type="number" name="discount_value" class="form-control" id="discount_value" placeholder="Enter value" step="0.01" min="0" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="expiration_date">Expiration Date</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i class="ti ti-calendar"></i></span>
                                                        <input type="date" name="expiration_date" class="form-control" id="expiration_date" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                           
                                           
                                            <div class="row justify-content-end">
                                                <div class="col-sm-10">
                                                    <button type="submit" class="btn btn-primary">Add Now</button>
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
            $("#insertCoupon").submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                let token = localStorage.getItem("auth_token");
                // Send AJAX request
                $.ajax({
                    type: "POST",
                    url: "{{ route('coupons.store') }}",
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
                        $("#insertCoupon").trigger("reset");
                        window.open("{{ url('/manage-coupon') }}", "_self");
                    },
                    error: function(xhr, status, error) {
                        swal("Error", xhr.responseText, "error");
                    }
                });
            });
        });
    </script>
@endsection
