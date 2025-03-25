@extends('admin.layout')
@section('title', 'Insert plan')
@section('content')

   
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Basic Layout & Basic with Icons -->
                        <div class="row">
                            <!-- Basic with Icons -->
                            <div class="col-xl ">
                                <div class="card mb-6">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="mb-0">Add New Plan</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id="insertPlan">
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="name">Plan Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Plan Name" required />
                                                </div>
                                            </div>
                                        
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="description">Description</label>
                                                <div class="col-sm-10">
                                                    <textarea name="description" id="description" class="form-control" placeholder="Enter Plan Description"></textarea>
                                                </div>
                                            </div>
                                        
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="price">Price</label>
                                                <div class="col-sm-10">
                                                    <input type="number" name="price" id="price" class="form-control" placeholder="Enter Price" required />
                                                </div>
                                            </div>
                                        
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="duration">Duration</label>
                                                <div class="col-sm-10">
                                                    <select name="duration" id="duration" class="form-control" required>
                                                        <option value="monthly">Monthly</option>
                                                        <option value="yearly">Yearly</option>
                                                    </select>
                                                </div>
                                            </div>
                                        
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="feature_input">Features</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="feature_input" class="form-control" placeholder="Type feature & press Add">
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="button" id="addFeature" class="btn btn-primary">Add</button>
                                                </div>
                                            </div>
                                            
                                            <!-- Display Added Features -->
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label">Selected Features</label>
                                                <div class="col-sm-10">
                                                    <ul id="feature_list"></ul>
                                                </div>
                                            </div>
                                            
                                            <!-- Hidden input to store selected features -->
                                            <input type="hidden" id="selected_features" name="features" value="[]">
                                            
                                            
                                            
                                        
                                            <div class="row justify-content-end">
                                                <div class="col-sm-10">
                                                    <button type="submit" id="savePlan" class="btn btn-success">Save Plan</button>
                                                </div>
                                            </div>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

                

    {{-- <script>
        $(document).ready(function() {
            $("#insertPlan").submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                let token = localStorage.getItem("auth_token");
                // Send AJAX request
                $.ajax({
                    type: "POST",
                    url: "{{ route('plans.store') }}",
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
                        $("#insertPlan").trigger("reset");
                        window.open("{{ url('/manage-plan') }}", "_self");
                    },
                    error: function(xhr, status, error) {
                        swal("Error", xhr.responseText, "error");
                    }
                });
            });
        });
    </script> --}}
    <script>
        $(document).ready(function () {
            let selectedFeatures = []; // Store added features
    
            $("#addFeature").click(function () {
                let featureText = $("#feature_input").val().trim(); // Get input value
    
                if (featureText && !selectedFeatures.includes(featureText)) {
                    selectedFeatures.push(featureText); // Add to array
    
                    // Update hidden input field
                    $("#selected_features").val(JSON.stringify(selectedFeatures));
    
                    // Show in the list
                    $("#feature_list").append(
                        `<li>${featureText} <a class="remove-feature" data-feature="${featureText}"><i class="ti ti-trash me-1"></i></a></li>`
                    );
    
                    $("#feature_input").val(""); // Clear input after adding
                }
            });
    
            // Remove feature on click
            $(document).on("click", ".remove-feature", function () {
                let featureToRemove = $(this).data("feature");
                selectedFeatures = selectedFeatures.filter(f => f !== featureToRemove);
    
                // Update hidden field
                $("#selected_features").val(JSON.stringify(selectedFeatures));
    
                // Remove from UI
                $(this).parent().remove();
            });
    
            // Handle Form Submission via AJAX
            $("#savePlan").click(function (e) {
                e.preventDefault();
    
                let formData = {
                    name: $("#name").val(),
                    description: $("#description").val(),
                    price: $("#price").val(),
                    duration: $("#duration").val(),
                    features: selectedFeatures 
                };
    
                let token = localStorage.getItem("auth_token"); 
    
                $.ajax({
                    type: "POST",
                    url: "{{ route('plans.store') }}",
                    data: JSON.stringify(formData),
                    dataType: "JSON",
                    contentType: "application/json",
                    headers: {
                        "Authorization": "Bearer " + token
                    },
                    success: function (response) {
                        swal("Success", response.message, "success");
                        $("#feature_list").empty();
                        selectedFeatures = [];
                    },
                    error: function (xhr) {
                        swal("Error", xhr.responseText, "error");
                    }
                });
            });
        });
    </script>
    
@endsection
