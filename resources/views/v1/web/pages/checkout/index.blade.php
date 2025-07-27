@extends('v1.web.layouts._default')

@section('title', 'Home')


@section('content')

    <div class="main-content main-content-checkout">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-trail breadcrumbs">
                        <ul class="trail-items breadcrumb">
                            <li class="trail-item trail-begin">
                                <a href="{{ route('web.home') }}">Accueil</a>
                            </li>
                            <li class="trail-item trail-end active">
                                Caisse
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <h3 class="custom_blog_title">
                Caisse
            </h3>
            <div class="checkout-wrapp">
                <form class="shipping-address-form-wrapp form-store" action="{{ route('web.checkout.post') }}"
                    method="POST" data-container="#panier-items" data-no-controller="true"
                    data-wait-button="#button-payment"
                    data-names-list='[
                        "full_name", "phone", "province", "quartier", "address"]'>
                    <div class="shipping-address-form  checkout-form">
                        <div class="row-col-1 row-col">
                            <div class="shipping-address">
                                <h3 class="title-form">
                                    Adresse de livraison
                                </h3>
                                <p class="form-row form-row-first">
                                    <label class="text" for="full_name">Nom et prénom</label>
                                    <input title="full_name" type="text" class="input-text" name="full_name">
                                </p>
                                <p class="form-row form-row-last">
                                    <label class="text" for="phone">Téléphone</label>
                                    <input title="Téléphone" type="text" class="input-text" name="phone">
                                </p>
                                <p class="col-md-6 ps-0">
                                    <label class="text" for="province">Province/communauté</label>
                                    <select title="province" data-placeholder="Province/communauté" class="chosen-select"
                                        name="province" tabindex="1">
                                        <option value="" selected disabled>Province/communauté</option>
                                        <option value="الملحقة الإدارية الأولى جرسيف">الملحقة الإدارية الأولى جرسيف</option>
                                        <option value="الملحقة الإدارية التانية جرسيف">الملحقة الإدارية التانية جرسيف
                                        </option>
                                        <option value="الملحقة الإدارية التالثة جرسيف">الملحقة الإدارية التالثة جرسيف
                                        </option>
                                        <option value="الملحقة الإدارية الرابعة جرسيف">الملحقة الإدارية الرابعة جرسيف
                                        </option>
                                    </select>
                                </p>
                                <p class="col-md-6 ps-0">
                                    <label class="text" for="quartier">Quartier</label>
                                    <select title="quartier" data-placeholder="Quartier" class="chosen-select"
                                        tabindex="1" id="quartier" name="quartier">
                                        <option value="" selected disabled>Quartier</option>
                                        {{-- <option value="الملحقة الإدارية الأولى جرسيف">الملحقة الإدارية الأولى جرسيف</option>
                                        <option value="الملحقة الإدارية التانية جرسيف">الملحقة الإدارية التانية جرسيف
                                        </option>
                                        <option value="الملحقة الإدارية التالثة جرسيف">الملحقة الإدارية التالثة جرسيف
                                        </option>
                                        <option value="الملحقة الإدارية الرابعة جرسيف">الملحقة الإدارية الرابعة جرسيف
                                        </option> --}}
                                    </select>
                                </p>
                                <p class="form-row form-row-start">
                                    <label class="text">Address</label>
                                    <input title="address" type="text" class="input-text" name="address"
                                        placeholder="Numéro de maison et nom de rue">
                                </p>
                            </div>
                        </div>
                        <div class="row-col-2 row-col">
                            <div class="your-order">
                                <h3 class="title-form">
                                    Votre commande
                                </h3>
                                <ul class="list-product-order">
                                    {{-- @if (Auth::check())
                                        dd
                                    @else
                                    @endif --}}
                                    @if (session()->has('panier'))
                                        @foreach (session()->get('panier') as $product_on_panier)
                                            <li class="product-item-order">
                                                <div class="product-thumb">
                                                    <a href="#">
                                                        <img src="{{ $product_on_panier['image'] }}" alt="img">
                                                    </a>
                                                </div>
                                                <div class="product-order-inner">
                                                    <h5 class="product-name">
                                                        <a href="#">{{ $product_on_panier['name'] }}</a>
                                                    </h5>
                                                    <span
                                                        class="attributes-select attributes-color">{{ isset($product_on_panier['magasin']) ? $product_on_panier['magasin'] : 'N/A' }}</span>
                                                    {{-- <span class="attributes-select attributes-size">XXL</span> --}}
                                                    <span class="price">
                                                        {{ $product_on_panier['price'] . ' DH' }}
                                                    </span>
                                                    <span class="product-quantity">
                                                        (x{{ $product_on_panier['quantity'] }})
                                                    </span>
                                                </div>
                                            </li>
                                        @endforeach
                                    @else
                                        <div style="display: flex ; justify-content: center ; align-items: center">
                                            <p>Panier vide</p>
                                        </div>
                                    @endif
                                </ul>
                                <div class="order-total">
                                    <span class="title">
                                        Prix total :
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
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="button-payment" class="button button-payment">Commander</button>
                </form>
                {{-- <div class="payment-method-wrapp">
                    <div class="payment-method-form checkout-form">
                        <div class="row-col-1 row-col">
                            <div class="payment-method">
                                <h3 class="title-form">
                                    Payment Method
                                </h3>
                                <div class="group-button-payment">
                                    <a href="#" class="button btn-credit-card">Credit Card</a>
                                    <a href="#" class="button btn-paypal">paypal</a>
                                </div>
                                <p class="form-row form-row-card-number">
                                    <label class="text">Card number</label>
                                    <input type="text" class="input-text" placeholder="xxx - xxx - xxx - xxx">
                                </p>
                                <p class="form-row forn-row-col forn-row-col-1">
                                    <label class="text">Month</label>
                                    <select title="month" data-placeholder="01" class="chosen-select" tabindex="1">
                                        <option value="thang01">01</option>
                                        <option value="thang02">02</option>
                                        <option value="thang03">03</option>
                                        <option value="thang04">04</option>
                                        <option value="thang05">05</option>
                                        <option value="thang06">06</option>
                                        <option value="thang07">07</option>
                                        <option value="thang08">08</option>
                                        <option value="thang09">09</option>
                                        <option value="thang10">10</option>
                                        <option value="thang11">11</option>
                                        <option value="thang12">12</option>
                                    </select>
                                </p>
                                <p class="form-row forn-row-col forn-row-col-2">
                                    <label class="text">Year</label>
                                    <select title="Year" data-placeholder="2017" class="chosen-select" tabindex="1">
                                        <option value="nam2010">2010</option>
                                        <option value="nam2011">2011</option>
                                        <option value="nam2012">2012</option>
                                        <option value="nam2013">2013</option>
                                        <option value="nam2014">2014</option>
                                        <option value="nam2015">2015</option>
                                        <option value="nam2016">2016</option>
                                        <option value="nam2017">2017</option>
                                        <option value="nam2018">2018</option>
                                        <option value="nam2020">2020</option>
                                    </select>
                                </p>
                                <p class="form-row forn-row-col forn-row-col-3">
                                    <label class="text">CVV</label>
                                    <select title="CVV" data-placeholder="238" class="chosen-select" tabindex="1">
                                        <option value="cvv1">238</option>
                                        <option value="cvv2">354</option>
                                        <option value="cvv3">681</option>
                                        <option value="cvv4">254</option>
                                        <option value="cvv5">687</option>
                                        <option value="cvv6">123</option>
                                        <option value="cvv7">951</option>
                                        <option value="cvv8">852</option>
                                        <option value="cvv9">753</option>
                                        <option value="vcc10">963</option>
                                    </select>
                                </p>
                            </div>
                        </div>
                        <div class="row-col-2 row-col">
                            <div class="your-order">
                                <h3 class="title-form">
                                    Votre commande
                                </h3>
                                <ul class="list-product-order">
                                    <li class="product-item-order">
                                        <div class="product-thumb">
                                            <a href="#">
                                                <img src="assets/images/item-order1.jpg" alt="img">
                                            </a>
                                        </div>
                                        <div class="product-order-inner">
                                            <h5 class="product-name">
                                                <a href="#">3D Soybeans Chair</a>
                                            </h5>
                                            <span class="attributes-select attributes-color">Black,</span>
                                            <span class="attributes-select attributes-size">XXL</span>
                                            <div class="price">
                                                $45
                                                <span class="count">x1</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="product-item-order">
                                        <div class="product-thumb">
                                            <a href="#">
                                                <img src="assets/images/item-order2.jpg" alt="img">
                                            </a>
                                        </div>
                                        <div class="product-order-inner">
                                            <h5 class="product-name">
                                                <a href="#">3D Soybeans Chair</a>
                                            </h5>
                                            <span class="attributes-select attributes-color">Black,</span>
                                            <span class="attributes-select attributes-size">XXL</span>
                                            <div class="price">
                                                $45
                                                <span class="count">x1</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="order-total">
                                    <span class="title">
                                        Total Price:
                                    </span>
                                    <span class="total-price">
                                        $95
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-control">
                        <a href="#" class="button btn-back-to-shipping">Back to shipping</a>
                        <a href="#" class="button btn-pay-now">Pay now</a>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
