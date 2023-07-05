<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ClientController extends Controller
{
    public function index()
    {
        $product = Product::all();
        
        
        return view('index',[
            'title' => "Produk Kita"
        ], compact('product'));
    }
    
    
    
    public function produk($id)
    {
        
        
        $apiKey = env('TRIPAY_API_KEY');
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/payment-channel',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ));
        
        $response = curl_exec($curl);
        $error = curl_error($curl);
        
        curl_close($curl);
        
        if ($error) {
            // Handle the cURL error appropriately
            echo "cURL Error: " . $error;
        } else {
            $result = json_decode($response)->data;
            // Process the response data as needed
        }
        
        
        
        
        
        
        $produk = Product::where('id', $id)->first();
        // dd($produk);
        return view('produk.produk',[
            'title' => "Pemesanan "
        ],compact('produk','result'));
    }
    
    
    
    
    public function pembayaran(Request $request)
    {
        
        // dd($request->all());
        
        $product = Product::find($request->id);
        // dd($product->harga);
        // dd(intval($product->harga));
        
        
        $apiKey       = env('TRIPAY_API_KEY');
        $privateKey   = env('TRIPAY_PRIVATE_KEY');
        $merchantCode = 'T21486';
        $merchantRef  = 'INV6969';
        $amount       = intval($request->product);
        // dd($amount);
        
        // // dd(intval($amount));
        //  $signature = hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey);
        // dd($signature);
        
        // 6d753d4e4225df642336e9458f46ddd9de2454c248e9bd2e9ffd3626bfaf22c3
        //   107f7744b5c7cb1d96a6b24f2c0dddf55ac7021971074110d116aa18746b6abd
        
        $data = [
            'method'         => $request->pembayaran,
            'merchant_ref'   => $merchantRef,
            'amount'         => intval($product->harga),
            'customer_name'  => 'TAMU',
            'customer_email' => $request->email,
            'customer_phone' => $request->nohp,
            'order_items'    => [
                [
                    'sku'         => 'FB-06',
                    'name'        => $request->produk_name,
                    'price'       => intval($product->harga),
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
                'expired_time' => (time() + (48 * 60 * 60)), // 48 jam
                'signature'    => hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey)
            ];
            
            
            $curl = curl_init();
            
            curl_setopt_array($curl, [
                CURLOPT_FRESH_CONNECT  => true,
                CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => false,
                CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
                CURLOPT_FAILONERROR    => false,
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => http_build_query($data),
                CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
            ]);
            
            $response = curl_exec($curl);
            $error = curl_error($curl);
            
            curl_close($curl);
            
            $result = (json_decode($response));
            
            if (json_decode($response)->success != true){
                // dd($result->message);
                return response()->json([
                    'Message' => $result->message,
                    
                ]);
            }else{
                $result  = json_decode($response)->data;
            }
            
            //   return $response ?: $error; 
            // if ($responses['success'] === true){
                
                // return $response;
                // }
                
                // return redirect()->back();
                
                // dd($result);
                $transaction = Transaction::create([
                    'reference' => $result->reference,
                    'amount' => $result->amount,
                    'status' => $result->status,
                ]);
                
                $order_items = $result->order_items;
                foreach ($order_items as $items){
                    $items;
                }
                
                
                
                return view ('payment.payment',[
                    'title' => "Pembayaran"
                ], compact('result','items'));
                
            }
            
            
            public function cek_invoice(Request $request)
            {
                return view('produk.cek-invoice',[
                    'title' => "Invoice"
                ]);
            }
            
            public function invoice(Request $request)
            {
                
                
                // dd($request->all());
                
    
                
                $apiKey = env('TRIPAY_API_KEY');
                
                $payload = ['reference'	=> $request->no_invoice];
                
                $curl = curl_init();
                
                curl_setopt_array($curl, [
                    CURLOPT_FRESH_CONNECT  => true,
                    CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/detail?'.http_build_query($payload),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HEADER         => false,
                    CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
                    CURLOPT_FAILONERROR    => false,
                    CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
                ]);
                
                $response = curl_exec($curl);
                $error = curl_error($curl);
                
                curl_close($curl);
                
                $result = json_decode($response)->data;

                $order_items = $result->order_items;
                foreach ($order_items as $items){
                    $items;
                }
                
          
                return view('payment.payment',[
                    'title' => "Invoice"
                ], compact('result','items'));
            }
            
            
        }
        
        
        
        