<div class="col-lg-2 col-sm-12 col-md-3 col-xs-12 col-ts-12">
    <div class="header-control">
        <div class="block-minicart gnash-mini-cart block-header gnash-dropdown open">
            <a href="javascript:void(0);" class="shopcart-icon" data-gnash="gnash-dropdown">
                Cart
                <span class="count">
                    {{ session()->get('panier') ? count(session()->get('panier')) : 0 }}
                </span>
            </a>
            <div class="shopcart-description gnash-submenu">
                <div class="content-wrap">
                    <h3 class="title">Panier</h3>
                    <ul class="minicart-items">
                        {{-- @if (Auth::check())
                            dd
                        @else
                        @endif --}}
                        @if (session()->has('panier'))
                            @foreach (session()->get('panier') as $product_on_panier)
                                <li class="product-cart mini_cart_item">
                                    <a href="#" class="product-media">
                                        <img src="{{ $product_on_panier['image'] }}" alt="img">
                                    </a>
                                    <div class="product-details">
                                        <h5 class="product-name">
                                            <a href="#">{{ $product_on_panier['name'] }}</a>
                                        </h5>
                                        <div class="variations">
                                            <span class="attribute_color">
                                                <a
                                                    href="#">{{ isset($product_on_panier['magasin']) ? $product_on_panier['magasin'] : 'N/A' }}</a>
                                            </span>

                                        </div>
                                        <span class="product-price">
                                            <span class="price">
                                                <span>{{ $product_on_panier['price'] . ' DH' }}</span>
                                            </span>
                                        </span>
                                        <span class="product-quantity">
                                            (x{{ $product_on_panier['quantity'] }})
                                        </span>
                                        <div class="product-remove">
                                            {{-- <a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a> --}}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <div style="display: flex ; justify-content: center ; align-items: center">
                                <p>Panier vide</p>
                            </div>
                        @endif
                    </ul>
                    <div class="subtotal">
                        <span class="total-title">sous-total: </span>
                        <span class="total-price">
                            <span class="Price-amount">
                                @php
                                    $subtotal = collect(session()->get('panier', []))
                                        ->map(fn($item) => $item['price'] * $item['quantity'])
                                        ->sum();
                                @endphp
                                {{ $subtotal . ' DH' }}
                            </span>
                        </span>
                    </div>
                    <div class="actions">
                        <a class="button button-viewcart" href="{{ route('web.panier') }}">
                            <span>View Panier</span>
                        </a>
                        <a href="{{ route('web.checkout') }}" class="button button-checkout">
                            <span>Commande</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <a class="menu-bar mobile-navigation menu-toggle" href="#">
            <span></span>
            <span></span>
            <span></span>
        </a>
    </div>
</div>
