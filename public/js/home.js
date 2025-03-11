/**
 * JavaScript для анимации и интерактивности главной страницы
 */

document.addEventListener('DOMContentLoaded', function() {
    initSectionAnimations();
    initScrollIndicator();
    initScrollArrow();
});

/**
 * Инициализация анимаций при скролле
 */
function initSectionAnimations() {
    const fadeElements = document.querySelectorAll('.fade-in');
    
    // Первичная проверка видимости элементов
    checkVisibility(fadeElements);
    
    // Обработчик скролла
    const smoothScroll = document.querySelector('.smooth-scroll');
    if (smoothScroll) {
        smoothScroll.addEventListener('scroll', function() {
            checkVisibility(fadeElements);
        });
    }
}

/**
 * Проверка видимости элементов для анимации
 */
function checkVisibility(elements) {
    const triggerPoint = window.innerHeight * 0.85;
    
    elements.forEach(element => {
        const elementTop = element.getBoundingClientRect().top;
        
        if (elementTop < triggerPoint) {
            element.classList.add('visible');
        }
    });
}

/**
 * Настройка индикаторов секций справа
 */
function initScrollIndicator() {
    const sections = document.querySelectorAll('.section');
    const indicators = document.querySelectorAll('.indicator');
    
    if (sections.length <= 1 || indicators.length === 0) return;
    
    // Установка индикатора при скролле
    const smoothScroll = document.querySelector('.smooth-scroll');
    if (smoothScroll) {
        smoothScroll.addEventListener('scroll', () => {
            let current = '';
            
            sections.forEach((section, index) => {
                const sectionTop = section.getBoundingClientRect().top;
                if (sectionTop < window.innerHeight / 2) {
                    current = index;
                }
            });
            
            indicators.forEach((indicator, index) => {
                indicator.classList.remove('active');
                if (index === current) {
                    indicator.classList.add('active');
                }
            });
        });
        
        // Добавляем обработчики кликов на индикаторы
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                sections[index].scrollIntoView({ behavior: 'smooth' });
            });
        });
    }
}

/**
 * Настройка стрелки для скролла вниз
 * Гарантируем, что стрелка прокручивает страницу ко второй секции
 */
function initScrollArrow() {
    const scrollHint = document.querySelector('.scroll-hint');
    if (!scrollHint) return;
    
    const sections = document.querySelectorAll('.section');
    if (sections.length <= 1) {
        // Если секция всего одна, скрываем стрелку
        scrollHint.style.display = 'none';
        return;
    }
    
    // Обработчик клика для прокрутки ко второй секции
    scrollHint.addEventListener('click', function() {
        // Плавно прокручиваем ко второй секции
        const secondSection = sections[1];
        if (secondSection) {
            const smoothScroll = document.querySelector('.smooth-scroll');
            if (smoothScroll) {
                // Используем smooth-scroll контейнер, если он есть
                smoothScroll.scrollTo({
                    top: secondSection.offsetTop,
                    behavior: 'smooth'
                });
            } else {
                // Иначе используем стандартный метод прокрутки
                secondSection.scrollIntoView({ behavior: 'smooth' });
            }
        }
    });
    
    // Делаем стрелку более заметной
    window.addEventListener('scroll', function() {
        // Если страница прокручена вниз, скрываем стрелку
        if (window.scrollY > window.innerHeight * 0.5) {
            scrollHint.classList.add('fade-out');
        } else {
            scrollHint.classList.remove('fade-out');
        }
    });
}

/**
 * Утилита для плавного скролла
 */
function scrollToElement(element, duration = 500) {
    const targetPosition = element.getBoundingClientRect().top;
    const startPosition = window.pageYOffset;
    const distance = targetPosition - startPosition;
    let startTime = null;

    function animation(currentTime) {
        if (startTime === null) startTime = currentTime;
        const timeElapsed = currentTime - startTime;
        const progress = Math.min(timeElapsed / duration, 1);
        const ease = easeInOutQuad(progress);
        window.scrollTo(0, startPosition + distance * ease);
        if (timeElapsed < duration) requestAnimationFrame(animation);
    }
    
    function easeInOutQuad(t) {
        return t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t;
    }
    
    requestAnimationFrame(animation);
}
