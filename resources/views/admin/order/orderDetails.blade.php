@extends('admin.layout')
@section('title', 'Manage Orders')
@section('content')

  

                    <div class="container mx-auto p-4">
                        <h2 class="text-xl font-semibold mb-4">Order Details - #{{ $order->order_number }}</h2>

                        <div class="bg-white p-4 shadow rounded">
                            <h3 class="text-lg font-medium">Customer Details</h3>
                            <p><strong>Name:</strong> {{ $order->user->name }}</p>
                            <p><strong>Email:</strong> {{ $order->user->email }}</p>
                            <p><strong>Phone:</strong> {{ $order->user->phone ?? 'Null' }}</p>

                            <h3 class="text-lg font-medium mt-4">Order Information</h3>
                            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                            <p><strong>Total Amount:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
                            <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>
                            <p><strong>Payment Method:</strong> {{ $order->payment_method ?? 'Not Provided' }}</p>

                            @if ($order->coupon)
                                <p><strong>Coupon Applied:</strong> {{ $order->coupon->code }}
                                    ({{ $order->coupon->discount }}% Off)</p>
                            @endif

                            <h3 class="text-lg font-medium mt-4">Shipping Details</h3>
                            @if ($order->address)
                                <p><strong>Address:</strong> {{ $order->address->street }}, {{ $order->address->city }}
                                </p>
                                <p><strong>Pin Code:</strong> {{ $order->address->postal_code }}</p>
                            @else
                                <p>No address provided.</p>
                            @endif
                        </div>

                        <h3 class="text-lg font-semibold mt-6">Order Items</h3>
                        <div class="bg-white p-4 shadow rounded">
                            <table class="table-auto w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border p-2">Product</th>
                                        <th class="border p-2">Quantity</th>
                                        <th class="border p-2">Price</th>
                                        <th class="border p-2">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td class="border p-2">{{ $item->product->title }}</td>
                                            <td class="border p-2">{{ $item->quantity }}</td>
                                            <td class="border p-2">₹{{ number_format($item->price, 2) }}</td>
                                            <td class="border p-2">₹{{ number_format($item->total_price, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>



    <!-- / Navbar -->

    <!-- Content wrapper -->

@endsection
