<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\VipresellerService;
use App\Services\TripayService;

class VipresellerController extends Controller
{
    public function __construct(VipresellerService $vipresellerService, TripayService $tripayService )
    {
        $this->vipresellerService = $vipresellerService;
        $this->tripayService = $tripayService;
    }

    public function pulsa($kode)
    {
        $responses = $this->tripayService->getPaymentChannelsLaravel();  
        $result = json_decode($responses)->data;
        $result1 = $this->vipresellerService->getPrepaid(); 
        
        $filteredResults = [];
        foreach ($result1 as $results) {
            if ($results->brand === $kode && $results->status === "available") {
                $filteredResults[] = $results;
            }
        }
        // dd($filteredResults);
        
       
        // Urutkan array berdasarkan harga (asumsi $results->price adalah angka)
        usort($filteredResults, function ($a, $b) {
            return $a->price->basic - $b->price->basic; // Mengurutkan dari harga terendah ke tertinggi
            // Untuk mengurutkan dari harga tertinggi ke terendah, ganti urutan kedua variabel di atas ($a->price - $b->price) menjadi ($b->price - $a->price).
        });
        // dd($filteredResults);
        return view('vip.pulsa',[
            'title' => "PULSA"
        ], compact('result','filteredResults'));

    }
    
    public function getPulsaPrepaid()
    {
        $result = $this->vipresellerService->getPrepaid(); 
        
        $filteredResults = [];
        foreach ($result as $results) {
            if ($results->status === "available") {
                $filteredResults[] = $results;
            }
        }
        
       
        // Urutkan array berdasarkan harga (asumsi $results->price adalah angka)
        usort($filteredResults, function ($a, $b) {
            return $a->price->basic - $b->price->basic; // Mengurutkan dari harga terendah ke tertinggi
            // Untuk mengurutkan dari harga tertinggi ke terendah, ganti urutan kedua variabel di atas ($a->price - $b->price) menjadi ($b->price - $a->price).
        });

        // dd($filteredResults);
        
        return view('vip.pulsa', compact('filteredResults'));
        
    }
}
