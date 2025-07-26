<div class="main-nav">
    <!-- Sidebar Logo -->
    <div class="logo-box">
        <a href="{{ route('app.dash') }}" class="logo-dark">
            <img src="/v1/web/assets/images/plivraison.png" class="logo-sm" alt="logo sm">
            <img src="/v1/web/assets/images/plivraison.png" class="logo-lg" alt="logo dark">
        </a>

        <a href="{{ route('app.dash') }}" class="logo-light">
            <img src="/v1/web/assets/images/plivraison.png" class="logo-sm" alt="logo sm">
            <img src="/v1/web/assets/images/plivraison.png" class="logo-lg" alt="logo light">
        </a>
    </div>

    <!-- Menu Toggle Button (sm-hover) -->
    <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
        <iconify-icon icon="solar:double-alt-arrow-right-bold-duotone" class="button-sm-hover-icon"></iconify-icon>
    </button>

    <div class="scrollbar" data-simplebar>
        <ul class="navbar-nav" id="navbar-nav">

            <li class="menu-title">General</li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('app.dash') }}">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Dashboard </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('app.products.index') }}">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:t-shirt-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Les Produits </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('app.magasins.index') }}">
                    <span class="nav-icon">
                        <iconify-icon icon="material-symbols-light:store-rounded"></iconify-icon>
                    </span>
                    <span class="nav-text"> Les Magasins </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('app.categories.index') }}">
                    <span class="nav-icon">
                        <iconify-icon icon="fluent:ticket-diagonal-20-regular"></iconify-icon>
                    </span>
                    <span class="nav-text"> Les Categories </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('app.types.index') }}">
                    <span class="nav-icon">
                        <iconify-icon icon="streamline:money-cashier-tag-codes-tags-tag-product-label"></iconify-icon>
                    </span>
                    <span class="nav-text"> Les Types de Produits </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('app.commands.index') }}">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:cart-5-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Les Commandes </span>
                </a>
            </li>

        </ul>
    </div>
</div>
