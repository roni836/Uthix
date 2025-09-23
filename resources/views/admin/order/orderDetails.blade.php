@extends('admin.layout')
@section('title', 'Manage Orders')
@section('content')

    <div class="container mx-auto p-6 space-y-6">

        <!-- Page Title -->
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">
                Order Details <span class="text-gray-500">#{{ $order->order_number }}</span>
            </h2>
            @php $status = strtolower($order->status); @endphp

            <span
                class="badge 
             @if ($status === 'completed') bg-success
             @elseif($status === 'pending') bg-warning text-dark
             @elseif($status === 'canceled') bg-danger
             @else bg-secondary @endif">
                {{ ucfirst($status) }}
            </span>

        </div>

        <!-- Customer & Order Info -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Customer Card -->
            <div class="bg-white shadow rounded-lg p-5">
                <h3 class="text-lg font-semibold text-gray-700 mb-3 border-b pb-2">👤 Customer Details</h3>
                <p class="mb-1"><strong>Name:</strong> {{ $order->user->name }}</p>
                <p class="mb-1"><strong>Email:</strong> {{ $order->user->email }}</p>
                <p><strong>Phone:</strong> {{ $order->user->phone ?? 'N/A' }}</p>
            </div>

            <!-- Order Info Card -->
            <div class="bg-white shadow rounded-lg p-5">
                <h3 class="text-lg font-semibold text-gray-700 mb-3 border-b pb-2">🛒 Order Information</h3>
                <p class="mb-1"><strong>Total Amount:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
                <p class="mb-1"><strong>Payment Status:</strong>
                    <span
                        class="px-2 py-1 rounded-full text-sm
                    @if ($order->payment_status === 'paid') bg-green-100 text-green-700
                    @elseif($order->payment_status === 'pending') bg-yellow-100 text-yellow-700
                    @else bg-gray-200 text-gray-700 @endif">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </p>
                <p class="mb-1"><strong>Payment Method:</strong> {{ $order->payment_method ?? 'Not Provided' }}</p>

                @if ($order->coupon)
                    <p><strong>Coupon:</strong>
                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-sm">
                            {{ $order->coupon->code }} ({{ $order->coupon->discount }}% Off)
                        </span>
                    </p>
                @endif
            </div>
        </div>

        <!-- Shipping -->
        <div class="bg-white shadow rounded-lg p-5">
            <h3 class="text-lg font-semibold text-gray-700 mb-3 border-b pb-2">🚚 Shipping Details</h3>
            @if ($order->address)
                <p class="mb-1"><strong>Address:</strong> {{ $order->address->street }}, {{ $order->address->city }}</p>
                <p><strong>Pin Code:</strong> {{ $order->address->postal_code }}</p>
            @else
                <p class="text-gray-500">No shipping address provided.</p>
            @endif
        </div>

        <!-- Order Items -->
        <div class="bg-white shadow rounded-lg p-5">
            <h3 class="text-lg font-semibold text-gray-700 mb-3 border-b pb-2">📦 Order Items</h3>
            <table class="w-full text-sm text-left border border-gray-200 rounded-lg">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3">Product</th>
                        <th class="px-4 py-3">Quantity</th>
                        <th class="px-4 py-3">Price</th>
                        <th class="px-4 py-3">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-800">
                                {{ $item->product->title }}
                            </td>
                            <td class="px-4 py-3">{{ $item->quantity }}</td>
                            <td class="px-4 py-3">₹{{ number_format($item->price, 2) }}</td>
                            <td class="px-4 py-3 font-semibold text-gray-900">
                                ₹{{ number_format($item->total_price, 2) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



    <!-- / Navbar -->

    <!-- Content wrapper -->

@endsection
