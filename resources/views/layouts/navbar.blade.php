<nav class="navbar">
    <div class="navbar-container">
        <a href="{{ route('home') }}" class="navbar-logo">
            <img src="{{ asset('images/logo.svg') }}" alt="StoneHill Logo">
            <!-- <span class="navbar-logo-text">StoneHill</span> -->
        </a>
        
        <div class="navbar-links">
            <a href="{{ route('home') }}" class="navbar-link {{ request()->routeIs('home') ? 'active' : '' }}">Главная</a>
            <a href="{{ route('stone-types') }}" class="navbar-link {{ request()->routeIs('stone-types') ? 'active' : '' }}">Виды камня</a>
            <a href="{{ route('services') }}" class="navbar-link {{ request()->routeIs('services') ? 'active' : '' }}">Услуги</a>
            <a href="{{ route('portfolio') }}" class="navbar-link {{ request()->routeIs('portfolio') ? 'active' : '' }}">Портфолио</a>
            <a href="{{ route('contacts') }}" class="navbar-link {{ request()->routeIs('contacts') ? 'active' : '' }}">Контакты</a>
        </div>
        
        <div class="navbar-burger" id="navbar-burger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    
    <div class="navbar-mobile" id="navbar-mobile">
        <div class="navbar-mobile-links">
            <a href="{{ route('home') }}" class="navbar-mobile-link {{ request()->routeIs('home') ? 'active' : '' }}">Главная</a>
            <a href="{{ route('stone-types') }}" class="navbar-mobile-link {{ request()->routeIs('stone-types') ? 'active' : '' }}">Виды камня</a>
            <a href="{{ route('services') }}" class="navbar-mobile-link {{ request()->routeIs('services') ? 'active' : '' }}">Услуги</a>
            <a href="{{ route('portfolio') }}" class="navbar-mobile-link {{ request()->routeIs('portfolio') ? 'active' : '' }}">Портфолио</a>
            <a href="{{ route('contacts') }}" class="navbar-mobile-link {{ request()->routeIs('contacts') ? 'active' : '' }}">Контакты</a>
        </div>
    </div>
    
    <div class="navbar-overlay" id="navbar-overlay"></div>
</nav>