<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  
  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
  
  <!-- Google Fonts -->
  <link href="//fonts.gstatic.com" rel="preconnect">
  <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  
  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet ">
  <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
  
  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  
  <!-- =======================================================
    * Template Name: NiceAdmin - v2.4.1
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
    
    
  </head>
  
  <body>
    <!-- ======= Header ======= -->
    
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        
        <div class="d-flex align-items-center justify-content-between">
          <a href="index.html" class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">Produk Kita</span>
          </a>
          
        </div><!-- End Logo -->
        
        
        
        
        
      </div>
    </nav><!-- End Header -->
    <section class="mt-4 mb-5">
      <div class="container">
        <div class="card bg-light">
          <div class="card-header card text-white bg-danger">
            <span style="font-size:22px;">Invoice #NY040723011805393709</span>
          </div>
          <div class="card-body">
            <div class="alert alert-warning" role="alert">
              <span style="font-size:20px;">
                <i class="fa-solid fa-circle-info"></i> Mohon segera melakukan pembayaran sesuai "Total Bayar" sebelum 05 Jul 2023, 01:18:05 </span>
              </div>
              <div class="row">
                <div class="col-lg-3 mb-4">
                  <div class="card">
                    <img style="width:100%;" src="https://panel.nontonyuk.id/img/5.jpg" loading="lazy" alt="SPOTIFY PREMIUM" class="text-center">
                  </div>
                </div>
                <div class="col-lg">
                  <div class="card bg-light">
                    <div class="card-header">
                      <h3>Detail Transaksi</h3>
                    </div>
                    <div class="card-body">
                      <table width="100%">
                        <tbody>
                          <tr></tr>
                          <tr>
                            <th>Produk</th>
                            <td>{{ $items->name }}</td>
                            
                          </tr>
                          <tr>
                            <th>Item</th>
                            <td>SPOTIFY 1Bulan</td>
                          </tr>
                          <tr>
                            <th>Email</th>
                            <td>{{ $result->customer_email }}</td>
                          </tr>
                          <tr>
                            <th>Metode Pembayaran</th>
                            <td>{{ $result->payment_name }}</td>
                            
                          </tr>
                          <tr>
                            <th>Kode Referensi</th>
                            <td>{{ $result->reference }}</td>
                          </tr>
                          <tr>
                            <th>Total Bayar</th>
                            <td>
                              <mark style=" background-color: red;color: white;">Rp.{{ number_format($result->amount) }}</mark>
                            </td>
                          </tr>
                          <tr>
                            <th>Status Bayar</th>
                            <td>{{ $result->status }}</td>
                          </tr>
                        </tbody>
                      </table>
                      <p class="small mt-4">*Cek SPAM pada email jika detail akun tidak masuk.</p>
                    </div>
                  </div>
                  <div class="card mt-4 bg-light">
                    <div class="card-header">
                      <h3>Instruksi Pembayaran</h3>
                    </div>
                    @foreach ($result->instructions as $title )
                    <div class="card-body">
                      <span style="font-size:20px;">{{ $title->title }}</span>
                      <ul>
                        @foreach ($title->steps as $steps)
                          
                        <li>{!! $steps !!}</li>
                        @endforeach
                      </ul>
                        
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- ======= Footer ======= -->
      <div class="copyright">
        <div class="container">
          <div class="row">
            <div class="col-sm-12" style="text-align: center;">
              <p>Copyright © 2023 <a href="https://nontonyuk.id/">Belpora</a> - All Rights Reserved. </p>
            </div>
          </div>
        </div>
      </div><!-- End Footer -->
      
      <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
      
      <!-- Vendor JS Files -->
      <script src="{{  asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
      <script src="{{  asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{  asset('assets/vendor/chart.js/chart.min.js') }}"></script>
      <script src="{{  asset('assets/vendor/echarts/echarts.min.js') }}"></script>
      <script src="{{  asset('assets/vendor/quill/quill.min.js') }}"></script>
      <script src="{{  asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
      <script src="{{  asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
      <script src="{{  asset('assets/vendor/php-email-form/validate.js') }}"></script>
      
      
      
    </body>
    
    </html>
    