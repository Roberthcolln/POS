@extends('layouts.index')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                    <a href="{{ route('kategori_produk.create') }}" class="btn btn-dark btn-sm" style="float: right;"><i class="fas fa-plus">Tambah</i></a>
                </div>
                <div class="card-body table table-responsive">
                    @if ($message = Session::get('Sukses'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    <table class="table table-bordered" id="example2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori_produk as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->nama_kategori_produk  }}</td>
                                    
                                    <td>
                                        <a href="{{ route('kategori_produk.edit', $row->id_kategori_produk) }}" class="btn btn-primary btn-xs" style="display: inline-block"><i class="fas fa-edit">Edit</i></a>
                                        <form action="{{ route('kategori_produk.destroy', $row->id_kategori_produk) }}" method="POST" style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs btn-flat show_confirm"><i class="fas fa-trash"> Delete</i></button>
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