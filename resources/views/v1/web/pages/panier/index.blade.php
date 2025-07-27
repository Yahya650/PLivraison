@extends('v1.web.layouts._default')

@section('title', 'Home')


@section('content')

    <div class="site-content">
        <main class="site-main  main-container no-sidebar">
            <div class="container">
                <div class="breadcrumb-trail breadcrumbs">
                    <ul class="trail-items breadcrumb">
                        <li class="trail-item trail-begin">
                            <a href="{{ route('web.home') }}">
                                <span>
                                    Accueil
                                </span>
                            </a>
                        </li>
                        <li class="trail-item trail-end active">
                            <span>
                                Panier
                            </span>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="main-content-cart main-content col-sm-12">
                        <h3 class="custom_blog_title">
                            Panier
                        </h3>
                        <div class="page-main-content">
                            <div class="shoppingcart-content">
                                <form action="https://dreamingtheme.kiendaotac.com/html/gnash/shoppingcart.html"
                                    class="cart-form">
                                    <table class="shop_table">
                                        <thead>
                                            <tr>
                                                <th class="product-remove"></th>
                                                <th class="product-thumbnail"></th>
                                                <th class="product-name"></th>
                                                <th class="product-price"></th>
                                                <th class="product-quantity"></th>
                                                <th class="product-subtotal"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="panier-items">
                                            @include('v1.web.pages.panier.html.items')
                                        </tbody>
                                    </table>
                                </form>
                                <div class="control-cart">
                                    <a href="{{ route('web.products') }}" class="button btn-continue-shopping">
                                        Continuer vos achats
                                    </a>
                                    <a href="{{ route('web.checkout') }}" class="button btn-cart-to-checkout">
                                        Commande
                                    </a>
                                    <a href="#" class="button btn-cart-to-checkout btn-clear-cart"
                                        style="background-color: #dc3545; color: white;">
                                        Vider le panier
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection



@section('script')
    <script>
        window.PANIER_CONFIG = {
            csrf: '{{ csrf_token() }}',
            routeChangeQuantity: '{{ route('web.panier.change.quantity') }}',
            routeDelete: '{{ route('web.panier.delete') }}',
            routeClear: '{{ route('web.panier.clear') }}',
        };
    </script>

    <script src="{{ '/v1/web/assets/js/controllers/PanierController.js?v=' . time() }}"></script>
@endsection
