// Переменные для слайдера
let currentSlide = 0;
let slides = [];

// Функция открытия модального окна
function openModal(portfolioId) {
    // Отображаем модальное окно с индикатором загрузки
    const modal = document.getElementById('portfolioModal');
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
    
    // Начальное состояние с индикатором загрузки
    document.querySelector('.modal-title').textContent = 'Загрузка...';
    document.querySelector('.modal-description').textContent = '';
    document.getElementById('modalSlider').innerHTML = '<div class="loading-indicator">Загрузка...</div>';
    document.getElementById('modalThumbnails').innerHTML = '';
    document.querySelector('.modal-info-row').innerHTML = '';
    
    // Запрашиваем данные с сервера
    fetch(`/api/portfolio/${portfolioId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            populateModal(data);
        })
        .catch(error => {
            console.error('Ошибка при загрузке данных портфолио:', error);
            document.querySelector('.modal-title').textContent = 'Ошибка загрузки';
            document.querySelector('.modal-description').textContent = 
                'Произошла ошибка при загрузке данных. Пожалуйста, попробуйте еще раз.';
        });
}

// Функция для заполнения модального окна данными
function populateModal(portfolio) {
    // Заполняем заголовок и описание
    document.querySelector('.modal-title').textContent = portfolio.title;
    document.querySelector('.modal-description').textContent = portfolio.description;
    
    // Подготовка массива изображений
    slides = [];
    
    if (portfolio.images && portfolio.images.length > 0) {
        // Здесь мы получаем массив URL-адресов изображений
        // в зависимости от структуры вашего API
        if (typeof portfolio.images[0] === 'object') {
            // Если каждое изображение - это объект с полем url или image
            slides = portfolio.images.map(img => img.image || img.url || img.path || '');
        } else {
            // Если массив содержит просто строки URL
            slides = portfolio.images;
        }
    }
    
    // Если изображений нет, добавим заглушку
    if (slides.length === 0) {
        slides = ['/images/no-image-available.jpg'];
    }
    
    // Обновляем слайдер и миниатюры
    updateSlider();
    
    // Обновляем информационный блок (год, категория)
    updateInfoRow(portfolio);
}

// Функция для обновления информационного блока
function updateInfoRow(portfolio) {
    const modalInfoRow = document.querySelector('.modal-info-row');
    let infoHTML = '';
    
    // Добавляем год, если он есть
    if (portfolio.year) {
        infoHTML += `
            <div class="modal-year">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                </svg>
                ${portfolio.year}
            </div>
        `;
    }
    
    // Добавляем категорию, если она есть
    if (portfolio.category) {
        // Проверяем структуру категории
        const categoryName = typeof portfolio.category === 'object' ? 
            portfolio.category.name || 'Без категории' : portfolio.category;
        
        infoHTML += `<div class="modal-category">${categoryName}</div>`;
    }
    
    modalInfoRow.innerHTML = infoHTML;
}

// Функция для обновления слайдера
function updateSlider() {
    currentSlide = 0;
    
    const slider = document.getElementById('modalSlider');
    const thumbnails = document.getElementById('modalThumbnails');
    
    // Очищаем слайдер и миниатюры
    slider.innerHTML = '';
    thumbnails.innerHTML = '';
    
    // Добавляем слайды и миниатюры
    slides.forEach((imageUrl, index) => {
        // Добавляем слайд
        slider.innerHTML += `
            <div class="modal-slide ${index === 0 ? 'active' : ''}" data-index="${index}">
                <img src="${imageUrl}" alt="Изображение проекта" class="modal-image">
            </div>
        `;
        
        // Добавляем миниатюру
        thumbnails.innerHTML += `
            <div class="modal-thumbnail ${index === 0 ? 'active' : ''}" onclick="showSlide(${index})">
                <img src="${imageUrl}" alt="Миниатюра">
            </div>
        `;
    });
    
    // Скрываем или отображаем кнопки навигации в зависимости от количества слайдов
    const navButtons = document.querySelectorAll('.modal-nav');
    if (slides.length <= 1) {
        navButtons.forEach(btn => btn.style.display = 'none');
        thumbnails.style.display = 'none';
    } else {
        navButtons.forEach(btn => btn.style.display = 'flex');
        thumbnails.style.display = 'flex';
    }
}

// Функция для переключения на конкретный слайд
function showSlide(index) {
    if (slides.length <= 1) return;
    
    // Нормализуем индекс (циклическая навигация)
    if (index < 0) index = slides.length - 1;
    if (index >= slides.length) index = 0;
    
    currentSlide = index;
    
    // Деактивируем все слайды и миниатюры
    document.querySelectorAll('.modal-slide').forEach(slide => {
        slide.classList.remove('active');
    });
    document.querySelectorAll('.modal-thumbnail').forEach(thumb => {
        thumb.classList.remove('active');
    });
    
    // Активируем нужный слайд и миниатюру
    document.querySelector(`.modal-slide[data-index="${index}"]`).classList.add('active');
    document.querySelectorAll('.modal-thumbnail')[index].classList.add('active');
}

// Функция для перехода к следующему слайду
function nextSlide() {
    showSlide(currentSlide + 1);
}

// Функция для перехода к предыдущему слайду
function prevSlide() {
    showSlide(currentSlide - 1);
}

// Функция закрытия модального окна
function closeModal() {
    const modal = document.getElementById('portfolioModal');
    modal.classList.remove('show');
    document.body.style.overflow = 'auto';
    
    // Очистка данных при закрытии
    slides = [];
    currentSlide = 0;
}

// Инициализация обработчиков событий при загрузке страницы
document.addEventListener('DOMContentLoaded', function() {
    // Закрытие по клику вне модального окна
    document.getElementById('portfolioModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    
    // Закрытие по клавише Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && document.getElementById('portfolioModal').classList.contains('show')) {
            closeModal();
        }
    });
});
