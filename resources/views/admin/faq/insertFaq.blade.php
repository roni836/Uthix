@extends('admin.layout')
@section('title', 'Insert FAQ')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xl">
            <div class="card mb-6">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Add New FAQ</h5>
                </div>
                <div class="card-body">
                    <form id="insertFAQ">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="question">Question</label>
                            <div class="col-sm-10">
                                <input type="text" name="question" id="question" class="form-control" placeholder="Enter Question" required />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="answer">Answer</label>
                            <div class="col-sm-10">
                                <textarea name="answer" id="answer" class="form-control" placeholder="Enter Answer"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="status">Status</label>
                            <div class="col-sm-10">
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" id="saveFAQ" class="btn btn-success">Save FAQ</button>
                            </div>
                        </div>
                    </form>                  
                </div>
            </div>
        </div>
    </div>
</div>

<!-- AJAX Script -->
<script>
    $(document).ready(function () {
        $("#insertFAQ").submit(function (e) {
            e.preventDefault();

            let formData = {
                question: $("#question").val(),
                answer: $("#answer").val(),
                status: $("#status").val()
            };

            let token = localStorage.getItem("auth_token");

            $.ajax({
                type: "POST",
                url: "{{ route('faqs.store') }}",
                data: JSON.stringify(formData),
                dataType: "JSON",
                contentType: "application/json",
                headers: {
                    "Authorization": "Bearer " + token
                },
                success: function (response) {
                    swal("Success", response.message, "success");
                    $("#insertFAQ").trigger("reset");
                    window.open("{{ url('/manage-faq') }}", "_self");
                },
                error: function (xhr) {
                    swal("Error", xhr.responseText, "error");
                }
            });
        });
    });
</script>

@endsection
