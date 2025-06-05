@extends('layout.user.main')

@section('main')

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">


    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (is_null($cart) || $cart->orderItems->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">
                                    Votre panier est vide
                                </td>
                            </tr>
                            @else
                                @foreach ($cart->orderItems as $item)
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="img/cart/cart-1.jpg" alt="">
                                        <h5>{{ $item->name }}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        {{ number_format($item->price / 100, 2) }}€
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="row d-flex justify-content-center">
                                                <form action="{{ route('cart.decrementQuantity', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="quantity" min="1" value="{{ $item->quantity }}">
                                                    <input type="submit" class="btn btn-primary btn-sm" value="-1">
                                                </form>
                                                <span class="mx-4">{{ $item->quantity }}</span>                                            
                                                <form action="{{ route('cart.incrementQuantity', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="quantity" min="1" value="{{ $item->quantity }}">
                                                    <input type="submit" class="btn btn-primary btn-sm" value="+1">
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        {{ number_format($item->price * $item->quantity / 100, 2) }}€
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <form action="{{ route('cart.removeItemFromCart', $item->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <span class="icon_close"></span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @if ($cart)
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    @if ($cart)
                        <a href="{{ route('home_user.restaurantchoosen', $cart->restaurant_id) }}" class="primary-btn cart-btn">
                            CONTINUER MES ACHATS
                        </a>
                    @endif
                    <form action="{{ route('cart.reset') }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="primary-btn cart-btn cart-btn-right">
                            Réinitialiser le panier
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        <li>Total <span>{{ number_format($cart->total_price / 100, 2) }}€</span></li>
                    </ul>
                    <input type="hidden" id="cart_id" value="{{ $cart->id }}">
                    <button id="checkout-button" class="primary-btn">Payer la commande</button>                    
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
<!-- Shoping Cart Section End -->

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe("{{ config('services.stripe.key') }}");

    document.getElementById("checkout-button").addEventListener("click", (e) => {
        e.preventDefault();
        const cart_id = document.getElementById("cart_id").value;

        fetch("/user/cart/create-checkout-session", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                cart_id: cart_id
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.id) {
                stripe.redirectToCheckout({ sessionId: data.id });
            } else {
                alert("Erreur pendant le checkout.");
            }
        });
    });
</script>

@endsection