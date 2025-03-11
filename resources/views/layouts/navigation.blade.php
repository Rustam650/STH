<nav class="bg-[#FFC145]">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="h-8 w-8 mr-2">
                    <span class="text-lg font-semibold text-[#1D1D1D]">STONEHILL - Админ панель</span>
                </a>
                
                <div class="ml-10 flex items-center space-x-4">
                    <a href="{{ route('admin.stone-types.index') }}" 
                       class="px-3 py-2 rounded-md text-sm font-medium text-[#1D1D1D] hover:text-white transition-colors">
                        Виды камня
                    </a>
                    <a href="{{ route('admin.services.index') }}" 
                       class="px-3 py-2 rounded-md text-sm font-medium text-[#1D1D1D] hover:text-white transition-colors">
                        Услуги
                    </a>
                    <a href="{{ route('admin.portfolio.index') }}" 
                       class="px-3 py-2 rounded-md text-sm font-medium text-[#1D1D1D] hover:text-white transition-colors">
                        Портфолио
                    </a>
                    <a href="{{ route('admin.contacts.edit') }}" 
                       class="px-3 py-2 rounded-md text-sm font-medium text-[#1D1D1D] hover:text-white transition-colors">
                        Контакты
                    </a>
                </div>
            </div>

            <div class="flex items-center">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center text-sm text-[#1D1D1D] hover:text-white px-3 py-2 rounded-md">
                        {{ Auth::user()->name }}
                        <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Выйти
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
