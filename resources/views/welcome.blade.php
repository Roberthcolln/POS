@extends('layouts.web')
@section('isi')


<section class="ftco-section" id="menu">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">Discover</span>
                <h2 class="mb-4">Our Products</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            </div>
        </div>
        <div class="row">
            @foreach ($produk as $kategori => $items)
            <div class="col-md-6 mb-5 pb-3">
                <h3 class="mb-5 heading-pricing ftco-animate">{{ $kategori }}</h3>
                @foreach ($items as $item)
                <div class="pricing-entry d-flex ftco-animate">
                    <div class="img" style="background-image: url({{ asset('file/foto_produk/' . $item->foto_produk) }});"></div>
                    <div class="desc pl-3">
                        <div class="d-flex text align-items-center">
                            <h3><span>{{ $item->nama_produk }}</span></h3>
                            <span class="price">Rp. {{ number_format($item->harga_jual) }}</span>
                        </div>
                        <div class="d-block">
                            <p>{!! $item->deskripsi_produk !!}</p>
                        </div>
                        
                        <!-- Menambahkan stok -->
                        <p class="stock-status">
                            Stok: <strong>{{ $item->stok }}</strong> 
                            @if ($item->stok == 0)
                                <span class="text-danger">(Out of stock)</span>
                            @endif
                        </p>

                        <!-- Add to Cart Button -->
                        <p>
                            <a href="{{ route('add_to_cart', $item->id_produk) }}" 
                               class="btn btn-primary btn-outline-primary" 
                               @if ($item->stok == 0) hidden @endif>
                               Add to Cart
                            </a>
                        </p>

                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection