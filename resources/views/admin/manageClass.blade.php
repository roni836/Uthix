@extends('admin.layout')
@section('title', 'Manage Products')
@section('content')

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->


                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">

                        <!-- Hoverable Table rows -->
                        <div class="card">
                            <h5 class="card-header">Manage Classes</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Subject</th>
                                            <th>Section</th>
                                            <th>Capacity</th>
                                            <th>Scchedule</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach($classes as $data)
                                        <tr>
                                            <td>
                                                <span class="fw-medium">{{$data->class_name}}</span>
                                            </td>
                                            <td>
                                                <span class="fw-medium">{{$data->subject->name}}</span>
                                            </td>
                                            <td>
                                                <span class="fw-medium">{{$data->section ?? 'NUll'}}</span>
                                               
                                            </td>

                                             <td>
                                                <span class="fw-medium">{{$data->capacity ?? 'NULL'}}</span>
                                            </td>

                                             <td>
                                                <span class="fw-medium">{{$data->schedule ?? 'NULL'}}</span>
                                            </td>

                                            
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="ti ti-pencil me-1"></i>View detail</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
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
