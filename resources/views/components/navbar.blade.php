<!-- Навигационная панель -->
<nav class="navbar">
    <div class="navbar-container">
        <a href="/" class="navbar-logo">
            <img src="{{ asset('images/logo.svg') }}" alt="Stone Hill" class="logo-color">
            <img src="{{ asset('images/logow.svg') }}" alt="Stone Hill" class="logo-white">
        </a>

        <!-- Десктопное меню -->
        <div class="navbar-links">
            <a href="/" class="navbar-link {{ request()->is('/') ? 'active' : '' }}">Главная</a>
            <a href="/portfolio" class="navbar-link {{ request()->is('portfolio') ? 'active' : '' }}">Портфолио</a>
            <a href="/contacts" class="navbar-link {{ request()->is('contacts') ? 'active' : '' }}">Контакты</a>
        </div>

        <!-- Бургер-меню -->
        <button class="navbar-burger" aria-label="Меню">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <!-- Мобильное меню -->
        <div class="navbar-mobile">
            <div class="navbar-mobile-links">
                <a href="/" class="navbar-mobile-link {{ request()->is('/') ? 'active' : '' }}">Главная</a>
                <a href="/portfolio" class="navbar-mobile-link {{ request()->is('portfolio') ? 'active' : '' }}">Портфолио</a>
                <a href="/contacts" class="navbar-mobile-link {{ request()->is('contacts') ? 'active' : '' }}">Контакты</a>
            </div>
        </div>

        <!-- Оверлей для мобильного меню -->
        <div class="navbar-overlay"></div>
    </div>
</nav> 