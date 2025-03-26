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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 20px;
        }
    
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
    
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 20px;
        }
    
        .slider:before {
            position: absolute;
            content: "";
            height: 14px;
            width: 14px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
    
        input:checked+.slider {
            background-color: #4caf50;
        }
    
        input:checked+.slider:before {
            transform: translateX(20px);
        }
    </style>
    
</head>

<body>
    <!-- Layout wrapper -->

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            @include('admin.includes.navbar')
            <!-- Menu -->


            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="{{ url('') }}" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <svg width="32" height="22" viewBox="0 0 32 22" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                    fill="#7367F0" />
                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                                    fill="#161616" />
                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                                    fill="#161616" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                    fill="#7367F0" />
                            </svg>
                        </span>
                        <span class="app-brand-text demo menu-text fw-bold">Uthix</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
                        <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-users"></i>
                            <div data-i18n="User Management">User Management</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Manage Student">Manage Student</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="{{ url('insert-student') }}" class="menu-link">
                                            <div data-i18n="Add Student">Add Student</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{ url('manage-student') }}" class="menu-link">
                                            <div data-i18n="Student List">Student List</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Manage Instructor">Manage Instructor</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="{{ url('insert-instructor') }}" class="menu-link">
                                            <div data-i18n="Add Instructor">Add Instructor</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{ url('manage-instructor') }}" class="menu-link">
                                            <div data-i18n="Instructor List">Instructor List</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Manage Vendor">Manage Vendor</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="{{ url('insert-vendor') }}" class="menu-link">
                                            <div data-i18n="Add Vendor">Add Vendor</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{ url('manage-vendor') }}" class="menu-link">
                                            <div data-i18n="Vendor List">Vendor List</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-book"></i>
                            <div data-i18n="Course Management">Course Management</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('manage.class') }}" class="menu-link ">
                                    <div data-i18n="Class List">Class List</div>
                                </a>
                                <a href="{{ route('manage.plan') }}" class="menu-link ">
                                    <div data-i18n="Plan List">Plan List</div>
                                </a>
                                {{-- <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="app-ecommerce-category-list.html" class="menu-link">
                                            <div data-i18n="Class List">Class List</div>
                                        </a>
                                    </li>
                                </ul> --}}
                            </li>
                            {{-- <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Monitor Course Performance">Monitor Course Performance</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="app-ecommerce-product-add.html" class="menu-link">
                                            <div data-i18n="Add Product">Add Product</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="app-ecommerce-category-list.html" class="menu-link">
                                            <div data-i18n="Category List">Category List</div>
                                        </a>
                                    </li>
                                </ul>
                            </li> --}}
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-shopping-cart"></i>
                            <div data-i18n="E-Commerce Management">E-Commerce Management</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Vendors">Vendors</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="{{ route('manage.vendor') }}" class="menu-link">
                                            <div data-i18n="Vendors List">Vendors List</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{ route('insert.vendor') }}" class="menu-link">
                                            <div data-i18n="Add New Vendor">Add New Vendor</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Products">Products</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="{{ route('manage.product') }}" class="menu-link">
                                            <div data-i18n="Product List">Product List</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{ route('insert.product') }}" class="menu-link">
                                            <div data-i18n="Add Product">Add Product</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{ route('manage.category') }}" class="menu-link">
                                            <div data-i18n="Category List">Category List</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Coupon">Coupon</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="{{ route('manage.coupon') }}" class="menu-link">
                                            <div data-i18n="Coupon List">Coupon List</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{ route('insert.coupon') }}" class="menu-link">
                                            <div data-i18n="Add Coupon">Add Coupon</div>
                                        </a>
                                    </li>

                                </ul>
                            </li>




                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Order">Order</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="{{ url('/all-orders') }}" class="menu-link">
                                            <div data-i18n="Order List">All Order</div>
                                        </a>
                                    </li>
                                    {{-- <li class="menu-item">
                                        <a href="{{url('/admin-orders')}}" class="menu-link">
                                            <div data-i18n="Order Details">Admin Orders</div>
                                        </a>
                                    </li> --}}
                                </ul>
                            </li>
                            {{-- <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Customer">Customer</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="app-ecommerce-customer-all.html" class="menu-link">
                                            <div data-i18n="All Customers">All Customers</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <div data-i18n="Customer Details">Customer Details</div>
                                        </a>
                                        <ul class="menu-sub">
                                            <li class="menu-item">
                                                <a href="app-ecommerce-customer-details-overview.html"
                                                    class="menu-link">
                                                    <div data-i18n="Overview">Overview</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="app-ecommerce-customer-details-security.html"
                                                    class="menu-link">
                                                    <div data-i18n="Security">Security</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="app-ecommerce-customer-details-billing.html"
                                                    class="menu-link">
                                                    <div data-i18n="Address & Billing">Address & Billing</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="app-ecommerce-customer-details-notifications.html"
                                                    class="menu-link">
                                                    <div data-i18n="Notifications">Notifications</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Commission Settings">Commission Settings</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="app-ecommerce-settings-detail.html" class="menu-link">
                                            <div data-i18n="Store Details">Store Details</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="app-ecommerce-settings-payments.html" class="menu-link">
                                            <div data-i18n="Payments">Payments</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="app-ecommerce-settings-checkout.html" class="menu-link">
                                            <div data-i18n="Checkout">Checkout</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="app-ecommerce-settings-shipping.html" class="menu-link">
                                            <div data-i18n="Shipping & Delivery">Shipping & Delivery</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="app-ecommerce-settings-locations.html" class="menu-link">
                                            <div data-i18n="Locations">Locations</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="app-ecommerce-settings-notifications.html" class="menu-link">
                                            <div data-i18n="Notifications">Notifications</div>
                                        </a>
                                    </li>
                                </ul>
                            </li> --}}
                        </ul>
                    </li>
                    <!-- e-commerce-app menu end -->
                    <!-- Academy menu start -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-book"></i>
                            <div data-i18n="Live Classes">Live Classes</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link">
                                    <div data-i18n="Under Working">Under Working</div>
                                </a>
                            </li>
                            {{-- <li class="menu-item">
                                <a href="" class="menu-link">
                                    <div data-i18n="Monitor Live Session">Monitor Live Session</div>
                                </a>
                            </li> --}}
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-file"></i>
                            <div data-i18n="Reports & Analytics">Reports & Analytics</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link">
                                    <div data-i18n="Under Working">Under Working</div>
                                </a>
                            </li>
                            {{-- <li class="menu-item">
                                <a href="app-academy-dashboard.html" class="menu-link">
                                    <div data-i18n="Sales Reports">Sales Reports</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="app-academy-course.html" class="menu-link">
                                    <div data-i18n="Student Engagement Reports">Student Engagement Reports</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="app-academy-course-details.html" class="menu-link">
                                    <div data-i18n="Vendor Performance">Vendor Performance</div>
                                </a>
                            </li> --}}
                        </ul>
                    </li>
                    <!-- Academy menu end -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-truck"></i>
                            <div data-i18n="Shipping Settings">Shipping Settings</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link">
                                    <div data-i18n="Under Working">Under Working</div>
                                </a>
                            </li>
                            {{-- <li class="menu-item">
                                <a href="app-logistics-dashboard.html" class="menu-link">
                                    <div data-i18n="General Settings">General Settings</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="app-logistics-fleet.html" class="menu-link">
                                    <div data-i18n="Payment Gateway Configuration">Payment Gateway Configuration</div>
                                </a>
                            </li> --}}
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-settings"></i>
                            <div data-i18n="System Settings">System Settings</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link">
                                    <div data-i18n="Under working">Under Working</div>
                                </a>
                            </li>
                            {{-- <li class="menu-item">
                                <a href="app-logistics-dashboard.html" class="menu-link">
                                    <div data-i18n="General Settings">General Settings</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="app-logistics-fleet.html" class="menu-link">
                                    <div data-i18n="Payment Gateway Configuration">Payment Gateway Configuration</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="app-logistics-fleet.html" class="menu-link">
                                    <div data-i18n="Shipping Settings">Shipping Settings</div>
                                </a>
                            </li> --}}
                        </ul>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->
            <!-- Layout wrapper -->
            <div class="layout-wrapper layout-content-navbar">
                <div class="layout-container">
                    <!-- Menu -->

                    <!-- Layout container -->
                    <div class="layout-page">
                        <!-- Navbar -->

                        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                            id="layout-navbar">
                            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                                <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                                    <i class="ti ti-menu-2 ti-md"></i>
                                </a>
                            </div>

                            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                                <!-- Search -->
                                <div class="navbar-nav align-items-center">
                                    <div class="nav-item navbar-search-wrapper mb-0">
                                        <a class="nav-item nav-link search-toggler d-flex align-items-center px-0"
                                            href="javascript:void(0);">
                                            <i class="ti ti-search ti-md me-2 me-lg-4 ti-lg"></i>
                                            <span class="d-none d-md-inline-block text-muted fw-normal">Search
                                                (Ctrl+/)</span>
                                        </a>
                                    </div>
                                </div>
                                <!-- /Search -->

                                <ul class="navbar-nav flex-row align-items-center ms-auto">

                                    <!-- Style Switcher -->
                                    <li class="nav-item dropdown-style-switcher dropdown">
                                        <a class="nav-link btn btn-text-secondary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                            href="javascript:void(0);" data-bs-toggle="dropdown">
                                            <i class="ti ti-md"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-theme="light">
                                                    <span class="align-middle"><i
                                                            class="ti ti-sun ti-md me-3"></i>Light</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-theme="dark">
                                                    <span class="align-middle"><i
                                                            class="ti ti-moon-stars ti-md me-3"></i>Dark</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-theme="system">
                                                    <span class="align-middle"><i
                                                            class="ti ti-device-desktop-analytics ti-md me-3"></i>System</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- / Style Switcher-->

                                    <!-- Quick links  -->
                                    <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown">
                                        <a class="nav-link btn btn-text-secondary btn-icon rounded-pill btn-icon dropdown-toggle hide-arrow"
                                            href="javascript:void(0);" data-bs-toggle="dropdown"
                                            data-bs-auto-close="outside" aria-expanded="false">
                                            <i class="ti ti-layout-grid-add ti-md"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end p-0">
                                            <div class="dropdown-menu-header border-bottom">
                                                <div class="dropdown-header d-flex align-items-center py-3">
                                                    <h6 class="mb-0 me-auto">Shortcuts</h6>
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-text-secondary rounded-pill btn-icon dropdown-shortcuts-add"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Add shortcuts"><i
                                                            class="ti ti-plus text-heading"></i></a>
                                                </div>
                                            </div>
                                            <div class="dropdown-shortcuts-list scrollable-container">
                                                <div class="row row-bordered overflow-visible g-0">
                                                    <div class="dropdown-shortcuts-item col">
                                                        <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                                            <i class="ti ti-calendar ti-26px text-heading"></i>
                                                        </span>
                                                        <a href="app-calendar.html"
                                                            class="stretched-link">Calendar</a>
                                                        <small>Appointments</small>
                                                    </div>
                                                    <div class="dropdown-shortcuts-item col">
                                                        <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                                            <i class="ti ti-file-dollar ti-26px text-heading"></i>
                                                        </span>
                                                        <a href="app-invoice-list.html" class="stretched-link">Invoice
                                                            App</a>
                                                        <small>Manage Accounts</small>
                                                    </div>
                                                </div>
                                                <div class="row row-bordered overflow-visible g-0">
                                                    <div class="dropdown-shortcuts-item col">
                                                        <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                                            <i class="ti ti-user ti-26px text-heading"></i>
                                                        </span>
                                                        <a href="app-user-list.html" class="stretched-link">User
                                                            App</a>
                                                        <small>Manage Users</small>
                                                    </div>
                                                    <div class="dropdown-shortcuts-item col">
                                                        <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                                            <i class="ti ti-users ti-26px text-heading"></i>
                                                        </span>
                                                        <a href="app-access-roles.html" class="stretched-link">Role
                                                            Management</a>
                                                        <small>Permission</small>
                                                    </div>
                                                </div>
                                                <div class="row row-bordered overflow-visible g-0">
                                                    <div class="dropdown-shortcuts-item col">
                                                        <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                                            <i
                                                                class="ti ti-device-desktop-analytics ti-26px text-heading"></i>
                                                        </span>
                                                        <a href="index.html" class="stretched-link">Dashboard</a>
                                                        <small>User Dashboard</small>
                                                    </div>
                                                    <div class="dropdown-shortcuts-item col">
                                                        <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                                            <i class="ti ti-settings ti-26px text-heading"></i>
                                                        </span>
                                                        <a href="pages-account-settings-account.html"
                                                            class="stretched-link">Setting</a>
                                                        <small>Account Settings</small>
                                                    </div>
                                                </div>
                                                <div class="row row-bordered overflow-visible g-0">
                                                    <div class="dropdown-shortcuts-item col">
                                                        <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                                            <i class="ti ti-help ti-26px text-heading"></i>
                                                        </span>
                                                        <a href="pages-faq.html" class="stretched-link">FAQs</a>
                                                        <small>FAQs & Articles</small>
                                                    </div>
                                                    <div class="dropdown-shortcuts-item col">
                                                        <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                                            <i class="ti ti-square ti-26px text-heading"></i>
                                                        </span>
                                                        <a href="modal-examples.html"
                                                            class="stretched-link">Modals</a>
                                                        <small>Useful Popups</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- Quick links -->

                                    <!-- Notification -->
                                    <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
                                        <a class="nav-link btn btn-text-secondary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                            href="javascript:void(0);" data-bs-toggle="dropdown"
                                            data-bs-auto-close="outside" aria-expanded="false">
                                            <span class="position-relative">
                                                <i class="ti ti-bell ti-md"></i>
                                                <span
                                                    class="badge rounded-pill bg-danger badge-dot badge-notifications border"></span>
                                            </span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end p-0">
                                            <li class="dropdown-menu-header border-bottom">
                                                <div class="dropdown-header d-flex align-items-center py-3">
                                                    <h6 class="mb-0 me-auto">Notification</h6>
                                                    <div class="d-flex align-items-center h6 mb-0">
                                                        <span class="badge bg-label-primary me-2">8 New</span>
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-text-secondary rounded-pill btn-icon dropdown-notifications-all"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Mark all as read"><i
                                                                class="ti ti-mail-opened text-heading"></i></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="dropdown-notifications-list scrollable-container">
                                                <ul class="list-group list-group-flush">
                                                    <li
                                                        class="list-group-item list-group-item-action dropdown-notifications-item">
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar">
                                                                    <img src="../../assets/img/avatars/1.png" alt
                                                                        class="rounded-circle" />
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="small mb-1">Congratulation Lettie 🎉</h6>
                                                                <small class="mb-1 d-block text-body">Won the monthly
                                                                    best seller
                                                                    gold badge</small>
                                                                <small class="text-muted">1h ago</small>
                                                            </div>
                                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-notifications-read"><span
                                                                        class="badge badge-dot"></span></a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-notifications-archive"><span
                                                                        class="ti ti-x"></span></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li
                                                        class="list-group-item list-group-item-action dropdown-notifications-item">
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar">
                                                                    <span
                                                                        class="avatar-initial rounded-circle bg-label-danger">CF</span>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-1 small">Charles Franklin</h6>
                                                                <small class="mb-1 d-block text-body">Accepted your
                                                                    connection</small>
                                                                <small class="text-muted">12hr ago</small>
                                                            </div>
                                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-notifications-read"><span
                                                                        class="badge badge-dot"></span></a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-notifications-archive"><span
                                                                        class="ti ti-x"></span></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li
                                                        class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar">
                                                                    <img src="../../assets/img/avatars/2.png" alt
                                                                        class="rounded-circle" />
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-1 small">New Message ✉️</h6>
                                                                <small class="mb-1 d-block text-body">You have new
                                                                    message from
                                                                    Natalie</small>
                                                                <small class="text-muted">1h ago</small>
                                                            </div>
                                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-notifications-read"><span
                                                                        class="badge badge-dot"></span></a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-notifications-archive"><span
                                                                        class="ti ti-x"></span></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li
                                                        class="list-group-item list-group-item-action dropdown-notifications-item">
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar">
                                                                    <span
                                                                        class="avatar-initial rounded-circle bg-label-success"><i
                                                                            class="ti ti-shopping-cart"></i></span>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-1 small">Whoo! You have new order 🛒</h6>
                                                                <small class="mb-1 d-block text-body">ACME Inc. made
                                                                    new order
                                                                    $1,154</small>
                                                                <small class="text-muted">1 day ago</small>
                                                            </div>
                                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-notifications-read"><span
                                                                        class="badge badge-dot"></span></a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-notifications-archive"><span
                                                                        class="ti ti-x"></span></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li
                                                        class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar">
                                                                    <img src="../../assets/img/avatars/9.png" alt
                                                                        class="rounded-circle" />
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-1 small">Application has been approved 🚀
                                                                </h6>
                                                                <small class="mb-1 d-block text-body">Your ABC project
                                                                    application
                                                                    has been approved.</small>
                                                                <small class="text-muted">2 days ago</small>
                                                            </div>
                                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-notifications-read"><span
                                                                        class="badge badge-dot"></span></a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-notifications-archive"><span
                                                                        class="ti ti-x"></span></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li
                                                        class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar">
                                                                    <span
                                                                        class="avatar-initial rounded-circle bg-label-success"><i
                                                                            class="ti ti-chart-pie"></i></span>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-1 small">Monthly report is generated</h6>
                                                                <small class="mb-1 d-block text-body">July monthly
                                                                    financial
                                                                    report is generated </small>
                                                                <small class="text-muted">3 days ago</small>
                                                            </div>
                                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-notifications-read"><span
                                                                        class="badge badge-dot"></span></a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-notifications-archive"><span
                                                                        class="ti ti-x"></span></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li
                                                        class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar">
                                                                    <img src="../../assets/img/avatars/5.png" alt
                                                                        class="rounded-circle" />
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-1 small">Send connection request</h6>
                                                                <small class="mb-1 d-block text-body">Peter sent you
                                                                    connection
                                                                    request</small>
                                                                <small class="text-muted">4 days ago</small>
                                                            </div>
                                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-notifications-read"><span
                                                                        class="badge badge-dot"></span></a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-notifications-archive"><span
                                                                        class="ti ti-x"></span></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li
                                                        class="list-group-item list-group-item-action dropdown-notifications-item">
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar">
                                                                    <img src="../../assets/img/avatars/6.png" alt
                                                                        class="rounded-circle" />
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-1 small">New message from Jane</h6>
                                                                <small class="mb-1 d-block text-body">Your have new
                                                                    message from
                                                                    Jane</small>
                                                                <small class="text-muted">5 days ago</small>
                                                            </div>
                                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-notifications-read"><span
                                                                        class="badge badge-dot"></span></a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-notifications-archive"><span
                                                                        class="ti ti-x"></span></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li
                                                        class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar">
                                                                    <span
                                                                        class="avatar-initial rounded-circle bg-label-warning"><i
                                                                            class="ti ti-alert-triangle"></i></span>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-1 small">CPU is running high</h6>
                                                                <small class="mb-1 d-block text-body">CPU Utilization
                                                                    Percent is
                                                                    currently at 88.63%,</small>
                                                                <small class="text-muted">5 days ago</small>
                                                            </div>
                                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-notifications-read"><span
                                                                        class="badge badge-dot"></span></a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-notifications-archive"><span
                                                                        class="ti ti-x"></span></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="border-top">
                                                <div class="d-grid p-4">
                                                    <a class="btn btn-primary btn-sm d-flex"
                                                        href="javascript:void(0);">
                                                        <small class="align-middle">View all notifications</small>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <!--/ Notification -->

                                    <!-- User -->
                                    <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                        <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);"
                                            data-bs-toggle="dropdown">
                                            <div class="avatar avatar-online">
                                                <img src="../../assets/img/avatars/1.png" alt
                                                    class="rounded-circle" />
                                            </div>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item mt-0"
                                                    href="pages-account-settings-account.html">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <div class="avatar avatar-online">
                                                                <img src="../../assets/img/avatars/1.png" alt
                                                                    class="rounded-circle" />
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-0">John Doe</h6>
                                                            <small class="text-muted">Admin</small>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <div class="dropdown-divider my-1 mx-n2"></div>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="pages-profile-user.html">
                                                    <i class="ti ti-user me-3 ti-md"></i><span class="align-middle">My
                                                        Profile</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="pages-account-settings-account.html">
                                                    <i class="ti ti-settings me-3 ti-md"></i><span
                                                        class="align-middle">Settings</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="pages-account-settings-billing.html">
                                                    <span class="d-flex align-items-center align-middle">
                                                        <i class="flex-shrink-0 ti ti-file-dollar me-3 ti-md"></i><span
                                                            class="flex-grow-1 align-middle">Billing</span>
                                                        <span
                                                            class="flex-shrink-0 badge bg-danger d-flex align-items-center justify-content-center">4</span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <div class="dropdown-divider my-1 mx-n2"></div>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="pages-pricing.html">
                                                    <i class="ti ti-currency-dollar me-3 ti-md"></i><span
                                                        class="align-middle">Pricing</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="pages-faq.html">
                                                    <i class="ti ti-question-mark me-3 ti-md"></i><span
                                                        class="align-middle">FAQ</span>
                                                </a>
                                            </li>
                                            <li>
                                                <div class="d-grid px-2 pt-2 pb-1">
                                                    <a class="btn btn-sm btn-danger d-flex"
                                                        href="auth-login-cover.html" target="_blank">
                                                        <small class="align-middle">Logout</small>
                                                        <i class="ti ti-logout ms-2 ti-14px"></i>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <!--/ User -->
                                </ul>
                            </div>

                            <!-- Search Small Screens -->
                            <div class="navbar-search-wrapper search-input-wrapper d-none">
                                <input type="text" class="form-control search-input container-xxl border-0"
                                    placeholder="Search..." aria-label="Search..." />
                                <i class="ti ti-x search-toggler cursor-pointer"></i>
                            </div>
                        </nav>

                        <!-- / Navbar -->

                        <!-- Content wrapper -->
                        <div class="content-wrapper">
                            <!-- Layout container -->
                            @section('content')

                            @show



                            <!-- Footer -->
                            <footer class="content-footer footer bg-footer-theme">
                                <div class="container-xxl">
                                    <div
                                        class="footer-container d-flex align-items-center justify-content-center py-4 flex-md-row flex-column">
                                        <div class="text-body">
                                            ©
                                            <script>
                                                document.write(new Date().getFullYear());
                                            </script>
                                            , made with ❤️ by <a href="https://trapigo.in/" target="_blank"
                                                class="footer-link">Trapigo</a>
                                        </div>
                                        {{-- <div class="d-none d-lg-inline-block">
                                            <a href="https://themeforest.net/licenses/standard"
                                                class="footer-link me-4" target="_blank">License</a>
                                            <a href="https://1.envato.market/pixinvent_portfolio" target="_blank"
                                                class="footer-link me-4">More Themes</a>

                                            <a href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation/"
                                                target="_blank" class="footer-link me-4">Documentation</a>

                                            <a href="https://pixinvent.ticksy.com/" target="_blank"
                                                class="footer-link d-none d-sm-inline-block">Support</a>
                                        </div> --}}
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
            <!-- / Layout page -->
        </div>


        <!-- / Layout wrapper -->

        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->

        <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
        <script src="../../assets/vendor/libs/popper/popper.js"></script>
        <script src="../../assets/vendor/js/bootstrap.js"></script>
        <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>
        <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="../../assets/vendor/libs/hammer/hammer.js"></script>
        <script src="../../assets/vendor/libs/i18n/i18n.js"></script>
        <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>
        <script src="../../assets/vendor/js/menu.js"></script>

        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="../../assets/vendor/libs/apex-charts/apexcharts.js"></script>
        <script src="../../assets/vendor/libs/swiper/swiper.js"></script>
        <script src="../../assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>

        <!-- Main JS -->
        <script src="../../assets/js/main.js"></script>

        <!-- Page JS -->
        <script src="../../assets/js/dashboards-analytics.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

</body>

</html>
