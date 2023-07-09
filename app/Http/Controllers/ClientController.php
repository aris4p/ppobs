<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Services\TripayService;

use Carbon\Carbon;

class ClientController extends Controller
{
    public function __construct(TripayService $tripayService)
    {
        $this->tripayService = $tripayService;
    }
    
    public function index()
    {
        $product = Product::all();
        
        
        return view('index',[
            'title' => "Produk Kita"
        ], compact('product'));
    }
    
    
    
    public function produk($id)
    {

        // Menggunakan HTTP Client Guzzle Laravel
        $responses = $this->tripayService->getPaymentChannelsLaravel();  
        $result = json_decode($responses)->data;
       
        // Menggunakan CURL
        // $result = $this->tripayService->getPaymentChannels();  
    
        $produk = Product::where('id', $id)->first();
        // dd($produk);
        return view('produk.produk',[
            'title' => "Pemesanan "
        ],compact('produk','result'));
    }
    
    
    
    
    public function pembayaran(Request $request)
    {
      
        $product = Product::find($request->id);
        // mEnggunakan Guzzle
        $result = $this->tripayService->paymentGuzzle($request, $product);  
        
        // Menggunakan Curl    
        // $result = $this->tripayService->payment($request, $product);  
        
        
        $transaction = Transaction::create([
            'reference' => $result->reference,
            'amount' => $result->amount,
            'status' => $result->status,
        ]);
        
        $order_items = $result->order_items;
        foreach ($order_items as $items){
            $items;
        }
        
        $epochTime = $result->expired_time; // Contoh waktu epoch
        
        // Konversi waktu epoch ke waktu lokal
        $localTime = Carbon::createFromTimestamp($epochTime)->format('d-m-Y , H:i:s');
        
        return view ('payment.payment',[
            'title' => "Pembayaran"
        ], compact('result','items','localTime'));
        
    }
    
    
    public function cek_invoice(Request $request)
    {
        return view('produk.cek-invoice',[
            'title' => "Invoice"
        ]);
    }
    
    public function invoice(Request $request)
    {
        // Tripay Service
        $result = $this->tripayService->invoice($request);

        $order_items = $result->order_items;
        foreach ($order_items as $items){
            $items;
        }
        
        $epochTime = $result->expired_time; // Contoh waktu epoch
        
        // Konversi waktu epoch ke waktu lokal
        $localTime = Carbon::createFromTimestamp($epochTime)->format('d-m-Y , H:i:s');
        
        
        
        
        return view('payment.payment',[
            'title' => "Invoice"
        ], compact('result','items','localTime'));
    }
    
    
}



