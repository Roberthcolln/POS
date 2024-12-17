@extends('layouts.index')

@section('content')

<style>
    .card {
        border-radius: 10px;
    }

    .card-header {
        font-weight: bold;
    }

    .card-footer button,
    .card-footer a {
        border-radius: 8px;
    }
</style>

<div class="container mt-5">
    <h1 class="text-center mb-4">💳 Transaksi Kasir</h1>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        @foreach ($transactions as $transaction)
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-header {{ $transaction->status == 'paid' ? 'bg-success text-white' : 'bg-warning text-dark' }}">
                    <h5 class="mb-0">Transaksi {{ $loop->iteration }}</h5>
                </div>
                <div class="card-body">
                    <p><strong>Nomor Meja:</strong> {{ $transaction->pemesanan->nomor_meja }}</p> <!-- Tambahkan nomor meja -->
                    <p><strong>Produk:</strong> {{ $transaction->pemesanan->produk->nama_produk }}</p>
                    <p><strong>Total Harga:</strong> Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</p>
                    <p><strong>Jumlah Bayar:</strong>
                        {{ $transaction->jumlah_bayar ? 'Rp ' . number_format($transaction->jumlah_bayar, 0, ',', '.') : '-' }}
                    </p>
                    <p><strong>Kembalian:</strong>
                        {{ $transaction->kembalian ? 'Rp ' . number_format($transaction->kembalian, 0, ',', '.') : '-' }}
                    </p>
                    <p><strong>Status:</strong>
                        <span class="badge {{ $transaction->status == 'paid' ? 'bg-success' : 'bg-warning' }}">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </p>
                </div>

                <div class="card-footer text-end">
                    @if ($transaction->status == 'pending')
                    <form action="{{ route('kasir.processPayment', $transaction->id) }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="number" name="jumlah_bayar" class="form-control" placeholder="Jumlah Bayar">
                            <button type="submit" class="btn btn-success">Bayar</button>
                        </div>
                    </form>
                    @elseif ($transaction->status == 'paid')
                    <a href="{{ route('kasir.printReceipt', $transaction->id) }}" class="btn btn-primary w-100">Cetak Struk</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection