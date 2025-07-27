@extends('v1.web.layouts._default')

@section('title', 'Authentification')


@section('content')

    <div class="main-content main-content-login">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-trail breadcrumbs">
                        <ul class="trail-items breadcrumb">
                            <li class="trail-item trail-begin">
                                <a href="{{ route('web.home') }}">Accueil</a>
                            </li>
                            <li class="trail-item trail-end active">
                                Authentification
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="content-area col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="site-main">
                        <h3 class="custom_blog_title">
                            Authentification
                        </h3>
                        <div class="customer_login">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="login-item">
                                        <h5 class="title-login">Vous connecter à votre compte</h5>
                                        <form class="login form-store" method="POST" data-no-controller="true"
                                            action="{{ route('auth.login.post') }}" data-wait-button="#wait-button"
                                            data-names-list='["email", "password"]'>
                                            {{-- <div class="social-account">
                                                <h6 class="title-social">Login with social account</h6>
                                                <a href="#" class="mxh-item facebook">
                                                    <i class="icon fa fa-facebook-square" aria-hidden="true"></i>
                                                    <span class="text">FACEBOOK</span>
                                                </a>
                                                <a href="#" class="mxh-item twitter">
                                                    <i class="icon fa fa-twitter" aria-hidden="true"></i>
                                                    <span class="text">TWITTER</span>
                                                </a>
                                            </div> --}}
                                            <p class="form-row form-row-wide">
                                                <label class="text" id="email">Email</label>
                                                <input title="email" type="text" class="input-text" id="email"
                                                    name="email">
                                            </p>
                                            <p class="form-row form-row-wide">
                                                <label class="text" for="password">Mot de passe</label>
                                                <input title="password" type="password" class="input-text" name="password"
                                                    id="password">
                                            </p>
                                            <p class="lost_password">
                                                <span class="inline">
                                                    <input type="checkbox" id="cb1">
                                                    <label for="cb1" class="label-text">Se souvenir de moi</label>
                                                </span>
                                                {{-- <a href="#" class="forgot-pw">Forgot password?</a> --}}
                                            </p>
                                            <p class="form-row">
                                                <input type="submit" class="button-submit" value="Connexion"
                                                    id="wait-button">
                                            </p>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="login-item">
                                        <h5 class="title-login">Register now</h5>
                                        <form class="register form-store" method="POST" data-no-controller="true"
                                            action="{{ route('web.auth.register.post') }}" data-wait-button="#wait-button"
                                            data-names-list='["email", "password"]'>
                                            <p class="form-row form-row-wide">
                                                <label class="text" for="email">Email</label>
                                                <input title="email" type="text" class="input-text" id="email"
                                                    name="email">
                                            </p>
                                            <p class="form-row form-row-wide">
                                                <label class="text" for="full_name">Le nom complet</label>
                                                <input title="full_name" type="text" class="input-text" id="full_name"
                                                    name="full_name">
                                            </p>
                                            <p class="form-row form-row-wide">
                                                <label class="text" for="password">Mot de passe</label>
                                                <input title="password" type="password" class="input-text" name="password"
                                                    id="password">
                                            </p>
                                            {{-- <p class="form-row">
                                                <span class="inline">
                                                    <input type="checkbox" id="cb2">
                                                    <label for="cb2" class="label-text">I agree to <span>Terms &
                                                            Conditions</span></label>
                                                </span>
                                            </p> --}}
                                            <p class="form-row">
                                                <input type="submit" class="button-submit" value="Connexion"
                                                    id="wait-button">
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
