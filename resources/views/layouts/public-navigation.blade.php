<nav class="nav">
    <div class="container mx-auto px-4 nav-container">
        <div class="flex items-center">
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="nav-logo">
            </a>
        </div>
        
        <div class="flex items-center space-x-8">
            <a href="{{ route('stone-types.index') }}" class="nav-link">
                Виды камня
            </a>
            <a href="{{ route('services') }}" class="nav-link">
                Услуги
            </a>
            <a href="{{ route('portfolio') }}" class="nav-link">
                Портфолио
            </a>
            <a href="{{ route('contacts') }}" class="nav-link">
                Контакты
            </a>
        </div>
    </div>
</nav> 