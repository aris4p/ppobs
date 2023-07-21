<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Transaction;
use App\Models\Product;
use App\Http\Controllers\Controller;

class TripayCallbackController extends Controller
{
    // Isi dengan private key anda
    protected $privateKey = 'Dcj0j-2LWTS-9LfpV-YXtne-L1cqN';

    public function handle(Request $request)
    {
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');
        $json = $request->getContent();
        $signature = hash_hmac('sha256', $json, $this->privateKey);

        if ($signature !== (string) $callbackSignature) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid signature',
            ]);
        }

        if ('payment_status' !== (string) $request->server('HTTP_X_CALLBACK_EVENT')) {
            return Response::json([
                'success' => false,
                'message' => 'Unrecognized callback event, no action was taken',
            ]);
        }

        $data = json_decode($json);
        
        if (JSON_ERROR_NONE !== json_last_error()) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid data sent by tripay',
            ]);
        }

     
        $tripayReference = $data->reference;
        $status = strtoupper((string) $data->status);
        
        if ($data->is_closed_payment === 1) {
            $transaksi = Transaction::where('reference', $tripayReference)
                ->where('status', 'UNPAID')
                ->first();
        
            if (! $transaksi) {
                return Response::json([
                    'success' => false,
                    'message' => 'No transaksi found or already paid: ' . $tripayReference,
                ]);
            }

            switch ($status) {
                case 'PAID':
                    $transaksi->update(['status' => 'PAID']);
                    break;

                case 'EXPIRED':
                    $transaksi->update(['status' => 'EXPIRED']);
                    break;

                case 'FAILED':
                    $transaksi->update(['status' => 'FAILED']);
                    break;

                default:
                    return Response::json([
                        'success' => false,
                        'message' => 'Unrecognized payment status',
                    ]);
            }

            $product = Transaction::with('product')
            ->where('reference',$data->reference)
            ->first();

            if($product->status == "EXPIRED")
            {
                $total = $product->product->qty+1;
                $produk = Product::where('id', $product->product_id );
                $produk->update(['qty' => $total]);
            }

            return Response::json(['success' => true]);
        }
    }
}
