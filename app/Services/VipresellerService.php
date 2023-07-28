<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class VipresellerService {
    
    public function getPaymentChannels()
    {
        
        $apikey = config('Tripay.api_key');
        
        $bearer = "Bearer $apikey";
        
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$apikey}",
            ])->get('https://tripay.co.id/api-sandbox/merchant/payment-channel');
            
            return $response;
        }
        
        public function getPrepaid()
        {
            
            $response = Http::asForm()->post('https://vip-reseller.co.id/api/prepaid', [
                'key' => 'Y5DIx6x6fBlCAtgkNuoneOnyMdem2q1cW179dVI0vk7HCWcfqVFUlsYw8PWLQ6oT',
                'sign' => '1b1b80cc71a67ee15a91d641b81733d2',
                'type' => 'services',
                'filter_type' => 'type',
                'filter_value' => 'pulsa-reguler',
            ]);
            
                // dd($response->body());
            if ($response->successful()) {
                // If the request is successful, decode and return the 'data' field from the JSON response.
                $result = json_decode($response)->data;
                return $result;
            } else {
                // If there's an error, handle it accordingly (e.g., log, return an error message, etc.).
                return "Error: " . $response->status() . " - " . $response->body();
            }
            
        }
        
        public function paymentGuzzle($request, $harga)
        {
            
            $apiKey       = config('Tripay.api_key');
            $privateKey   = config('Tripay.private_key');
            $merchantCode = 'T21486';
            $merchantRef  = 'INV6969';
            $amount       = intval($harga);
            
            $data = [
                'method'         => $request->metodepembayaran,
                'merchant_ref'   => $merchantRef,
                'amount'         => intval($harga),
                'customer_name'  => 'TAMU',
                'customer_email' => $request->email,
                'customer_phone' => $request->nohp,
                'order_items'    => [
                    [
                        'sku'         => $request->produk_id,
                        'name'        => $request->namaproduct,
                        'price'       => intval($harga),
                        'quantity'    => 1,
                        'product_url' => 'https://tokokamu.com/product/nama-produk-1',
                        'image_url'   => 'https://tokokamu.com/product/nama-produk-1.jpg',
                    ],
                    // [
                        //     'sku'         => 'FB-07',
                        //     'name'        => 'Nama Produk 2',
                        //     'price'       => 500000,
                        //     'quantity'    => 1,
                        //     'product_url' => 'https://tokokamu.com/product/nama-produk-2',
                        //     'image_url'   => 'https://tokokamu.com/product/nama-produk-2.jpg',
                        //     ]
                    ],
                    'return_url'   => 'https://domainanda.com/redirect',
                    'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
                    'signature'    => hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey)
                ];
                
                // dd($data);
                $apikey = config('Tripay.api_key');
                
                $bearer = "Bearer $apikey";
                
                $response = Http::withHeaders([
                    'Authorization' => "Bearer {$apikey}",
                    ])->post('https://tripay.co.id/api-sandbox/transaction/create', $data);
                    $responses = json_decode($response)->data;
                    // dd($responses);
                    return $responses;
                    
                }

        public function orderPulsa($product)
        {
            if($product->status === "PAID")
            {
                $response = Http::asForm()->post('https://vip-reseller.co.id/api/prepaid', [
                    'key' => 'Y5DIx6x6fBlCAtgkNuoneOnyMdem2q1cW179dVI0vk7HCWcfqVFUlsYw8PWLQ6oT',
                    'sign' => '1b1b80cc71a67ee15a91d641b81733d2',
                    'type' => 'order',
                    'service' => $product->pulsa_id,
                    'data_no' => $product->nohp
                ]);
                $responses = $response->body();
    
                return response()->json(['success' => $responses]);
                
            }else{

                return response()->json(['error' => "Gagal di proses"]);
            }
        }       

 }