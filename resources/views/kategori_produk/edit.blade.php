@extends('layouts.index')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Error!</strong> 
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('kategori_produk.update', $kategori_produk->id_kategori_produk) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-2">
                        <label for="">Nama Kategori Pinbox</label>
                        <input type="text" name="nama_kategori_produk" class="form-control" value="{{ $kategori_produk->nama_kategori_produk }}">
                    </div> 
                   
                </div>
                <div class="card-footer">
                    <button class="btn btn-dark"><i class="fas fa-save fa-pulse"> </i> Save</button>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection
