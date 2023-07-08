@extends('layout.client_main')
@section('body')

<section class="mt-4 mb-5">
  <div class="container">
    <div class="card bg-light">
      <div class="card-header card text-white bg-danger">
        <span style="font-size:22px;">Invoice #NY040723011805393709</span>
      </div>
      <div class="card-body">
        <div class="alert alert-warning" role="alert">
          <span style="font-size:20px;" id="epoch">
            <i class="fa-solid fa-circle-info"></i> Mohon segera melakukan pembayaran sesuai "Total Bayar" sebelum {{ $localTime }}</span>
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
                @foreach ($result->instructions as $instruksi )
                <div class="card-body">
                  <span style="font-size:20px;">{{ $instruksi->title }}</span>
                  <ul>
                    @foreach ($instruksi->steps as $steps)
                    
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
  
  
  
  @endsection
  