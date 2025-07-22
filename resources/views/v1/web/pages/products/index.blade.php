@extends('v1.web.layouts._default')

@section('title', 'Home')


@section('content')
    <div class="main-content main-content-product left-sidebar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-trail breadcrumbs">
                        <ul class="trail-items breadcrumb">
                            <li class="trail-item trail-begin">
                                <a href="{{ route('web.home') }}">Accueil</a>
                            </li>
                            <li class="trail-item trail-end active">
                                Les Produits
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="content-area shop-grid-content no-banner col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="site-main">
                        <h3 class="custom_blog_title">
                            Les Produits
                        </h3>
                        {{-- <div class="shop-top-control">
                            <form class="select-item select-form">
                                <span class="title">Sort</span>
                                <select title="sort" data-placeholder="12 Products/Page" class="chosen-select">
                                    <option value="1">12 Products/Page</option>
                                    <option value="2">9 Products/Page</option>
                                    <option value="3">10 Products/Page</option>
                                    <option value="4">8 Products/Page</option>
                                    <option value="5">6 Products/Page</option>
                                </select>
                            </form>
                            <form class="filter-choice select-form">
                                <span class="title">Sort by</span>
                                <select title="sort-by" data-placeholder="Price: Low to High" class="chosen-select">
                                    <option value="1">Price: Low to High</option>
                                    <option value="2">Sort by popularity</option>
                                    <option value="3">Sort by average rating</option>
                                    <option value="4">Sort by newness</option>
                                    <option value="5">Sort by price: low to high</option>
                                </select>
                            </form>
                            <div class="grid-view-mode">
                                <div class="inner">
                                    <a href="listproducts.html" class="modes-mode mode-list">
                                        <span></span>
                                        <span></span>
                                    </a>
                                    <a href="gridproducts.html" class="modes-mode mode-grid  active">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </a>
                                </div>
                            </div>
                        </div> --}}
                        <ul class="row list-products auto-clear equal-container product-grid" id="products">
                            @include('v1.web.pages.products.html.items')
                        </ul>
                        <div class="pagination clearfix style3">
                            {{ $products->links('vendor.pagination.custom-style3') }}

                        </div>
                    </div>
                </div>
                <form class="sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12 form-filter" action="{{ route('web.products') }}"
                    method="GET" data-container="#products" data-names-list='["search", "order_by"]'
                    data-names-list-array='["magasin_ids", "product_category_ids"]'>
                    <div class="wrapper-sidebar shop-sidebar">
                        <div class="widget woof_Widget">
                            <div class="widget widget-categories">
                                <h3 class="widgettitle">Trier par</h3>
                                <div class="select-item select-form">
                                    <select data-placeholder="Trier par" class="chosen-select" name="order_by">
                                        <option value="PRICE_ASC" @selected(request('order_by') == 'PRICE_ASC')>Prix croissant</option>
                                        <option value="PRICE_DESC" @selected(request('order_by') == 'PRICE_DESC')>Prix décroissant</option>
                                        <option value="NAME_ASC" @selected(request('order_by') == 'NAME_ASC')>Nom croissant</option>
                                        <option value="NAME_DESC" @selected(request('order_by') == 'NAME_DESC')>Nom décroissant</option>
                                    </select>
                                </div>

                            </div>
                            <div class="widget widget-categories">
                                <h3 class="widgettitle">Les Magasins</h3>
                                <ul class="list-categories">
                                    @php
                                        $selectedMagasins = collect(explode(',', request('magasin_ids')))
                                            ->filter() // remove empty
                                            ->map(fn($id) => dcryptID($id))
                                            ->toArray();

                                    @endphp

                                    @foreach ($magasins as $magasin)
                                        @php
                                            $inputId = 'mag_' . cryptID($magasin->id);
                                        @endphp
                                        <li>
                                            <input type="checkbox" id="{{ $inputId }}" name="magasin_ids[]"
                                                value="{{ cryptID($magasin->id) }}" @checked(in_array($magasin->id, $selectedMagasins))>
                                            <label for="{{ $inputId }}" class="label-text">
                                                {{ $magasin->name }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="widget widget_filter_price">
                                <h4 class="widgettitle">
                                    Price
                                </h4>
                                <div class="price-slider-wrapper">
                                    <div data-label-reasult="Range:" data-min="0" data-max="3000" data-unit="MAD"
                                        class="slider-range-price" data-value-min="0" data-value-max="1000">
                                    </div>
                                    <div class="price-slider-amount">
                                        <span class="from">MAD0</span>
                                        <span class="to">MAD215</span>
                                    </div>
                                </div>
                            </div>
                            <div class="widget widget-brand">
                                <h3 class="widgettitle">Les Types de Produits</h3>
                                <ul class="list-brand">
                                    @php
                                        $selectedProductCategories = collect(
                                            explode(',', request('product_category_ids')),
                                        )
                                            ->filter() // remove empty
                                            ->map(fn($id) => dcryptID($id))
                                            ->toArray();

                                    @endphp
                                    @foreach ($productCategories as $productCategory)
                                        @php
                                            $inputId = 'pc_' . cryptID($productCategory->id); // "pc_" prefix for Product Category
                                        @endphp
                                        <li>
                                            <input type="checkbox" id="{{ $inputId }}" name="product_category_ids[]"
                                                @checked(in_array($productCategory->id, $selectedProductCategories)) value="{{ cryptID($productCategory->id) }}">
                                            <label for="{{ $inputId }}" class="label-text">
                                                {{ $productCategory->name }} ({{ $productCategory->products()->count() }})
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            {{-- <div class="widget widget_filter_size">
                                <h4 class="widgettitle">Size</h4>
                                <ul class="list-brand">
                                    <li>
                                        <input id="cb13" type="checkbox">
                                        <label for="cb13" class="label-text">14.0 mm</label>
                                    </li>
                                    <li>
                                        <input id="cb14" type="checkbox">
                                        <label for="cb14" class="label-text">14.4 mm</label>
                                    </li>
                                    <li>
                                        <input id="cb15" type="checkbox">
                                        <label for="cb15" class="label-text">14.8 mm</label>
                                    </li>
                                    <li>
                                        <input id="cb16" type="checkbox">
                                        <label for="cb16" class="label-text">15.2 mm</label>
                                    </li>
                                    <li>
                                        <input id="cb17" type="checkbox">
                                        <label for="cb17" class="label-text">15.6 mm</label>
                                    </li>
                                    <li>
                                        <input id="cb18" type="checkbox">
                                        <label for="cb18" class="label-text">16.0 mm</label>
                                    </li>
                                </ul>
                            </div>
                            <div class="widget widget-color">
                                <h4 class="widgettitle">
                                    Color
                                </h4>
                                <div class="list-color">
                                    <a href="#" class="color1"></a>
                                    <a href="#" class="color2 "></a>
                                    <a href="#" class="color3 active"></a>
                                    <a href="#" class="color4"></a>
                                    <a href="#" class="color5"></a>
                                    <a href="#" class="color6"></a>
                                    <a href="#" class="color7"></a>
                                </div>
                            </div>
                            <div class="widget widget-tags">
                                <h3 class="widgettitle">
                                    Popular Tags
                                </h3>
                                <ul class="tagcloud">
                                    <li class="tag-cloud-link">
                                        <a href="#">Raw fruit</a>
                                    </li>
                                    <li class="tag-cloud-link">
                                        <a href="#">Pumpkin</a>
                                    </li>
                                    <li class="tag-cloud-link">
                                        <a href="#">Flowering</a>
                                    </li>
                                    <li class="tag-cloud-link active">
                                        <a href="#">Healthy</a>
                                    </li>
                                    <li class="tag-cloud-link">
                                        <a href="#">Hot</a>
                                    </li>
                                    <li class="tag-cloud-link">
                                        <a href="#">Leafy green</a>
                                    </li>
                                    <li class="tag-cloud-link">
                                        <a href="#">Soybeans</a>
                                    </li>
                                </ul>
                            </div> --}}
                        </div>
                        {{-- <div class="widget newsletter-widget">
                            <div class="newsletter-form-wrap ">
                                <h3 class="title">Subscribe to Our Newsletter</h3>
                                <div class="subtitle">
                                    More special Deals, Events & Promotions
                                </div>
                                <input type="email" class="email" placeholder="Your email letter">
                                <button type="submit" class="button submit-newsletter">Subscribe</button>
                            </div>
                        </div> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
