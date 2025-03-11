// Валидация формы
document.getElementById('sectionForm').addEventListener('submit', function(e) {
    const title = document.querySelector('input[name="title"]');
    if(title.value.trim() === '') {
        e.preventDefault();
        title.classList.add('is-invalid');
        title.nextElementSibling.textContent = 'Поле заголовок обязательно для заполнения';
    }
});

// Обработка изображений
function handleImagePreview(input) {
    if(input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector('.image-preview').innerHTML = `
                <img src="${e.target.result}" 
                     class="img-fluid rounded" 
                     alt="Preview" 
                     style="max-height: 200px;">
            `;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Переключение источников изображения
document.querySelectorAll('input[name="bg_type"]').forEach(radio => {
    radio.addEventListener('change', function() {
        document.querySelectorAll('.bg-source').forEach(el => {
            el.style.display = 'none';
        });
        document.querySelector(`.bg-${this.value}`).style.display = 'block';
        
        if(this.value === 'file') {
            document.querySelector('input[name="background_image"]').required = true;
            document.querySelector('input[name="background_url"]').required = false;
        } else {
            document.querySelector('input[name="background_image"]').required = false;
            document.querySelector('input[name="background_url"]').required = true;
        }
    });
});