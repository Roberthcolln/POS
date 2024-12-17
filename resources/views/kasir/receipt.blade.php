@extends('layouts.index')

@section('content')
<div class="container" style="max-width: 400px; margin: 0 auto; padding-top: 30px;">

    <!-- Logo dan Nama Aplikasi -->
    <div class="text-center mb-4">
        <img src="{{ asset('logo/'.$konf->logo_setting) }}" alt="Logo" style="width: 100px; height: auto;">
        <h3>{{$konf->instansi_setting}}</h3>
    </div>

    <!-- Tanggal dan Waktu -->
    <div class="text-center mb-3">
        <p><strong>{{ \Carbon\Carbon::now()->format('d M Y, H:i') }}</strong></p>
    </div>

    <!-- Detail Transaksi -->
    <div class="border p-3 mb-3">
        <p><strong>No Transaksi:</strong> {{ $transaction->id }}</p>
        <p><strong>No. Meja:</strong> {{ $transaction->pemesanan->nomor_meja }}</p>
        <p><strong>Produk:</strong> {{ $transaction->pemesanan->produk->nama_produk }}</p>
        <p><strong>Total Harga:</strong> Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</p>
        <p><strong>Jumlah Bayar:</strong> Rp {{ number_format($transaction->jumlah_bayar, 0, ',', '.') }}</p>
        <p><strong>Kembalian:</strong> Rp {{ number_format($transaction->kembalian, 0, ',', '.') }}</p>
        <!-- <p><strong>Status:</strong> {{ ucfirst($transaction->status) }}</p> -->
    </div>

    <!-- Tombol Cetak -->
    <div class="text-center">
        <a href="#" onclick="window.print()" class="btn btn-primary btn-sm">Cetak</a>
    </div><br>
</div>

@endsection

@push('styles')
<style>
    /* Mengatur ukuran font dan layout responsif */
    body {
        font-family: Arial, sans-serif;
    }

    .container {
        background-color: #f9f9f9;
        border-radius: 8px;
    }

    .container p {
        font-size: 14px;
    }

    .text-center {
        text-align: center;
    }

    .border {
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    .btn-lg {
        padding: 10px 20px;
        font-size: 16px;
    }

    @media print {
        /* Menghilangkan tombol cetak saat mencetak */
        .btn-lg {
            display: none;
        }

        .container {
            max-width: 300px;
            margin: 0 auto;
            padding: 10px;
            font-size: 12px;
        }

        /* Menyembunyikan elemen yang tidak perlu saat mencetak */
        .text-center img {
            display: none;
        }
    }
</style>
@endpush
