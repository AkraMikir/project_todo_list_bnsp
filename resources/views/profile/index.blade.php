<x-layouts.app>
    <x-header title="Profil" />

    <div class="px-6 py-6 md:px-12 md:py-10 text-center text-white pb-24">
        <!-- Avatar Section -->
        <div class="mb-4 md:mb-8">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random&size=128" 
                 alt="User Avatar" class="w-24 h-24 md:w-32 md:h-32 mx-auto rounded-full border-4 border-uptodo-surface2 object-cover mb-4 md:mb-6 hover:scale-105 transition-transform cursor-pointer">
            <h2 class="text-xl md:text-3xl font-bold">{{ auth()->user()->name }}</h2>
            <p class="text-uptodo-muted text-sm md:text-base mt-1 md:mt-2">{{ auth()->user()->email }}</p>
        </div>

        <div class="grid grid-cols-2 gap-4 md:gap-8 mb-8 md:mb-12 max-w-2xl mx-auto">
            <div class="bg-uptodo-surface2 p-4 md:p-8 rounded-lg md:rounded-xl hover:bg-[#4a4a4a] transition-all transform hover:-translate-y-1 hover:shadow-lg">
                <span class="text-uptodo-purple text-xl md:text-4xl font-bold">{{ auth()->user()->tasks()->where('is_completed', false)->count() }}</span>
                <p class="text-uptodo-muted text-xs md:text-base mt-1 md:mt-2">Tugas tersisa</p>
            </div>
            <div class="bg-uptodo-surface2 p-4 md:p-8 rounded-lg md:rounded-xl hover:bg-[#4a4a4a] transition-all transform hover:-translate-y-1 hover:shadow-lg">
                <span class="text-uptodo-purple text-xl md:text-4xl font-bold">{{ auth()->user()->tasks()->where('is_completed', true)->count() }}</span>
                <p class="text-uptodo-muted text-xs md:text-base mt-1 md:mt-2">Tugas selesai</p>
            </div>
        </div>

        <!-- Log out Button -->
        <div class="mt-auto max-w-md mx-auto">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-between bg-transparent border border-red-500/50 hover:bg-red-500/10 text-[#FF4949] font-medium py-3 px-4 md:py-4 md:px-6 md:text-lg rounded md:rounded-lg transition-all transform hover:scale-105 focus:ring-2 focus:ring-red-500 focus:outline-none">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="md:w-6 md:h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                        <span>Keluar</span>
                    </div>
                </button>
            </form>
        </div>
    </div>
</x-layouts.app>
