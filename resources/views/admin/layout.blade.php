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
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="index.html" class="app-brand-link">
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
                                        <a href="{{url('insert-user')}}" class="menu-link">
                                            <div data-i18n="Add User">Add User</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{url('manage-user')}}" class="menu-link">
                                            <div data-i18n="User List">User List</div>
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
                            </li>
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Manage Vendor">Manage Vendor</div>
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
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Approve Courses">Approve Courses</div>
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
                            </li>
                            <li class="menu-item">
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
                            </li>
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
                                    <div data-i18n="Products">Products</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="app-ecommerce-product-list.html" class="menu-link">
                                            <div data-i18n="Product List">Product List</div>
                                        </a>
                                    </li>
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
                            </li>
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Order">Order</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="app-ecommerce-order-list.html" class="menu-link">
                                            <div data-i18n="Order List">Order List</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="app-ecommerce-order-details.html" class="menu-link">
                                            <div data-i18n="Order Details">Order Details</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item">
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
                            </li>
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
                                <a href="app-academy-dashboard.html" class="menu-link">
                                    <div data-i18n="Monitor Live Session">Monitor Live Session</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-file"></i>
                            <div data-i18n="Reports & Analytics">Reports & Analytics</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
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
                            </li>
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
                                <a href="app-logistics-dashboard.html" class="menu-link">
                                    <div data-i18n="General Settings">General Settings</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="app-logistics-fleet.html" class="menu-link">
                                    <div data-i18n="Payment Gateway Configuration">Payment Gateway Configuration</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-settings"></i>
                            <div data-i18n="System Settings">System Settings</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
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
                            </li>
                        </ul>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            @section('content')

            @show

            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
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
</body>

</html>
