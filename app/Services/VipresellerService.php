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
        $result = json_decode($response)->data;
        return $result;
        
    }
    
}