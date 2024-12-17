@extends('layouts.index')

@section('content')
<div class="container">
    <h1>{{ $title }}</h1>

    <div class="card">
        <div class="card-header">
            <h3>Detail Pemesanan</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('pemesanan.proses_bayar', $pemesanan->id_pemesanan) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="jumlah_bayar">Jumlah Bayar</label>
                    <input type="number" name="jumlah_bayar" class="form-control" placeholder="Masukkan jumlah bayar" required>
                </div>

                <div class="form-group">
                    <label for="jumlah_kembalian">Jumlah Kembalian</label>
                    <input type="number" name="jumlah_kembalian" class="form-control" placeholder="Jumlah kembalian" readonly>
                </div>

                <button type="submit" class="btn btn-success">Proses Pembayaran</button>
            </form>
        </div>
    </div>
</div>
@endsection
