@extends('admin.layout')
@section('title', 'Manage Books')
@section('content')

                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">

                        <!-- Hoverable Table rows -->
                        <div class="card">
                            <h5 class="card-header">Manage coupons</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>code</th>
                                            <th>discount_type</th>
                                            <th>discount_value</th>
                                            <th>expiration_date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach($coupons as $key=>$data)
                                        <tr>
                                            <td>{{ ($coupons->currentPage() - 1) * $coupons->perPage() + $key + 1 }}</td>  
                                            <td>
                                                <span class="fw-medium">{{$data->code}}</span>
                                            </td>
                                            <td>{{$data->discount_type}}</td>
                                            <td>{{$data->discount_value}}</td>
                                            <td>{{$data->expiration_date}}</td>
                                            <td><span class="badge bg-label-primary me-1">Active</span></td>
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
                        <!--/ Hoverable Table rows -->
                        <div class="container mt-3 mb-3"> 
                            <div class="row align-items-center justify-content-between">
                                <div class="col-lg-6 d-flex justify-content-lg-start justify-content-center mb-2 mb-lg-0">
                                    {{ $coupons->links() }}
                                </div>
                                
                                <div class="col-lg-6 text-lg-end text-center">
                                    Page {{ $coupons->currentPage() }} of {{ $totalPages }}
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- / Content -->

@endsection
