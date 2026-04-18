<x-layouts.app>
    <div x-data="{ step: 0 }" x-init="setTimeout(() => { if(step === 0) step = 1 }, 2000)" class="h-[100dvh] w-full flex flex-col justify-between text-white pb-6 px-6 font-sans overflow-hidden">
        
        <!-- STEP 0: Splash Screen -->
        <div x-show="step === 0" x-transition.opacity.duration.500ms class="fixed inset-0 bg-uptodo-bg flex items-center justify-center flex-col z-50">
            <svg width="95" height="95" viewBox="0 0 95 95" fill="none" class="mb-4">
                <rect width="95" height="95" rx="20" fill="#8875FF"/>
                <path d="M28 47L42 61L67 34" stroke="white" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <h1 class="text-4xl font-bold tracking-wide">UpTodo</h1>
        </div>

        <!-- Header Navigation (Skip Button Row) -->
        <div x-show="step > 0 && step < 4" class="w-full pt-4 flex justify-start z-40 h-14" x-cloak>
            <button @click="step = 4" class="text-gray-400 text-sm md:text-base hover:text-white uppercase px-2 py-1 font-medium transition-colors">SKIP</button>
        </div>

        <!-- Header Navigation (Back Button Row Step 4) -->
        <div x-show="step === 4" class="w-full pt-4 flex justify-start z-40 h-14" x-cloak>
            <button @click="step = 3" class="text-white hover:text-gray-300 p-2 -ml-2 transition-colors">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

        <!-- Center Content Container -->
        <div class="flex-1 w-full relative">
            <!-- Step 1 Content -->
            <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0" class="absolute inset-0 flex flex-col items-center justify-start text-center mt-4 w-full" x-cloak>
                <div class="h-64 md:h-80 w-full mb-10 flex items-center justify-center text-uptodo-purple relative">
                    <img src="{{ asset('images/time1.png') }}" alt="Kelola tugas" class="w-64 h-64 md:w-80 md:h-80 object-contain" />
                </div>
                <div class="flex gap-3 mb-10 items-center justify-center">
                    <div class="w-6 h-1 bg-white rounded-full"></div>
                    <div class="w-6 h-1 bg-[#AFAFAF] rounded-full"></div>
                    <div class="w-6 h-1 bg-[#AFAFAF] rounded-full"></div>
                </div>
                <h2 class="text-3xl font-bold mb-5 leading-tight">Kelola tugas Anda</h2>
                <p class="text-[#AFAFAF] text-base md:text-lg px-2 max-w-[320px] md:max-w-md mx-auto leading-relaxed">Anda dapat dengan mudah mengelola seluruh tugas harian Anda di UpTodo secara gratis</p>
            </div>

            <!-- Step 2 Content -->
            <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0" class="absolute inset-0 flex flex-col items-center justify-start text-center mt-4 w-full" x-cloak>
                <div class="h-64 md:h-80 w-full mb-10 flex items-center justify-center text-uptodo-purple relative">
                    <img src="{{ asset('images/time2.png') }}" alt="Buat rutinitas" class="w-64 h-64 md:w-80 md:h-80 object-contain" />
                </div>
                <div class="flex gap-3 mb-10 items-center justify-center">
                    <div class="w-6 h-1 bg-[#AFAFAF] rounded-full"></div>
                    <div class="w-6 h-1 bg-white rounded-full"></div>
                    <div class="w-6 h-1 bg-[#AFAFAF] rounded-full"></div>
                </div>
                <h2 class="text-3xl font-bold mb-5 leading-tight">Buat rutinitas harian</h2>
                <p class="text-[#AFAFAF] text-base md:text-lg px-2 max-w-[320px] md:max-w-md mx-auto leading-relaxed">Di UpTodo Anda dapat membuat rutinitas yang disesuaikan untuk tetap produktif</p>
            </div>

            <!-- Step 3 Content -->
            <div x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0" class="absolute inset-0 flex flex-col items-center justify-start text-center mt-4 w-full" x-cloak>
                <div class="h-64 md:h-80 w-full mb-10 flex items-center justify-center text-uptodo-purple relative">
                    <img src="{{ asset('images/time3.png') }}" alt="Atur tugas" class="w-64 h-64 md:w-80 md:h-80 object-contain" />
                </div>
                <div class="flex gap-3 mb-10 items-center justify-center">
                    <div class="w-6 h-1 bg-[#AFAFAF] rounded-full"></div>
                    <div class="w-6 h-1 bg-[#AFAFAF] rounded-full"></div>
                    <div class="w-6 h-1 bg-white rounded-full"></div>
                </div>
                <h2 class="text-3xl font-bold mb-5 leading-tight">Atur tugas Anda</h2>
                <p class="text-[#AFAFAF] text-base md:text-lg px-2 max-w-[320px] md:max-w-md mx-auto leading-relaxed">Anda dapat mengatur tugas harian Anda dengan menambahkannya ke kategori terpisah</p>
            </div>

            <!-- Step 4 Content (Start Screen) -->
            <div x-show="step === 4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="absolute inset-0 flex flex-col items-center justify-start text-center mt-6 w-full" x-cloak>
                <h1 class="text-[32px] md:text-4xl font-bold mb-6 leading-tight">Selamat datang di UpTodo</h1>
                <p class="text-[#AFAFAF] text-base md:text-lg px-2 max-w-[320px] md:max-w-md mx-auto leading-relaxed">Silakan masuk ke akun Anda atau buat akun baru untuk melanjutkan</p>
            </div>
        </div>

        <!-- Footer Navigation Container -->
        <div class="w-full relative mt-auto h-16">
            <!-- Footer Navigation Step 1 -->
            <div x-show="step === 1" class="absolute inset-0 flex justify-between items-center" x-cloak>
                <button class="text-transparent px-2 py-3 font-medium uppercase pointer-events-none">BACK</button>
                <button @click="step = 2" class="bg-uptodo-purple hover:bg-uptodo-purple-dark text-white px-6 py-3.5 rounded text-sm md:text-base font-medium transition-colors uppercase">NEXT</button>
            </div>

            <!-- Footer Navigation Step 2 -->
            <div x-show="step === 2" class="absolute inset-0 flex justify-between items-center" x-cloak>
                <button @click="step = 1" class="text-gray-400 hover:text-white px-2 py-3 font-medium uppercase transition-colors">BACK</button>
                <button @click="step = 3" class="bg-uptodo-purple hover:bg-uptodo-purple-dark text-white px-6 py-3.5 rounded text-sm md:text-base font-medium transition-colors uppercase">NEXT</button>
            </div>

            <!-- Footer Navigation Step 3 -->
            <div x-show="step === 3" class="absolute inset-0 flex justify-between items-center" x-cloak>
                <button @click="step = 2" class="text-gray-400 hover:text-white px-2 py-3 font-medium uppercase transition-colors">BACK</button>
                <button @click="step = 4" class="bg-uptodo-purple hover:bg-uptodo-purple-dark text-white px-6 py-3.5 rounded text-sm md:text-base font-medium transition-colors uppercase">GET STARTED</button>
            </div>

            <!-- Footer Navigation Step 4 -->
            <div x-show="step === 4" class="absolute inset-0 top-auto bottom-0 h-auto flex flex-col gap-4" x-cloak>
                <a href="{{ route('login') }}" class="w-full bg-uptodo-purple hover:bg-uptodo-purple-dark text-white py-3.5 rounded-md text-center text-sm md:text-base font-medium uppercase transition-colors block">
                    LOGIN
                </a>
                <a href="{{ route('register') }}" class="w-full bg-transparent border-2 border-uptodo-purple text-white hover:bg-uptodo-purple/10 py-3.5 rounded-md text-center text-sm md:text-base font-medium uppercase transition-colors block">
                    CREATE ACCOUNT
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
