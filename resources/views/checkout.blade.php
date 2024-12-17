@extends('layouts.web')

@section('isi')

<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                  
                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach($cart as $id => $item)
                            @php $total += $item['price'] * $item['quantity']; @endphp
                            <tr class="text-center">
                                <td>{{ $item['name'] }}</td>
                                <td>Rp. {{ number_format($item['price'], 0, ',', '.') }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>Rp. {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row justify-content-end">
            <div class="col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
                    <h3>Checkout Totals</h3>
                    <p class="d-flex">
                        <span>Subtotal</span>
                        <span>Rp. {{ number_format($total, 0, ',', '.') }}</span>
                    </p>
                    <hr>
                    <p class="d-flex total-price">
                        <span>Total</span>
                        <span>Rp. {{ number_format($total, 0, ',', '.') }}</span>
                    </p>
                </div>

                <form action="{{ route('store.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary py-3 px-4">Complete Checkout</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection