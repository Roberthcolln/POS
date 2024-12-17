@extends('layouts.index')
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $title }}</h3>
                <a href="{{ route('produk.create') }}" class="btn btn-dark btn-sm" style="float: right;"><i class="fas fa-plus">Tambah</i></a>
            </div>
            <div class="card-body table table-responsive">
                @if ($message = Session::get('Sukses'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <table class="table table-bordered" id="example2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barcode</th> <!-- Kolom Barcode -->
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Foto</th>
                            
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produk as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('file/barcodes/'.$row->barcode) }}" alt="Barcode" style="width: 100px; height: 50px;">
                            </td>
                            <td>{{ $row->nama_produk }}</td>
                            <td>{{ $row->nama_kategori_produk }}</td>
                            <td>{!! $row->deskripsi_produk !!}</td>
                            <td>Rp. {{ number_format($row->harga_produk) }}</td>
                            <td>{{ $row->stok }}</td>
                            <td><img src="{{ asset('file/foto_produk/'.$row->foto_produk) }}" alt="{{ $row->nama_produk }}" style="width: 100px; height: 100px;"></td>
                            
                            <td>
                            <a href="{{ route('produk.show', $row->id_produk) }}" class="btn btn-warning btn-xs" style="display: inline-block"> <i class="fas fa-eye"> Show</i></a>
                                <a href="{{ route('produk.edit', $row->id_produk) }}" class="btn btn-primary btn-xs"><i class="fas fa-edit"> Edit</i></a>
                                <form action="{{ route('produk.destroy', $row->id_produk) }}" method="POST" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs"><i class="fas fa-trash"> Destroy</i></button>
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
@endsection