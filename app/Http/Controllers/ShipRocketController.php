<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use App\Models\Vendor;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ShipRocketController extends Controller
// {
//     private $token;
//     private $apiUrl;

//     public function __construct() {
//         $this->apiUrl = env('SHIPROCKET_API_URL');
//         $this->authenticate();
//     }

//     /**
//      * Authenticate with Shiprocket API
//      */
//     private function authenticate() {
//         $response = Http::post("{$this->apiUrl}/auth/login", [
//             'email' => env('SHIPROCKET_EMAIL'),
//             'password' => env('SHIPROCKET_PASSWORD')
//         ]);

//         $data = $response->json();
//         if (isset($data['token'])) {
//             $this->token = $data['token'];
//         }
//     }

//     /**
//      * Create an Order for a Vendor
//      */
//     public function createOrder(Request $request) {
//         if (!$this->token) {
//             return response()->json(['error' => 'Authentication failed'], 401);
//         }

//         $request->validate([
//             'vendor_id' => 'required|exists:vendors,id',
//             'order_id' => 'required|unique:orders,order_id',
//             'customer_name' => 'required',
//             'address' => 'required',
//             'city' => 'required',
//             'pincode' => 'required',
//             'state' => 'required',
//             'email' => 'required|email',
//             'phone' => 'required',
//             'item_name' => 'required',
//             'item_sku' => 'required',
//             'item_units' => 'required|integer',
//             'item_price' => 'required|numeric',
//         ]);

//         $orderData = [
//             'order_id' => $request->order_id,
//             'order_date' => now()->format('Y-m-d H:i'),
//             'pickup_location' => 'Primary',
//             'billing_customer_name' => $request->customer_name,
//             'billing_address' => $request->address,
//             'billing_city' => $request->city,
//             'billing_pincode' => $request->pincode,
//             'billing_state' => $request->state,
//             'billing_email' => $request->email,
//             'billing_phone' => $request->phone,
//             'order_items' => [
//                 [
//                     'name' => $request->item_name,
//                     'sku' => $request->item_sku,
//                     'units' => $request->item_units,
//                     'selling_price' => $request->item_price,
//                 ]
//             ],
//             'payment_method' => 'Prepaid',
//             'sub_total' => $request->item_price * $request->item_units,
//         ];

//         $response = Http::withToken($this->token)->post("{$this->apiUrl}/orders/create/adhoc", $orderData);
//         $data = $response->json();

//         if (isset($data['order_id'])) {
//             Order::create([
//                 'vendor_id' => $request->vendor_id,
//                 'order_id' => $data['order_id'],
//                 'status' => $data['status'],
//                 'tracking_id' => $data['shipment_id'] ?? null,
//                 'courier_name' => $data['courier_name'] ?? null,
//             ]);

//             return response()->json(['success' => 'Order created successfully', 'data' => $data], 201);
//         } else {
//             return response()->json(['error' => 'Failed to create order', 'details' => $data], 400);
//         }
//     }

//     /**
//      * Track Order by Order ID
//      */
//     public function trackOrder($order_id) {
//         if (!$this->token) {
//             return response()->json(['error' => 'Authentication failed'], 401);
//         }

//         $response = Http::withToken($this->token)->get("{$this->apiUrl}/courier/track/awb/$order_id");
//         $data = $response->json();

//         return response()->json($data);
//     }
// }

{
    private $token;

    public function __construct() {
        $this->token = $this->getShiprocketToken();
    }

    /**
     * Get Shiprocket API Token
     */
    private function getShiprocketToken() {
        $client = new Client();
        $response = $client->post('https://apiv2.shiprocket.in/v1/external/auth/login', [
            'json' => [
                'email' => env('SHIPROCKET_EMAIL'),
                'password' => env('SHIPROCKET_PASSWORD'),
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['token'] ?? null;
    }

    /**
     * Add Vendor Pickup Location
     */
    public function addPickupLocation(Request $request) {

        try {
            $client = new Client();
            
            // Ensure token is set before making a request
            if (!isset($this->token)) {
                return response()->json(['error' => 'Unauthorized: Missing API token'], 401);
            }
    
            // Make the API request
            $response = $client->post('https://apiv2.shiprocket.in/v1/external/settings/company/addpickup', [
                'headers' => ['Authorization' => 'Bearer ' . $this->token, 'Content-Type' => 'application/json'],
                'json' => $request->all()
            ]);
    
            $data = json_decode($response->getBody(), true);
    
            // Save vendor details to the database
            // Vendor::create([
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'phone' => $request->phone,
            //     'address' => $request->address,
            //     'city' => $request->city,
            //     'state' => $request->state,
            //     'pincode' => $request->pin_code,
            //     'location_id' => $data['pickup_location_id'] ?? null
            // ]);
    
            return response()->json($data);
    
        } catch (RequestException $e) {
            return response()->json([
                'error' => 'Failed to add pickup location',
                'message' => $e->getMessage()
            ], 500);
        }
       
    }

    /**
     * Create Order
     */
    public function createOrder(Request $request) {
        $client = new Client();
        $response = $client->post('https://apiv2.shiprocket.in/v1/external/orders/create/adhoc', [
            'headers' => ['Authorization' => 'Bearer ' . $this->token],
            'json' => $request->all()
        ]);

        $data = json_decode($response->getBody(), true);

        // Save order to the database
        // Order::create([
        //     'order_id' => $data['order_id'] ?? null,
        //     'shipment_id' => $data['shipment_id'] ?? null,
        //     'awb' => $data['awb'] ?? null,
        //     'status' => 'pending',
        //     'total' => $request->total,
        //     'customer_name' => $request->customer_name,
        //     'customer_phone' => $request->customer_phone,
        //     'customer_address' => $request->customer_address
        // ]);

        return response()->json($data);
    }

    /**
     * Track Order Shipment
     */
    public function trackOrder($awb) {
        $client = new Client();
        $response = $client->get("https://apiv2.shiprocket.in/v1/external/courier/track/awb/$awb", [
            'headers' => ['Authorization' => 'Bearer ' . $this->token]
        ]);

        return response()->json(json_decode($response->getBody(), true));
    }

    /**
     * Webhook - Update Order Status
     */
    public function handleWebhook(Request $request) {
        Log::info('Shiprocket Webhook:', $request->all());

        Order::where('awb', $request->awb)->update([
            'status' => $request->current_status
        ]);

        return response()->json(['message' => 'Webhook received successfully']);
    }
}
