@extends('admin.layout')
@section('title', 'Manage Orders')
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
                            <h5 class="card-header">Manage Orders</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <tr class="bg-gray-100">

                                                <th class="">#</th>
                                                <th class="">Order</th>
                                                <th class="">Customer</th>
                                                <th class="">Total Amount</th>
                                                <th class="">Payment Status</th>
                                                <th class="">Status</th>
                                                <th class="">Date</th>
                                                <th class="">Actions</th>
                                            </tr>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        {{-- {{dd($orders)}} --}}
                                        @foreach($orders as $key => $order)
                                        <tr>
                                            <td class="">{{ $key + 1  }}</td>
                                            <td class="">{{ $order->order_number }}</td>
                                            <td class="">{{ $order->user->name }}</td>
                                            <td class="">₹{{ number_format($order->total_amount, 2) }}</td>
                                            <td class="">{{ ucfirst($order->payment_status) }}</td>
                                            <td class="">{{ ucfirst($order->status) }}</td>
                                            <td class="">{{ $order->created_at->format('d M Y') }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        {{-- <a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="ti ti-pencil me-1"></i> Edit</a> --}}
                                                        <a class="dropdown-item" href="{{ route('orders.order-Details', $order->id) }}"><i
                                                                class="ti ti-pencil me-1"></i> View</a>
                                                                {{-- <a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="ti ti-trash me-1"></i> Delete</a> --}}
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
