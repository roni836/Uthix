<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title') - {{ env('APP_NAME') }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->

    <link rel="stylesheet" href="../../assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />

    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css" />

    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/swiper/swiper.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/pages/cards-advance.css" />

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../../assets/vendor/js/template-customizer.js"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>
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






    
</body>
</html>