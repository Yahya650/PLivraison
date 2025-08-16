<footer class="footer style7">
    <div class="container">
        <div class="container-wapper" style="
    padding-top: initial;
">
            {{-- <div class="row">
                <div class="box-footer col-xs-12 col-sm-4 col-md-4 col-lg-4 hidden-sm hidden-md hidden-lg">
                    <div class="gnash-newsletter style1">
                        <div class="newsletter-head">
                            <h3 class="title">Newsletter</h3>
                        </div>
                        <div class="newsletter-form-wrap">
                            <div class="list">
                                Sign up for our free video course and <br /> urban garden inspiration
                            </div>
                            <input type="email" class="input-text email email-newsletter"
                                placeholder="Your email letter">
                            <button class="button btn-submit submit-newsletter">SUBSCRIBE</button>
                        </div>
                    </div>
                </div>
                <div class="box-footer col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="gnash-custommenu default">
                        <h2 class="widgettitle">Quick Menu</h2>
                        <ul class="menu">
                            <li class="menu-item">
                                <a href="#">New arrivals</a>
                            </li>
                            <li class="menu-item">
                                <a href="#">Life style</a>
                            </li>
                            <li class="menu-item">
                                <a href="#">Pumpkin</a>
                            </li>
                            <li class="menu-item">
                                <a href="#">Leafy green</a>
                            </li>
                            <li class="menu-item">
                                <a href="#">Soybeans</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="box-footer col-xs-12 col-sm-4 col-md-4 col-lg-4 hidden-xs">
                    <div class="gnash-newsletter style1">
                        <div class="newsletter-head">
                            <h3 class="title">Newsletter</h3>
                        </div>
                        <div class="newsletter-form-wrap">
                            <div class="list">
                                Sign up for our free video course and <br /> urban garden inspiration
                            </div>
                            <input type="email" class="input-text email email-newsletter"
                                placeholder="Your email letter">
                            <button class="button btn-submit submit-newsletter">SUBSCRIBE</button>
                        </div>
                    </div>
                </div>
                <div class="box-footer col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="gnash-custommenu default">
                        <h2 class="widgettitle">Information</h2>
                        <ul class="menu">
                            <li class="menu-item">
                                <a href="#">FAQs</a>
                            </li>
                            <li class="menu-item">
                                <a href="#">Track Order</a>
                            </li>
                            <li class="menu-item">
                                <a href="#">Delivery</a>
                            </li>
                            <li class="menu-item">
                                <a href="#">Contact Us</a>
                            </li>
                            <li class="menu-item">
                                <a href="#">Return</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> --}}
            <div class="footer-end">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="gnash-socials">
                            <ul class="socials">
                                <li>
                                    <a href="https://www.facebook.com/share/1G3yR5Y2H7/" class="social-item"
                                        target="_blank">
                                        <i class="fa-brands fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:guercifdelivery@gmail.com" class="social-item" target="_blank">
                                        <i class="fa-regular fa-envelope"></i> </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/delivery_guercif?igsh=MXhhc3Q5cm43b2Jn"
                                        class="social-item" target="_blank">
                                        <i class="fa-brands fa-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="coppyright">
                            Copyright © {{ date('Y') }}
                            <a href="#" target="_blank">WeCodeIt</a>
                            . Tous droits réservés
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="footer-device-mobile">
    <div class="wapper">
        <div class="footer-device-mobile-item device-home">
            <a href="{{ route('web.home') }}">
                <span class="icon">
                    <i class="fa fa-home" aria-hidden="true"></i>
                </span>
                Accueil
            </a>
        </div>
        <div class="footer-device-mobile-item">
            <a href="{{ route('web.products') }}">
                <span class="icon">
                    <i class="fa-solid fa-bag-shopping"></i>
                </span>
                Les Produits
            </a>
        </div>
        <div class="footer-device-mobile-item device-home device-user">
            <a href="{{ route('web.magasins') }}">
                <span class="icon">
                    <i class="fa-solid fa-store"></i> </span>
                Les magasins
            </a>
        </div>
        <div class="footer-device-mobile-item device-home device-cart">
            <a href="{{ route('web.panier') }}">
                <span class="icon">
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    {{-- <span class="count-icon">
                        0
                    </span> --}}
                </span>
                <span class="text">Panier</span>
            </a>
        </div>
    </div>
</div>
