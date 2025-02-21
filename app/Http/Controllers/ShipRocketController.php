<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Order;
use App\Models\Vendor;

class ShipRocketController extends Controller
{
    private $token;
    private $apiUrl;

    public function __construct() {
        $this->apiUrl = env('SHIPROCKET_API_URL');
        $this->authenticate();
    }

    /**
     * Authenticate with Shiprocket API
     */
    private function authenticate() {
        $response = Http::post("{$this->apiUrl}/auth/login", [
            'email' => env('SHIPROCKET_EMAIL'),
            'password' => env('SHIPROCKET_PASSWORD')
        ]);

        $data = $response->json();
        if (isset($data['token'])) {
            $this->token = $data['token'];
        }
    }

    /**
     * Create an Order for a Vendor
     */
    public function createOrder(Request $request) {
        if (!$this->token) {
            return response()->json(['error' => 'Authentication failed'], 401);
        }

        $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
            'order_id' => 'required|unique:orders,order_id',
            'customer_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'state' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'item_name' => 'required',
            'item_sku' => 'required',
            'item_units' => 'required|integer',
            'item_price' => 'required|numeric',
        ]);

        $orderData = [
            'order_id' => $request->order_id,
            'order_date' => now()->format('Y-m-d H:i'),
            'pickup_location' => 'Primary',
            'billing_customer_name' => $request->customer_name,
            'billing_address' => $request->address,
            'billing_city' => $request->city,
            'billing_pincode' => $request->pincode,
            'billing_state' => $request->state,
            'billing_email' => $request->email,
            'billing_phone' => $request->phone,
            'order_items' => [
                [
                    'name' => $request->item_name,
                    'sku' => $request->item_sku,
                    'units' => $request->item_units,
                    'selling_price' => $request->item_price,
                ]
            ],
            'payment_method' => 'Prepaid',
            'sub_total' => $request->item_price * $request->item_units,
        ];

        $response = Http::withToken($this->token)->post("{$this->apiUrl}/orders/create/adhoc", $orderData);
        $data = $response->json();

        if (isset($data['order_id'])) {
            Order::create([
                'vendor_id' => $request->vendor_id,
                'order_id' => $data['order_id'],
                'status' => $data['status'],
                'tracking_id' => $data['shipment_id'] ?? null,
                'courier_name' => $data['courier_name'] ?? null,
            ]);

            return response()->json(['success' => 'Order created successfully', 'data' => $data], 201);
        } else {
            return response()->json(['error' => 'Failed to create order', 'details' => $data], 400);
        }
    }

    /**
     * Track Order by Order ID
     */
    public function trackOrder($order_id) {
        if (!$this->token) {
            return response()->json(['error' => 'Authentication failed'], 401);
        }

        $response = Http::withToken($this->token)->get("{$this->apiUrl}/courier/track/awb/$order_id");
        $data = $response->json();

        return response()->json($data);
    }
}
