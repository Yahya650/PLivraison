@if (session()->has('panier'))
    @foreach (session()->get('panier') as $product_id => $product_on_panier)
        <tr class="cart_item">
            <td class="product-remove">
                <a href="#" class="remove remove-from-cart" data-id="{{ cryptID($product_id) }}">
                </a>
            </td>
            <td class="product-thumbnail">
                <a href="#">
                    <img src="{{ $product_on_panier['image'] }}" alt="img"
                        class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image">
                </a>
            </td>
            <td class="product-name" data-title="Product">
                <a href="#" class="title">{{ $product_on_panier['name'] }}</a>
                <span
                    class="attributes-select attributes-color">{{ isset($product_on_panier['magasin']) ? $product_on_panier['magasin'] : 'N/A' }}</span>
            </td>
            <td class="product-quantity" data-title="Quantity">
                <div class="quantity">
                    <div class="control">
                        <a class="btn-number qtyminus quantity-minus" href="#">-</a>
                        <input type="number" data-step="1" class="input-qty qty update-quantity"
                            data-id="{{ cryptID($product_id) }}" value="{{ $product_on_panier['quantity'] }}"
                            min="1">
                        <a href="#" class="btn-number qtyplus quantity-plus">+</a>
                    </div>
                </div>
            </td>
            <td class="product-price" data-title="Price">
                <span class="woocommerce-Price-amount amount">
                    {{ $product_on_panier['price'] . ' DH' }}
                    <span class="woocommerce-Price-currencySymbol">
                        DH
                    </span>
                </span>
            </td>
        </tr>
        {{-- <li class="product-cart mini_cart_item">
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
                                                                <a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                    </li> --}}
    @endforeach
@else
    <div style="display: flex ; justify-content: center ; align-items: center">
        <p>Panier vide</p>
    </div>
@endif
<tr>
    <td class="actions">
        {{-- <div class="coupon">
                                                        <label class="coupon_code">Coupon Code:</label>
                                                        <input type="text" class="input-text"
                                                            placeholder="Promotion code here">
                                                        <a href="#" class="button"></a>
                                                    </div> --}}
        <div class="order-total">
            <span class="title">
                Total Prix:
            </span>
            <span class="total-price">
                @php
                    $subtotal = collect(session()->get('panier', []))
                        ->map(fn($item) => $item['price'] * $item['quantity'])
                        ->sum();
                @endphp
                {{ $subtotal . ' DH' }}
            </span>
        </div>
    </td>
</tr>
