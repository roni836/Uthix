@extends('admin.layout')
@section('title', 'Login')
@section('content')

<div class="container">
    <div class="card">
        <h5 class="card-header">Login</h5>
        <form id="loginForm" class="card-body">
            @csrf  {{-- CSRF token for security --}}
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="email">Email</label>
                <div class="col-sm-9">
                    <input type="email" id="email" name="email" class="form-control" placeholder="john.doe@example.com" required />
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="password">Password</label>
                <div class="col-sm-9">
                    <input type="password" id="password" name="password" class="form-control" placeholder="********" required />
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="role">Select Role</label>
                <div class="col-sm-9">
                    <select id="role" name="role" class="form-control">
                        <option value="student">Student</option>
                        <option value="admin">Admin</option>
                        <option value="seller">Seller</option>
                        <option value="instructor">Instructor</option>
                    </select>
                </div>
            </div>

            <div class="row justify-content-end">
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary me-4">Login</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#loginForm").submit(function(e) {
            e.preventDefault(); // Prevent page reload

            let formData = {
                email: $("#email").val(),
                password: $("#password").val(),
                role: $("#role").val(),
            };

            $.ajax({
                type: "POST",
                url: "{{ route('login.post') }}",  // Ensure this route exists
                data: JSON.stringify(formData),  
                contentType: "application/json",
                headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") }, // CSRF token
                success: function(response) {
                    swal("Success", "Login successful!", "success");

                    // Store token in localStorage
                    localStorage.setItem("access_token", response.access_token);

                    // Redirect user based on role
                    switch(response.role) {
                        case "admin":
                            window.location.href = "{{ url('/') }}";
                            break;
                        case "student":
                            window.location.href = "{{ url('/student-dashboard') }}";
                            break;
                        case "seller":
                            window.location.href = "{{ url('/seller-dashboard') }}";
                            break;
                        case "instructor":
                            window.location.href = "{{ url('/instructor-dashboard') }}";
                            break;
                        default:
                            window.location.href = "{{ url('/') }}";
                    }
                },
                error: function(xhr) {
                    let errorMessage = xhr.responseJSON?.message || "Login failed!";
                    swal("Error", errorMessage, "error");
                }
            });
        });
    });
</script>

@endsection
