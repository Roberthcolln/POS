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
                <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group mb-2">
                        <label for="">Kategori Produk</label>
                        <select name="id_kategori_produk" id="dropdown">
                            <option value=""></option>
                            @foreach ($kategori_produk as $row)
                            <option value="{{ $row->id_kategori_produk }}">{{ $row->nama_kategori_produk }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Nama Produk</label>
                        <input type="text" placeholder="Masukkan nama produk...." name="nama_produk" class="form-control" value="{{ old('nama_produk') }}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Harga</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp.</div>
                            </div>
                            <input type="number" name="harga_produk" class="form-control" id="" placeholder="Masukkan harga produk...." value="{{ old('harga_produk') }}">
                        </div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="">Stok</label>
                        <input type="number" placeholder="Masukkan jumlah stok...." name="stok" class="form-control" value="{{ old('stok') }}" required min="0">
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Harga Jual</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp.</div>
                            </div>
                            <input type="number" name="harga_jual" class="form-control" placeholder="Masukkan harga jual produk...." value="{{ old('harga_jual') }}" required step="0.01" min="0">
                        </div>
                    </div>


                    <div class="form-group mb-2">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi_produk" class="form-control" id="editor" cols="30" rows="10">{{ old('deskripsi_produk') }}</textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Foto Produk<abbr title="" style="color: black">*</abbr> </label>
                        <input id="inputImg" type="file" accept="image/*" name="foto_produk" class="form-control" required />
                        <img class="d-none w-25 h-25 my-2" id="previewImg" src="#" alt="Preview image">
                    </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-dark"><i class="fas fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    document.getElementById('inputImg').addEventListener('change', function() {
        // Get the file input value and create a URL for the selected image
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').setAttribute('src', e.target.result);
                document.getElementById('previewImg').classList.add("d-block");
            };
            reader.readAsDataURL(input.files[0]);
        }
    });
</script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: '{{ route('image.upload', ['_token' => csrf_token()]) }}'
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    CKEDITOR.replace('editor', {
        filebrowserUploadUrl: "{{ route('image.upload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form'
    });
</script>
@endsection
