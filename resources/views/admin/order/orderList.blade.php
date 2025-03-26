@extends('admin.layout')
@section('title', 'Manage Orders')
@section('content')


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
                                            <td>{{ ($orders->currentPage() - 1) * $orders->perPage() + $key + 1 }}</td>  
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

                        <div class="container mt-3 mb-3"> 
                            <div class="row align-items-center justify-content-between">
                                <div class="col-lg-6 d-flex justify-content-lg-start justify-content-center mb-2 mb-lg-0">
                                    {{ $orders->links() }}
                                </div>
                                
                                <div class="col-lg-6 text-lg-end text-center">
                                    Page {{ $orders->currentPage() }} of {{ $totalPages }}
                                </div>
                            </div>
                        </div>
                    </div>


                  
@endsection
