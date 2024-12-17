@extends('layouts.index')

@section('content')
<div class="container">
    <h1>{{ $title }}</h1>

    <!-- Transactions List -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Pemesanan</h3>
                    <a href="#" data-toggle="collapse" data-target="#addTransactionForm" class="btn btn-dark btn-sm" style="float: right;">
                        <i class="fas fa-plus"></i> Tambah Pemesanan
                    </a>
                </div>
                <div class="card-body table-responsive">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                
                                <th>Jumlah</th>
                                <th>Total Harga</th>
                                <th>No. Meja</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemesanan as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ asset('file/foto_produk/'.$row->produk->foto_produk) }}" alt="{{ $row->produk->nama_produk }}" class="img-fluid" width="50"><br> {{ $row->produk->nama_produk }}</td>
                               
                                <td>{{ $row->jumlah }}</td>
                                <td>Rp {{ number_format($row->total_harga, 2) }}</td>
                                <td>{{ $row->nomor_meja }}</td>
                                <td>{{ ucfirst($row->status) }}</td>

                                <td>
                                    @if ($row->status == 'done')
                                    <!-- Tambahkan Tombol Bayar -->
                                    <form action="{{ route('pemesanan.bayar', $row->id_pemesanan) }}" method="GET" class="d-inline">
                                        @csrf
                                        <button class="btn btn-info btn-sm">
                                            <i class="fas fa-credit-card"></i> Bayar
                                        </button>
                                    </form>
                                    @endif

                                    <!-- Tombol lainnya (Approve/ Delete) -->
                                    @if ($row->produk->id_kategori_produk == 1)
                                    <form action="{{ route('pemesanan.approve', $row->id_pemesanan) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-success btn-sm" @if ($row->status == 'approved') disabled @endif>
                                            <i class="fas fa-check"></i> Approve Kitchen
                                        </button>
                                    </form>
                                    @elseif ($row->produk->id_kategori_produk == 2)
                                    <form action="{{ route('pemesanan.approve', $row->id_pemesanan) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-primary btn-sm" @if ($row->status == 'approved') disabled @endif>
                                            <i class="fas fa-check"></i> Approve Bar
                                        </button>
                                    </form>
                                    @endif

                                    <form action="{{ route('pemesanan.destroy', $row->id_pemesanan) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                                    </form>
                                </td>



                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Transaction Form (collapsed by default) -->
    <div id="addTransactionForm" class="collapse">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Pemesanan</h3>
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('pemesanan.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="id_produk">Pilih Produk</label>
                        <div class="row">
                            @foreach ($produk as $kategori => $items)
                            <div class="col-12">
                                <h5>{{ ucfirst($kategori) }}</h5> <!-- Display category name -->
                            </div>
                            @foreach ($items as $item)
                            <div class="col-4 mb-3">
                                <div class="card">
                                    <img src="{{ asset('file/foto_produk/'.$item->foto_produk) }}" class="card-img-top" alt="{{ $item->nama_produk }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->nama_produk }}</h5>
                                        <p class="card-text">Rp {{ number_format($item->harga_jual, 2) }}</p>
                                        <button type="submit" name="id_produk" value="{{ $item->id_produk }}" class="btn btn-dark btn-sm">Pilih Produk</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" placeholder="Masukkan jumlah" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection