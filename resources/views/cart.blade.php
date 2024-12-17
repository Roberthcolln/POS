@extends('layouts.web')
@section('isi')


<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(web/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Cart</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{url ('/')}}">Home</a></span> <span>Cart</span></p>
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p style="color: black;">{{ $message }}</p>
                    </div>
                    @endif
                </div>


            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach(session('cart', []) as $id => $item)
                            @php
                            $total += $item['price'] * $item['quantity'];
                            @endphp

                            <tr class="text-center">
                                <td class="product-remove">
                                    <a href="{{ route('remove_from_cart', $id) }}"><span class="icon-close"></span></a>
                                </td>
                                <td class="image-prod">
                                    <div class="img" style="background-image:url({{ $item['image'] }});"></div>
                                </td>
                                <td class="product-name">
                                    <h3>{{ $item['name'] }}</h3>
                                </td>
                                <td class="price">Rp. {{ number_format($item['price'], 0, ',', '.') }}</td>
                                <td class="quantity">
                                    <div class="input-group mb-3">
                                        <input type="number" name="quantity" class="quantity form-control input-number" value="{{ $item['quantity'] }}" min="1" max="100" data-id="{{ $id }}">
                                    </div>
                                </td>

                                <td class="total" id="total-{{ $id }}">Rp. {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p class="text-center">
                        <a href="{{ route('remove_all_from_cart') }}" class="btn btn-danger py-3 px-4">Remove All Products</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
                    <h3>Cart Totals</h3>
                    <p class="d-flex">
                        <span>Subtotal</span>
                        <span class="subtotal">Rp. {{ number_format($total, 0, ',', '.') }}</span>
                    </p>
                    <p class="d-flex">
                        <span>Delivery</span>
                        <span>Rp. 0</span>
                    </p>
                    <p class="d-flex">
                        <span>Discount</span>
                        <span>Rp. 0</span>
                    </p>
                    <hr>
                    <p class="d-flex total-price">
                        <span>Total</span>
                        <span class="total-price">Rp. {{ number_format($total, 0, ',', '.') }}</span>
                    </p>
                </div>

                <form action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <!-- <label for="nomor_meja">Nomor Meja</label> -->
                        <input type="text" name="nomor_meja" id="nomor_meja" class="form-control" placeholder="Masukkan nomor meja" required>
                    </div>
                    <p class="text-center">
                        <button type="submit" class="btn btn-primary py-3 px-4">Proceed to Checkout</button>
                    </p>
                </form>



                <!-- Tombol untuk menghapus semua produk -->

            </div>
        </div>
    </div>
</section>

<script>
    // Menunggu seluruh konten halaman dimuat
    document.addEventListener("DOMContentLoaded", function() {
        // Menangani perubahan pada input quantity
        document.querySelectorAll('.quantity').forEach(function(input) {
            input.addEventListener('change', function() {
                // Ambil id produk dan quantity yang baru
                let productId = this.getAttribute('data-id');
                let newQuantity = this.value;

                // Mengirim data quantity baru ke server untuk update keranjang
                fetch(`/update-cart/${productId}/${newQuantity}`, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Update total harga dan subtotal
                        if (data.success) {
                            // Update total harga produk ini
                            let totalElement = document.querySelector(`#total-${productId}`);
                            totalElement.textContent = `Rp. ${data.total}`;

                            // Update subtotal dan total cart
                            document.querySelector('.cart-total .subtotal').textContent = `Rp. ${data.subtotal}`;
                            document.querySelector('.cart-total .total-price').textContent = `Rp. ${data.total}`;
                        }
                    })
                    .catch(err => console.error('Error:', err));
            });
        });
    });
</script>


@endsection