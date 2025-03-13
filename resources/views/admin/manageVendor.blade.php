@extends('admin.layout')
@section('title', 'Manage Users')
@section('content')

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">

                        <!-- Hoverable Table rows -->
                        <div class="card">
                            <h5 class="card-header">Manage Vendors</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.no</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @if ($vendors->isEmpty())
                                            <tr>
                                                <td colspan="5" class="text-center mt-5">
                                                    No Data found
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($vendors as $i => $item)
                                                <tr>
                                                    <td>{{ $i + 1 }}.</td>
                                                    <td>{{ $item->user->name }}</td>
                                                    <td>{{ $item->class }}</td>
                                                    <td><span class="badge bg-label-primary me-1">Active</span></td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="ti ti-dots-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="javascript:void(0);">
                                                                    <i class="ti ti-pencil me-1"></i> Edit
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:void(0);">
                                                                    <i class="ti ti-trash me-1"></i> Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <!--/ Hoverable Table rows -->


                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl">
                            <div
                                class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                                <div class="text-body">
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>
                                    , made with ❤️ by <a href="https://trapigo.in/" target="_blank"
                                        class="footer-link">Trapigo</a>
                                </div>
                                <div class="d-none d-lg-inline-block">
                                    <a href="https://themeforest.net/licenses/standard" class="footer-link me-4"
                                        target="_blank">License</a>
                                    <a href="https://1.envato.market/pixinvent_portfolio" target="_blank"
                                        class="footer-link me-4">More Themes</a>

                                    <a href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation/"
                                        target="_blank" class="footer-link me-4">Documentation</a>

                                    <a href="https://pixinvent.ticksy.com/" target="_blank"
                                        class="footer-link d-none d-sm-inline-block">Support</a>
                                </div>
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


    <!-- / Navbar -->

    <!-- Content wrapper -->

@endsection
