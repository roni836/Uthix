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
                        @if (session('success'))
                            <div class="alert alert-success text-center">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Hoverable Table rows -->
                        <div class="card">
                            <h5 class="card-header">Manage Products</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>ISBN</th>
                                            <th>Is Published</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($products as $key=>$data)
                                            <tr>
                                                <td>{{ ($products->currentPage() - 1) * $products->perPage() + $key + 1 }}</td>  
                                                <td>
                                                    <span class="fw-medium">{{ $data->title }}</span>
                                                </td>
                                                <td>{{ $data->author }}</td>
                                                <td>{{ $data->isbn }}</td>
                                                <td>
                                                    <form action="{{ route('toggle.publish', $data->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <label class="switch">
                                                            <input type="checkbox" onchange="this.form.submit()"
                                                                {{ $data->is_published ? 'checked' : '' }}>
                                                            <span class="slider"></span>
                                                        </label>
                                                    </form>

                                                </td>

                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="ti ti-pencil me-1"></i> Edit</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="ti ti-trash me-1"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>



                    </div>
                    <div class="container mt-3 mb-3"> 
                        <div class="row align-items-center justify-content-between">
                            <div class="col-lg-6 d-flex justify-content-lg-start justify-content-center mb-2 mb-lg-0">
                                {{ $products->links() }}
                            </div>
                            
                            <div class="col-lg-6 text-lg-end text-center">
                                Page {{ $products->currentPage() }} of {{ $totalPages }}
                            </div>
                        </div>
                    </div>
                    
                    <!-- / Content -->

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

    <!-- / Navbar -->

    <!-- Content wrapper -->

@endsection
