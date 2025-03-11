document.addEventListener('DOMContentLoaded', function() {
    const burger = document.getElementById('navbar-burger');
    const mobileMenu = document.getElementById('navbar-mobile');
    const overlay = document.getElementById('navbar-overlay');
    
    if (burger && mobileMenu && overlay) {
        burger.addEventListener('click', function() {
            burger.classList.toggle('active');
            mobileMenu.classList.toggle('active');
            overlay.classList.toggle('active');
            document.body.classList.toggle('no-scroll');
        });
        
        overlay.addEventListener('click', function() {
            burger.classList.remove('active');
            mobileMenu.classList.remove('active');
            overlay.classList.remove('active');
            document.body.classList.remove('no-scroll');
        });
        
        // Закрытие меню при клике на ссылку
        const mobileLinks = document.querySelectorAll('.navbar-mobile-link');
        mobileLinks.forEach(link => {
            link.addEventListener('click', function() {
                burger.classList.remove('active');
                mobileMenu.classList.remove('active');
                overlay.classList.remove('active');
                document.body.classList.remove('no-scroll');
            });
        });
    }
}); 