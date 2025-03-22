@extends('admin.layout')
@section('title', 'Insert Product')
@section('content')

  

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Basic Layout & Basic with Icons -->
                        <div class="row">
                            <!-- Basic with Icons -->
                            <div class="col-xl ">
                                <div class="card mb-6">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="mb-0">Add New Product</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id="insertProduct">
                                            <div class="row mb-6">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-fullname">Title</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2"
                                                            class="input-group-text"><i class="ti ti-user"></i></span>
                                                        <input type="text" name="title" class="form-control"
                                                            id="basic-icon-default-fullname" placeholder="John Doe"
                                                            aria-label="John Doe"
                                                            aria-describedby="basic-icon-default-fullname2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-fullname">Author</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2"
                                                            class="input-group-text"><i class="ti ti-user"></i></span>
                                                        <input type="text" name="author" class="form-control"
                                                            id="basic-icon-default-fullname" placeholder="John Doe"
                                                            aria-label="John Doe"
                                                            aria-describedby="basic-icon-default-fullname2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-fullname">Category</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2"
                                                            class="input-group-text"><i class="ti ti-user"></i></span>
                                                       
                                                            <select name="category_id" id="" class="form-select">
                                                                <option value="">Select category</option>
                                                                @foreach($category as $data)
                                                                    <option value="{{$data->id}}">{{$data->cat_title}}</option>
                                                                @endforeach
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-fullname">ISBN</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2"
                                                            class="input-group-text"><i class="ti ti-user"></i></span>
                                                        <input type="text" name="isbn" class="form-control"
                                                            id="basic-icon-default-fullname" placeholder="John Doe"
                                                            aria-label="954965263"
                                                            aria-describedby="basic-icon-default-fullname2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-fullname">No. of Pages</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2"
                                                            class="input-group-text"><i class="ti ti-user"></i></span>
                                                        <input type="number" name="pages" class="form-control"
                                                            id="basic-icon-default-fullname" placeholder="596"
                                                            aria-label="954"
                                                            aria-describedby="basic-icon-default-fullname2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="col-sm-2 form-label"
                                                    for="basic-icon-default-message">Description</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-message2" class="input-group-text"><i
                                                                class="ti ti-message-dots"></i></span>
                                                        <textarea id="basic-icon-default-message" name="description" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?"
                                                            aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-fullname">Thumbnail Image</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2"
                                                            class="input-group-text"><i class="ti ti-user"></i></span>
                                                        <input type="file" name="thumbnail_img" class="form-control"
                                                            id="basic-icon-default-fullname" placeholder="John Doe"
                                                            aria-label="John Doe"
                                                            aria-describedby="basic-icon-default-fullname2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-company">Rating</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-company2" class="input-group-text"><i
                                                                class="ti ti-building"></i></span>
                                                        <input type="number" max="5" name="rating" id="basic-icon-default-company"
                                                            class="form-control" placeholder="ACME Inc."
                                                            aria-label="ACME Inc."
                                                            aria-describedby="basic-icon-default-company2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-company">Price</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-company2" class="input-group-text"><i
                                                                class="ti ti-building"></i></span>
                                                        <input type="number" name="price" id="basic-icon-default-company"
                                                            class="form-control" placeholder="ACME Inc."
                                                            aria-label="ACME Inc."
                                                            aria-describedby="basic-icon-default-company2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-company">Discount Type</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-company2" class="input-group-text"><i
                                                                class="ti ti-building"></i></span>
                                                            <select name="discount_type" id="" class="form-select">
                                                                    <option value="">Select Type</option>
                                                                    <option value="">Percentage</option>
                                                                    <option value="">Amount</option>
                                                                </select>
                                                        <input type="" name="discount_price" id="basic-icon-default-company"
                                                            class="form-control" placeholder="ACME Inc."
                                                            aria-label="ACME Inc."
                                                            aria-describedby="basic-icon-default-company2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-company">Discount Value</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-company2" class="input-group-text"><i
                                                                class="ti ti-building"></i></span>
                                                        <input type="number" name="discount_price" id="basic-icon-default-company"
                                                            class="form-control" placeholder="ACME Inc."
                                                            aria-label="ACME Inc."
                                                            aria-describedby="basic-icon-default-company2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-company">Stock</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-company2" class="input-group-text"><i
                                                                class="ti ti-building"></i></span>
                                                        <input type="number" name="stock" id="basic-icon-default-company"
                                                            class="form-control" placeholder="ACME Inc."
                                                            aria-label="ACME Inc."
                                                            aria-describedby="basic-icon-default-company2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-company">Minimum Quantity</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-company2" class="input-group-text"><i
                                                                class="ti ti-building"></i></span>
                                                        <input type="number" name="min_qty" id="basic-icon-default-company"
                                                            class="form-control" placeholder="ACME Inc."
                                                            aria-label="ACME Inc."
                                                            aria-describedby="basic-icon-default-company2" />
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
                  


    <script>
        $(document).ready(function() {
            $("#insertProduct").submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                let token = localStorage.getItem("auth_token");
                // Send AJAX request
                $.ajax({
                    type: "POST",
                    url: "{{ route('books.store') }}",
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
                        $("#insertProduct").trigger("reset");
                        window.open("{{ url('/manage-product') }}", "_self");
                    },
                    error: function(xhr, status, error) {
                        swal("Error", xhr.responseText, "error");
                    }
                });
            });
        });
    </script>
@endsection
