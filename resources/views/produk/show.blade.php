@extends('layouts.index')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">{{ $title }} {{ $produk->nama_produk }}</h1>
    <div class="card mb-3 shadow-lg border-0">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('file/foto_produk/'.$produk->foto_produk) }}" class="img-fluid rounded-start" alt="{{ $produk->nama_produk }}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    
                    <p class="card-text"><strong>Kategori:</strong> <span class="text-muted">{{ $produk->nama_kategori_produk }}</span></p>
                    <p class="card-text"><strong>Harga:</strong> <span class="text-success">Rp. {{ number_format($produk->harga_produk) }}</span></p>
                    <p class="card-text"><strong>Harga Jual:</strong> <span class="text-success">Rp. {{ number_format($produk->harga_jual) }}</span></p>
                    <p class="card-text"><strong>Stok:</strong> {{ $produk->stok }}</p>
                    <p class="card-text"><strong>Deskripsi:</strong> {!! $produk->deskripsi_produk !!}</p>

                    <!-- Menampilkan Barcode -->
                    <p class="card-text"><strong>Barcode:</strong></p>
                    @if($produk->barcode)
                        <img src="{{ asset('file/barcodes/' . $produk->barcode) }}" alt="Barcode {{ $produk->nama_produk }}" class="img-fluid border rounded" />
                    @else
                        <p class="text-danger">Barcode tidak tersedia.</p>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 10px;
    }
    .card-body {
        padding: 20px;
    }
    .img-fluid {
        max-width: 100%;
        height: auto;
    }
    .btn-secondary {
        background-color: #6c757d;
        color: white;
        font-weight: bold;
        transition: background-color 0.3s;
    }
    .btn-secondary:hover {
        background-color: #5a6268;
    }
</style>
@endpush
