@foreach ($products as $product)
    <li class="product-item  col-lg-4 col-md-6 col-sm-6 col-xs-6 col-ts-12 style-1">
        <div class="product-inner equal-element" style="height: 441px !important;">
            <div class="product-top">
                <div class="flash">
                    <span class="onnew">
                        <span class="text">
                            {{ $product->magasin?->name }}
                            @if ($product->compare_price)
                                ({{ '-' . calculateDiscountPercentage($product->price, $product->compare_price) . ' %' }})
                            @endif
                        </span>
                    </span>
                </div>
            </div>
            <div class="product-thumb">
                <div class="thumb-inner">
                    <a href="{{ route('web.product', $product->slug) }}">
                        <img src="{{ $product?->getLastAttachment()?->stream() }}" alt="{{ $product->slug }}">
                    </a>
                    {{-- <div class="thumb-group">
                        <div class="yith-wcwl-add-to-wishlist">
                            <div class="yith-wcwl-add-button">
                                <a href="#">Add to Wishlist</a>
                            </div>
                        </div>
                        <a href="#" class="button quick-wiew-button">Quick View</a>
                        <div class="loop-form-add-to-cart">
                            <button class="single_add_to_cart_button button">Add to cart
                            </button>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="product-info">
                <h5 class="product-name product_title">
                    <a href="{{ route('web.product', $product->slug) }}">{{ $product->name }}</a>
                </h5>

                @php
                    $rating = rand(4.5, 5);
                @endphp
                <div class="group-info">
                    <div class="stars-rating">
                        <div class="star-rating">
                            <span class="star-{{ $rating }}"></span>
                        </div>
                        <div class="count-star">
                            ({{ $rating }})
                            - {{ rand(10, 100) . ' Avis' }}
                        </div>
                    </div>
                    <div class="price">
                        <del>
                            {{ $product->compare_price . ' MAD' ?? '' }}
                        </del>
                        <ins>
                            {{ $product->price . ' MAD' ?? 'N/A' }}
                        </ins>
                    </div>
                </div>


                <form class="quantity-add-to-cart form-store" action="{{ route('web.panier.add') }}" method="POST"
                    data-container="#panier-items" data-no-controller="true"
                    data-names-list='[
                        "product_id", "quantity" ]'
                    style="
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100px;
                    ">
                    <div class="quantity"
                        style="
                        display: block;
                        /* margin: 8px 90px; */
                    ">
                        <input type="hidden" name="product_id" value="{{ cryptID($product->id) }}">

                        <div class="control">
                            <a class="btn-number qtyminus quantity-minus" href="#">-</a>
                            <input type="text" name="quantity" data-step="1" data-min="0" value="1"
                                title="Qty" min="1" class="input-qty qty" size="4">
                            <a href="#" class="btn-number qtyplus quantity-plus">+</a>
                        </div>
                    </div>
                    <div>
                        <button class="single_add_to_cart_button button" type="submit" id="wait-button-add">Add to
                            cart</button>
                    </div>
                </form>
            </div>
        </div>
    </li>
@endforeach
