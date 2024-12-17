@extends('layouts.index')

@section('content')
<div class="container">
    <h1>Daftar Pesanan Bar</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3>Pesanan untuk Bar</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Nomor Meja</th> <!-- Kolom baru -->
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barOrders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->pemesanan->produk->nama_produk }}</td>
                        <td>{{ $order->pemesanan->jumlah }}</td>
                        <td>{{ $order->pemesanan->nomor_meja }}</td> <!-- Menampilkan nomor meja -->
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                        <td>
                            <form action="{{ route('bar.done', $order->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm"
                                    @if($order->status == 'done') disabled @endif>
                                    Done
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection