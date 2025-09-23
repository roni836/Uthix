@extends('admin.layout')
@section('title', 'Manage Orders')
@section('content')

   <div class="container-xxl flex-grow-1 container-p-y">

    <!-- Orders Card -->
    <div class="card shadow border-0 rounded-3">
        <!-- Header -->
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-bold text-dark">
                <i class="ti ti-shopping-bag me-2 text-primary"></i>Orders Management
            </h5>

            <!-- Filter/Search -->
            <div class="d-flex gap-2">
                <input type="text" class="form-control form-control-sm" placeholder="Search orders...">
                <select class="form-select form-select-sm">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                    <option value="canceled">Canceled</option>
                </select>
                <button class="btn btn-sm btn-primary">
                    <i class="ti ti-filter me-1"></i>Filter
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table align-middle table-hover mb-0">
                <thead class="bg-light text-muted">
                    <tr>
                        <th>#</th>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $key => $order)
                        <tr>
                            <!-- Index -->
                            <td class="fw-semibold text-muted">
                                {{ ($orders->currentPage() - 1) * $orders->perPage() + $key + 1 }}
                            </td>

                            <!-- Order ID -->
                            <td>
                                <span class="fw-bold text-dark">#{{ $order->order_number }}</span>
                            </td>

                            <!-- Customer -->
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" style="width:35px;height:35px;">
                                        {{ strtoupper(substr($order->user->name,0,1)) }}
                                    </div>
                                    <div>
                                        <span class="fw-semibold">{{ $order->user->name }}</span><br>
                                        <small class="text-muted">{{ $order->user->email }}</small>
                                    </div>
                                </div>
                            </td>

                            <!-- Total -->
                            <td class="fw-bold text-success">
                                ₹{{ number_format($order->total_amount, 2) }}
                            </td>

                            <!-- Payment Status -->
                            <td>
                                <span class="badge rounded-pill 
                                    @if($order->payment_status === 'paid') bg-success 
                                    @elseif($order->payment_status === 'pending') bg-warning text-dark 
                                    @else bg-secondary @endif">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>

                            <!-- Order Status -->
                            <td>
                                <span class="badge rounded-pill
                                    @if($order->status === 'completed') bg-success
                                    @elseif($order->status === 'pending') bg-info
                                    @elseif($order->status === 'canceled') bg-danger
                                    @else bg-secondary @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>

                            <!-- Date -->
                            <td class="text-muted">{{ $order->created_at->format('d M Y') }}</td>

                            <!-- Actions -->
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('orders.order-Details', $order->id) }}" class="btn btn-sm btn-outline-primary" title="View">
                                        <i class="ti ti-eye"></i>
                                    </a>
                                    
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="ti ti-shopping-cart-off text-muted fs-2"></i>
                                <p class="mt-2 mb-0 text-muted">No orders found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer / Pagination -->
        <div class="card-footer d-flex flex-wrap justify-content-between align-items-center">
            <div>{{ $orders->links() }}</div>
            <div class="fw-semibold text-muted">
                Page {{ $orders->currentPage() }} of {{ $totalPages }}
            </div>
        </div>
    </div>
</div>


@endsection
