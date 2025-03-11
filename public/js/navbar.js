document.addEventListener('DOMContentLoaded', function() {
    const burger = document.querySelector('.navbar-burger');
    const mobile = document.querySelector('.navbar-mobile');
    const overlay = document.querySelector('.navbar-overlay');
    const body = document.body;

    function toggleMenu() {
        burger.classList.toggle('active');
        mobile.classList.toggle('active');
        overlay.classList.toggle('active');
        body.classList.toggle('menu-open');
    }

    burger.addEventListener('click', toggleMenu);
    overlay.addEventListener('click', toggleMenu);

    // Закрытие меню при клике на ссылку
    document.querySelectorAll('.navbar-mobile-link').forEach(link => {
        link.addEventListener('click', toggleMenu);
    });

    // Изменение навбара при скролле
    let lastScroll = 0;
    const navbar = document.querySelector('.navbar');

    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }

        lastScroll = currentScroll;
    });
}); 