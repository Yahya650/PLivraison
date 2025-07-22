@foreach ($products as $product)
    <li class="product-item  col-lg-4 col-md-6 col-sm-6 col-xs-6 col-ts-12 style-1">
        <div class="product-inner equal-element">
            <div class="product-top">
                <div class="flash">
                    <span class="onnew">
                        <span class="text">
                            {{ $product->magasin->name }}
                            @if ($product->compare_price)
                                {{ '-' . calculateDiscountPercentage($product->price, $product->compare_price) . ' %' }}
                            @endif
                        </span>
                    </span>
                </div>
            </div>
            <div class="product-thumb">
                <div class="thumb-inner">
                    <a href="#">
                        <img src="{{ $product?->getLastAttachment()?->stream() }}" alt="{{ $product->slug }}">
                    </a>
                    <div class="thumb-group">
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
                    </div>
                </div>
            </div>
            <div class="product-info">
                <h5 class="product-name product_title">
                    <a href="#">{{ $product->name }}</a>
                </h5>
                <div class="group-info">
                    {{-- <div class="stars-rating">
                                                    <div class="star-rating">
                                                        <span class="star-3"></span>
                                                    </div>
                                                    <div class="count-star">
                                                        (3)
                                                    </div>
                                                </div> --}}
                    <div class="price">
                        <del>
                            {{ $product->compare_price . ' MAD' ?? '' }}
                        </del>
                        <ins>
                            {{ $product->price . ' MAD' ?? 'N/A' }}
                        </ins>
                    </div>
                </div>
            </div>
        </div>
    </li>
@endforeach
