@extends('v1.web.layouts._default')

@section('title', 'Home')


@section('content')
    <div>
        <div class="fullwidth-template">
            <div class="home-slider-banner">
                <div class="container">
                    <div class="row10">
                        <div class="col-lg-12 silider-wrapp">
                            <div class="home-slider">
                                <div class="slider-owl owl-slick equal-container nav-center"
                                    data-slick='{"autoplay":true, "autoplaySpeed":9000, "arrows":false, "dots":true, "infinite":true, "speed":1000, "rows":1}'
                                    data-responsive='[{"breakpoint":"2000","settings":{"slidesToShow":1}}]'>
                                    <div class="slider-item style7">
                                        <div class="slider-inner">
                                            <div class="slider-image"></div>
                                            <div class="slider-infor">
                                                <h5 class="title-small">Delivery Guercif</h5>
                                                <h3 class="title-big">
                                                    Bienvenue sur notre service de livraison à Guercif,<br>
                                                    disponible 7 jours sur 7.
                                                </h3>
                                                <a href="#" class="button">Commander</a>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="slider-item style8">
                                        <div class="slider-inner equal-element">
                                            <div class="slider-infor">
                                                <h5 class="title-small">
                                                    Take A organic
                                                </h5>
                                                <h3 class="title-big">
                                                    Up to 25% Off <br />order now
                                                </h3>
                                                <div class="price">
                                                    Save Price:
                                                    <span class="number-price">
                                                        $170.00
                                                    </span>
                                                </div>
                                                <a href="#" class="button btn-shop-product">Shop now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slider-item style9">
                                        <div class="slider-inner equal-element">
                                            <div class="slider-infor">
                                                <h5 class="title-small">
                                                    Gnash Best Collection
                                                </h5>
                                                <h3 class="title-big">
                                                    A range of <br />organic
                                                </h3>
                                                <div class="price">
                                                    New Price:
                                                    <span class="number-price">
                                                        $250.00
                                                    </span>
                                                </div>
                                                <a href="#" class="button btn-chekout">Shop now</a>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-lg-4 banner-wrapp">
                            <div class="banner">
                                <div class="item-banner style7">
                                    <div class="inner">
                                        <div class="banner-content">
                                            <h3 class="title">Pick Your <br />Items</h3>
                                            <div class="description">
                                                Adipiscing elit curabitur senectus sem
                                            </div>
                                            <a href="#" class="button btn-lets-do-it">Shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="banner">
                                <div class="item-banner style8">
                                    <div class="inner">
                                        <div class="banner-content">
                                            <h3 class="title">Best Of<br />Products</h3>
                                            <div class="description">
                                                Cras pulvinar loresum dolor conse
                                            </div>
                                            <span class="price">$379.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="gnash-product produc-featured rows-space-65">
                <div class="container">
                    <h3 class="custommenu-title-blog">
                        Offre du jour
                    </h3>
                    <div class="owl-products owl-slick equal-container nav-center"
                        data-slick='{"autoplay":false, "autoplaySpeed":1000, "arrows":false, "dots":true, "infinite":false, "speed":800, "rows":1}'
                        data-responsive='[{"breakpoint":"2000","settings":{"slidesToShow":4}},{"breakpoint":"1200","settings":{"slidesToShow":3}},{"breakpoint":"992","settings":{"slidesToShow":2}},{"breakpoint":"480","settings":{"slidesToShow":1}}]'>
                        @foreach ($products as $product)
                            <div class="product-item style-5">
                                <div class="product-inner equal-element">
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
                                                <img src="{{ $product?->getLastAttachment()?->stream() }}"
                                                    alt="{{ $product->slug }}">
                                            </a>
                                            {{-- <div class="thumb-group">
                                                <div class="yith-wcwl-add-to-wishlist">
                                                    <div class="yith-wcwl-add-button">
                                                        <a href="#">Add to Wishlist</a>
                                                    </div>
                                                </div>
                                                <a href="#" class="button quick-wiew-button">Quick View</a>
                                                <div class="loop-form-add-to-cart">
                                                    <button class="single_add_to_cart_button button">Add to cart</button>
                                                </div>
                                            </div> --}}
                                        </div>
                                        {{-- <div class="product-count-down">
                                            <div class="gnash-countdown" data-y="2021" data-m="10" data-w="4"
                                                data-d="10" data-h="20" data-i="20" data-s="60"></div>
                                        </div> --}}
                                    </div>
                                    <div class="product-info">
                                        <h5 class="product-name product_title">
                                            <a href="{{ route('web.product', $product->slug) }}">{{ $product->name }}</a>
                                        </h5>
                                        <div class="group-info">
                                            <div class="stars-rating">
                                                <div class="star-rating">
                                                    <span class="star-3"></span>
                                                </div>
                                                <div class="count-star">
                                                    (3)
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
                                    </div>
                                    <form class="quantity-add-to-cart form-store" action="{{ route('web.panier.add') }}"
                                        method="POST" data-container="#panier-items" data-no-controller="true"
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
                                                <input type="text" name="quantity" data-step="1" data-min="0"
                                                    value="1" title="Qty" min="1" class="input-qty qty"
                                                    size="4">
                                                <a href="#" class="btn-number qtyplus quantity-plus">+</a>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="single_add_to_cart_button button" type="submit"
                                                id="wait-button-add">Add to
                                                cart</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="banner-wrapp">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="banner">
                                <div class="item-banner style4">
                                    <div class="inner">
                                        <div class="banner-content">
                                            <h4 class="gnash-subtitle">TOP STAFF PICK</h4>
                                            <h3 class="title">Best Collection</h3>
                                            <div class="description">
                                                Proin interdum magna primis id consequat dictum
                                            </div>
                                            <a href="#" class="button btn-shop-now">Shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="banner">
                                <div class="item-banner style5">
                                    <div class="inner">
                                        <div class="banner-content">
                                            <h3 class="title">Maybe You’ve <br />Earned it</h3>
                                            <span class="code">
                                                Use code:
                                                <span>
                                                    GNASH
                                                </span>
                                                Get 25% Off for all Healthy items!
                                            </span>
                                            <a href="#" class="button btn-shop-now">Shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner-wrapp rows-space-65">
                <div class="container">
                    <div class="banner">
                        <div class="item-banner style17">
                            <div class="inner">
                                <div class="banner-content">
                                    <h3 class="title">Collection Arrived</h3>
                                    <div class="description">
                                        You have no items & Are you <br />ready to use? come & shop with us!
                                    </div>
                                    <div class="banner-price">
                                        Price from:
                                        <span class="number-price">$45.00</span>
                                    </div>
                                    <a href="#" class="button btn-shop-now">Shop now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="gnash-tabs  default rows-space-40">
                <div class="container">
                    <h3 class="custommenu-title-blog product">
                        Les magasins
                    </h3>
                    <div class="tab-head">
                        <ul class="tab-link">
                            @foreach ($categories as $category)
                                <li class="@if ($loop->first) active @endif">
                                    <a data-toggle="tab" aria-expanded="true"
                                        href="#{{ $category?->slug }}">{{ $category?->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-container">
                        @foreach ($categories as $category)
                            <div id="{{ $category?->slug }}"
                                class="tab-panel @if ($loop->first) active @endif">
                                <div class="gnash-product">
                                    <ul class="row list-products auto-clear equal-container product-grid">
                                        @foreach ($category?->magasins as $magasin)
                                            <li class="product-item col-lg-3 col-md-4 col-sm-6 col-xs-6 col-ts-12 style-1">
                                                <div class="product-inner equal-element">
                                                    <div class="product-top">
                                                        <div class="flash">
                                                            <span class="onnew">
                                                                <span class="text">
                                                                    Nombre de produits :
                                                                    {{ $magasin?->products?->count() }}
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="product-thumb">
                                                        <div class="thumb-inner">
                                                            <a
                                                                href="{{ route('web.products', ['magasin_ids' => cryptID($magasin?->id)]) }}">
                                                                <img src="{{ $magasin?->getLastAttachment()?->stream() }}"
                                                                    alt="{{ $magasin?->slug }}">
                                                            </a>
                                                            {{-- <div class="thumb-group">
                                                                <div class="yith-wcwl-add-to-wishlist">
                                                                    <div class="yith-wcwl-add-button">
                                                                        <a href="#">Add to Wishlist</a>
                                                                    </div>
                                                                </div>
                                                                <a href="#" class="button quick-wiew-button">Quick
                                                                View</a>
                                                                <div class="loop-form-add-to-cart">
                                                                    <button class="single_add_to_cart_button button">Add to
                                                                        cart
                                                                    </button>
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                    @php
                                                        $rating = rand(4.5, 5);
                                                    @endphp
                                                    <div class="product-info">
                                                        <h5 class="product-name product_title">
                                                            <a href="#">{{ $magasin?->name }}</a>
                                                        </h5>
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
                                                            {{-- <div class="price">
                                                                <del>
                                                                    $65
                                                                </del>
                                                                <ins>
                                                                    $45
                                                                </ins>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="gnash-iconbox-wrapp default">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="gnash-iconbox  default">
                                <div class="iconbox-inner">
                                    <div class="icon-item">
                                        <span class="icon flaticon-rocket-ship"></span>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">
                                            EU Free Delivery
                                        </h4>
                                        <div class="text">
                                            Free Delivery on all order from EU <br />with price more than $90.00
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="gnash-iconbox  default">
                                <div class="iconbox-inner">
                                    <div class="icon-item">
                                        <span class="icon flaticon-return"></span>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">
                                            Money Guarantee
                                        </h4>
                                        <div class="text">
                                            30 Days money back guarantee <br />no question asked!
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="gnash-iconbox  default">
                                <div class="iconbox-inner">
                                    <div class="icon-item">
                                        <span class="icon flaticon-padlock"></span>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">
                                            Online Support 24/7
                                        </h4>
                                        <div class="text">
                                            We’re here to support to you. <br />Let’s shopping now!
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="gnash-blog-wraap default">
                <div class="container">
                    <h3 class="custommenu-title-blog">
                        From Our Blog
                    </h3>
                    <div class="gnash-blog default">
                        <div class="owl-slick equal-container nav-center"
                            data-slick='{"autoplay":false, "autoplaySpeed":1000, "arrows":false, "dots":true, "infinite":true, "speed":800, "rows":1}'
                            data-responsive='[{"breakpoint":"2000","settings":{"slidesToShow":3}},{"breakpoint":"1200","settings":{"slidesToShow":3}},{"breakpoint":"992","settings":{"slidesToShow":2}},{"breakpoint":"768","settings":{"slidesToShow":2}},{"breakpoint":"481","settings":{"slidesToShow":1}}]'>
                            <div class="gnash-blog-item equal-element layout1">
                                <div class="post-thumb">
                                    <a href="#">
                                        <img src="/v1/web/assets/images/slider-blog-thumb-1.jpg" alt="img">
                                    </a>
                                    <div class="category-blog">
                                        <ul class="list-category">
                                            <li class="category-item">
                                                <a href="#">Skincare</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="post-item-share">
                                        <a href="#" class="icon">
                                            <i class="fa fa-share-alt" aria-hidden="true"></i>
                                        </a>
                                        <div class="box-content">
                                            <a href="#">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-google-plus"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-pinterest"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-linkedin"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="blog-info">
                                    <div class="blog-meta">
                                        <div class="post-date">
                                            Agust 17, 09:14 am
                                        </div>
                                        <span class="view">
                                            <i class="icon fa fa-eye" aria-hidden="true"></i>
                                            631
                                        </span>
                                        <span class="comment">
                                            <i class="icon fa fa-commenting" aria-hidden="true"></i>
                                            84
                                        </span>
                                    </div>
                                    <h2 class="blog-title">
                                        <a href="#">We bring you the best </a>
                                    </h2>
                                    <div class="main-info-post">
                                        <p class="des">
                                            Phasellus condimentum nulla a arcu lacinia, a venenatis ex congue.
                                            Mauris nec ante magna.
                                        </p>
                                        <a class="readmore" href="#">Read more</a>
                                    </div>
                                </div>
                            </div>
                            <div class="gnash-blog-item equal-element layout1">
                                <div class="post-thumb">
                                    <a href="#">
                                        <img src="/v1/web/assets/images/slider-blog-thumb-2.jpg" alt="img">
                                    </a>
                                    <div class="category-blog">
                                        <ul class="list-category">
                                            <li class="category-item">
                                                <a href="#">HOW TO</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="post-item-share">
                                        <a href="#" class="icon">
                                            <i class="fa fa-share-alt" aria-hidden="true"></i>
                                        </a>
                                        <div class="box-content">
                                            <a href="#">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-google-plus"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-pinterest"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-linkedin"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="blog-info">
                                    <div class="blog-meta">
                                        <div class="post-date">
                                            Agust 17, 09:14 am
                                        </div>
                                        <span class="view">
                                            <i class="icon fa fa-eye" aria-hidden="true"></i>
                                            631
                                        </span>
                                        <span class="comment">
                                            <i class="icon fa fa-commenting" aria-hidden="true"></i>
                                            84
                                        </span>
                                    </div>
                                    <h2 class="blog-title">
                                        <a href="#">We know that buying Items</a>
                                    </h2>
                                    <div class="main-info-post">
                                        <p class="des">
                                            Using Lorem Ipsum allows designers to put together layouts
                                            and the form content
                                        </p>
                                        <a class="readmore" href="#">Read more</a>
                                    </div>
                                </div>
                            </div>
                            <div class="gnash-blog-item equal-element layout1">
                                <div class="post-thumb">
                                    <div class="video-gnash-blog">
                                        <figure>
                                            <img src="/v1/web/assets/images/slider-blog-thumb-3.jpg" alt="img"
                                                width="370" height="280">
                                        </figure>
                                        <a class="quick-install" href="#" data-videosite="vimeo"
                                            data-videoid="134060140"></a>
                                    </div>
                                    <div class="category-blog">
                                        <ul class="list-category">
                                            <li class="category-item">
                                                <a href="#">VIDEO</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="post-item-share">
                                        <a href="#" class="icon">
                                            <i class="fa fa-share-alt" aria-hidden="true"></i>
                                        </a>
                                        <div class="box-content">
                                            <a href="#">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-google-plus"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-pinterest"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-linkedin"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="blog-info">
                                    <div class="blog-meta">
                                        <div class="post-date">
                                            Agust 17, 09:14 am
                                        </div>
                                        <span class="view">
                                            <i class="icon fa fa-eye" aria-hidden="true"></i>
                                            631
                                        </span>
                                        <span class="comment">
                                            <i class="icon fa fa-commenting" aria-hidden="true"></i>
                                            84
                                        </span>
                                    </div>
                                    <h2 class="blog-title">
                                        <a href="#">We design functional Items</a>
                                    </h2>
                                    <div class="main-info-post">
                                        <p class="des">
                                            Risus non porta suscipit lobortis habitasse felis, aptent
                                            interdum pretium ut.
                                        </p>
                                        <a class="readmore" href="#">Read more</a>
                                    </div>
                                </div>
                            </div>
                            <div class="gnash-blog-item equal-element layout1">
                                <div class="post-thumb">
                                    <a href="#">
                                        <img src="/v1/web/assets/images/slider-blog-thumb-4.jpg" alt="img">
                                    </a>
                                    <div class="category-blog">
                                        <ul class="list-category">
                                            <li class="category-item">
                                                <a href="#">Skincare</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="post-item-share">
                                        <a href="#" class="icon">
                                            <i class="fa fa-share-alt" aria-hidden="true"></i>
                                        </a>
                                        <div class="box-content">
                                            <a href="#">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-google-plus"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-pinterest"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-linkedin"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="blog-info">
                                    <div class="blog-meta">
                                        <div class="post-date">
                                            Agust 17, 09:14 am
                                        </div>
                                        <span class="view">
                                            <i class="icon fa fa-eye" aria-hidden="true"></i>
                                            631
                                        </span>
                                        <span class="comment">
                                            <i class="icon fa fa-commenting" aria-hidden="true"></i>
                                            84
                                        </span>
                                    </div>
                                    <h2 class="blog-title">
                                        <a href="#">We know that buying Items</a>
                                    </h2>
                                    <div class="main-info-post">
                                        <p class="des">
                                            Class integer tellus praesent at torquent cras, potenti erat fames
                                            volutpat etiam.
                                        </p>
                                        <a class="readmore" href="#">Read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    {{-- <div class="instagram-wrapp">
        <div>
            <h3 class="custommenu-title-blog">
                <i class="flaticon-instagram" aria-hidden="true"></i>
                Instagram Feed
            </h3>
            <div class="gnash-instagram">
                <div class="instagram owl-slick equal-container"
                    data-slick='{"autoplay":false, "autoplaySpeed":1000, "arrows":false, "dots":false, "infinite":true, "speed":800, "rows":1}'
                    data-responsive='[{"breakpoint":"2000","settings":{"slidesToShow":5}},{"breakpoint":"1200","settings":{"slidesToShow":4}},{"breakpoint":"992","settings":{"slidesToShow":3}},{"breakpoint":"768","settings":{"slidesToShow":2}},{"breakpoint":"481","settings":{"slidesToShow":2}}]'>
                    <div class="item-instagram">
                        <a href="#">
                            <img src="/v1/web/assets/images/item-instagram-1.jpg" alt="img">
                        </a>
                        <span class="text">
                            <i class="icon flaticon-instagram" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="item-instagram">
                        <a href="#">
                            <img src="/v1/web/assets/images/item-instagram-2.jpg" alt="img">
                        </a>
                        <span class="text">
                            <i class="icon flaticon-instagram" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="item-instagram">
                        <a href="#">
                            <img src="/v1/web/assets/images/item-instagram-3.jpg" alt="img">
                        </a>
                        <span class="text">
                            <i class="icon flaticon-instagram" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="item-instagram">
                        <a href="#">
                            <img src="/v1/web/assets/images/item-instagram-4.jpg" alt="img">
                        </a>
                        <span class="text">
                            <i class="icon flaticon-instagram" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="item-instagram">
                        <a href="#">
                            <img src="/v1/web/assets/images/item-instagram-5.jpg" alt="img">
                        </a>
                        <span class="text">
                            <i class="icon flaticon-instagram" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

@endsection
