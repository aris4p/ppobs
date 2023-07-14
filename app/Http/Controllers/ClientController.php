<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Transaction;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\TripayService;

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
// dd($result);
        // Menggunakan Curl    
        // $result = $this->tripayService->payment($request, $product);  
        
        // dd($result)
        $str =  strtoupper(Str::random(12));
        $invoice_id ="PK-$str";
        // dd(strtoupper($invoice_id));
        $transaction = Transaction::create([
            'invoice' => $invoice_id,
            'reference' => $result->reference,
            'amount' => $result->amount,
            'status' => $result->status,
            'createdAt' => $result->expired_time
        ]);
        
        $order_items = $result->order_items;
        foreach ($order_items as $items){
            $items;
        }
        
        return redirect()->route('invoice',['no_invoice' => $transaction->invoice]);
      
        // return view ('payment.payment',[
        //     'title' => "Pembayaran"
        // ], compact('result','items','transaction'));
        
    }
    
    
    public function cek_invoice(Request $request)
    {
        return view('produk.cek-invoice',[
            'title' => "Invoice"
        ]);
    }
    
    public function invoice(Request $request)
    {
        $transaction = Transaction::where('invoice', $request->no_invoice)->first();
        // Tripay Service
        $result = $this->tripayService->invoice($request, $transaction);
        // dd($result);

        $order_items = $result->order_items;
        foreach ($order_items as $items){
            $items;
        }
        
        
  
        
      
        return view('payment.payment',[
            'title' => "Invoice"
        ], compact('result','items','transaction'));
    }
    
    
}



