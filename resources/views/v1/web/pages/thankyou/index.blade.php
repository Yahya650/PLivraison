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
                                Merci
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="checkout-wrapp">

                <div class="end-checkout-wrapp">
                    <div class="end-checkout checkout-form">
                        <div class="icon">
                        </div>
                        <h3 class="title-checkend">
                            Merci beaucoup {{ $commande->full_name }}! Votre commande a bien été prise en compte.
                        </h3>
                        <div class="sub-title">
                            Nous sommes ravis de vous compter parmi nos clients. Votre commande est en cours de traitement
                            et vous sera bientôt livrée.
                            Si vous avez la moindre question, n’hésitez pas à nous contacter.
                        </div>
                        <a href="{{ route('web.products') }}" class="button btn-return">Retour à la boutique</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
