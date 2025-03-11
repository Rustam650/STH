<footer class="bg-[#1D1D1D] text-white h-[570px]">
    <div class="container mx-auto px-4 py-12 h-full">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 h-[400px]">
            <!-- Логотип и описание -->
            <div>
                <img src="{{ asset('images/logo.svg') }}" alt="STONEHILL" class="h-8 mb-4">
                <p class="text-sm">
                    Создаем уникальные решения из натурального камня для вашего интерьера и экстерьера
                </p>
                <div class="flex space-x-4 mt-4">
                    <a href="#" class="border border-[#FFC145] text-[#FFC145] px-4 py-2 rounded hover:bg-[#FFC145] hover:text-[#1D1D1D]">
                        Telegram
                    </a>
                    <a href="#" class="border border-[#FFC145] text-[#FFC145] px-4 py-2 rounded hover:bg-[#FFC145] hover:text-[#1D1D1D]">
                        WhatsApp
                    </a>
                </div>
            </div>

            <!-- Навигация -->
            <div>
                <h3 class="text-[#FFC145] text-lg font-semibold mb-4">Навигация</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('stone-types.index') }}" class="hover:text-[#FFC145]">Виды камня</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-[#FFC145]">Услуги</a></li>
                    <li><a href="{{ route('portfolio') }}" class="hover:text-[#FFC145]">Портфолио</a></li>
                    <li><a href="{{ route('contacts') }}" class="hover:text-[#FFC145]">Контакты</a></li>
                </ul>
            </div>

            <!-- Контакты -->
            <div>
                <h3 class="text-[#FFC145] text-lg font-semibold mb-4">Контакты</h3>
                <div class="space-y-2">
                    <p class="font-bold">ТЕЛЕФОН:</p>
                    <p>+7 (929) 989-55-55</p>
                    <p class="font-bold mt-4">EMAIL:</p>
                    <p>stone.hill@mail.ru</p>
                    <p class="font-bold mt-4">АДРЕС:</p>
                    <p>г. Махачкала, ул. Танкаева 57</p>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-700 mt-8 pt-8 flex justify-between items-center text-sm">
            <p>© 2025 STONEHILL. Все права защищены</p>
            <div class="flex space-x-4">
                <a href="#" class="hover:text-[#FFC145]">Политика конфиденциальности</a>
                <a href="#" class="hover:text-[#FFC145]">Пользовательское соглашение</a>
            </div>
        </div>
    </div>
</footer> 