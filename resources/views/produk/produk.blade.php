<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    
    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    
    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    
    <!-- Google Fonts -->
    <link href="//fonts.gstatic.com" rel="preconnect">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    
    
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
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    
    
    
    
    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    
    
    
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
        <section class="mt-4 mb-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <div class="card pt-4 pb-4 bg-light">
                            <div class="container">
                                <img style="border-radius:20px;width:100%;" src="https://nontonyuk.id/template/img/game/mobile-legends.jpeg" loading="lazy" alt="" class="text-center">
                                <div class="judul-produk pt-4">
                                    <h1 style="font-size:24px;"></h1>
                                    <!-- <h2 style="font-size:20px;"></h2> -->
                                </div>
                                <div class="deskripsi-produk pt-4">
                                    <p>Top up diamond Mobile Legends resmi Moonton 100% legal. Cara beli dm ML termurah. </p>
                                    <ul>
                                        <li>Masukkan ID</li>
                                        <li>Masukkan SERVER ID</li>
                                        <li>Pilih Nominal</li>
                                        <li>Pilih Pembayaran</li>
                                        <li>Klik Pesan Sekarang &amp; lakukan Pembayaran</li>
                                        <li>Diamonds masuk otomatis ke akun Anda </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-lg-8">
                        
                        <form action="{{ route("pembayaran") }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $produk->id }}" name="id">
                            <div class="card mb-4 bg-light">
                                <div class="card-header card text-white bg-danger">
                                    <span style="font-size:20px;">Lengkapi Data Pemesanan</span>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-12 pb-2">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input id="email" name="email" type="email" class="form-control" placeholder="Masukkan Email yang Valid" aria-label="Email" required="">
                                            </div>
                                            <div style="font-size:12px;margin:10px 0 0 2px;">Pengiriman otomatis ke alamat email. Pastikan menulis alamat Email&nbsp;dengan&nbsp;benar</div>
                                        </div>
                                        <div class="col-lg-6 col-12 pb-2">
                                            <div class="form-group">
                                                <label>No. Handphone</label>
                                                <input name="nohp" id="nohp" type="number" class="form-control" placeholder="Masukkan No.Hp (contoh:081xxxxxxxx)" aria-label="NoHp" required="">
                                            </div>
                                            <div style="font-size:12px;margin:10px 0 0 2px;">Pastikan Nomor Handphone yang kalian masukan Terhubung Dengan ovo &amp; ShopepayJika memilih metode pembayaran&nbsp;tersebut</div>
                                        </div>
                                    </div>
                                    <p></p>
                                </div>
                            </div>
                            <div class="card bg-light mb-4">
                                <div class="card-header card text-white bg-danger">
                                    <span style="font-size:20px;">Pilih Nominal</span>
                                </div>
                                <div class="card-body">
                                    {{-- <div class="row">
                                        
                                        
                                        <div class="col-lg-4 col-6">
                                            <input class="btn-check" type="radio" name="harga" id="harga" required="">
                                            <label class="btn btn-check-outline-danger pt-2 pb-2" style="width:100%; margin:0px;">
                                                <small>{{ $produk->nama }}</small>
                                                <br>
                                                <small>{{ $produk->harga }}</small>
                                            </label>
                                        </div>
                                        
                                        
                                        
                                        
                                    </div> --}}
                                    
                                    <div class="row">
                                        
                                        <div class="col-md-4 col-lg-4 col-sm-4">
                                            
                                            <label>
                                                <input type="hidden" value="{{ $produk->nama }}" name="produk_name">
                                                <input type="radio" name="product" id="product"  class="card-input-element" value="{{ $produk->harga }}" />
                                                
                                                <div class="card card-input">
                                                    <div class="card-header mx-auto">{{ $produk->nama }}</div>
                                                    <div class="card-body mx-auto">
                                                        Rp.{{number_format( $produk->harga ) }}
                                                    </div>
                                                </div>
                                                
                                            </label>
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card bg-light">
                                <div class="card-header card text-white bg-danger">
                                    <span style="font-size:20px; ">Metode Pembayaran</span>
                                </div>
                                <div class="card">
                                    <div id="wallet" class="card-header" data-toggle="collapse" data-target="#collapse3" aria-expanded="true">
                                        <span class="title">Pembayaran</span>
                                        <span class="accicon">
                                            <i class="fa fa-angle-down rotate-icon"></i>
                                        </span>
                                    </div>
                                    
                                    
                                    <div id="accordion">
                                        
                                        <div class="card">
                                            <div class="card-header">
                                                <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                                    Bank
                                                </a>
                                            </div>
                                            <div id="collapseOne" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="row">
                                                        @foreach ($result as $pembayaran)
                                                        {{-- @if ($pembayaran->group == "E-Wallet") --}}
                                                        <div class="col-md-4 col-lg-4 col-sm-4">
                                                            
                                                            <label>
                                                                <input type="radio" name="pembayaran" id="pembayaran"  class="card-input-element" value="{{ $pembayaran->code }}" />
                                                                
                                                                <div class="card card-default card-input">
                                                                    <img src="{{ $pembayaran->icon_url }}" class="mx-auto mt-4" width="100px">
                                                                    <br>
                                                                    <div class="card-header mx-auto">{{ $pembayaran->name }}</div>
                                                                    <div class="card-body">
                                                                        
                                                                    </div>
                                                                </div>
                                                                
                                                            </label>
                                                            
                                                        </div>
                                                        {{-- @endif --}}
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="card">
                                            <div class="card-header">
                                                <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                                                    Collapsible Group Item #2
                                                </a>
                                            </div>
                                            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    Lorem ipsum..
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="card">
                                            <div class="card-header">
                                                <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                                                    Collapsible Group Item #3
                                                </a>
                                            </div>
                                            <div id="collapseThree" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    Lorem ipsum..
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                            
                            <div class="mt-4">
                                <button type="submit" class="btn btn-danger">Pesan Sekarang</button>
                            </div>
                        </form>
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
            
            <!-- Template Main JS File -->
            <script src="{{ asset('assets/js/main.js') }}"></script>
            <script src="//code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
            <script type="text/javascript">
                
                
                
            </script>
            
            
            
        </body>
        
        </html>
        
        