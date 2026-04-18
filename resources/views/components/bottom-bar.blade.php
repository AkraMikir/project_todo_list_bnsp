    <div class="fixed bottom-0 left-0 w-full bg-[#363636] z-50 pb-8 sm:pb-4 border-t border-[#3E3E3E]">
        <div class="w-full px-6 md:px-24 lg:px-36 xl:px-64 py-4 flex justify-between items-center relative">
            <!-- Index / Home -->
            <a href="{{ route('tasks.index') }}" class="nav-item flex flex-col items-center gap-1 {{ request()->routeIs('tasks.index') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white hover:text-[#8875FF] transition-colors"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                <span class="text-xs text-white">Beranda</span>
            </a>

            <!-- Calendar -->
            <a href="{{ route('calendar.index') }}" class="nav-item flex flex-col items-center gap-1 {{ request()->routeIs('calendar.index') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white hover:text-[#8875FF] transition-colors"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                <span class="text-xs text-white">Kalender</span>
            </a>

            <!-- Add Task FAB -->
            <div class="relative -top-8 flex justify-center">
                <button type="button" x-data @click="$dispatch('open-modal', 'add-task-modal')" class="w-16 h-16 bg-[#8875FF] rounded-full flex items-center justify-center shadow-lg hover:bg-[#6B5CE7] transition-all transform hover:scale-110 focus:outline-none focus:ring-4 focus:ring-[#8875FF]/30">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg>
                </button>
            </div>

            <!-- Category -->
            <a href="{{ route('categories.index') }}" class="nav-item flex flex-col items-center gap-1 {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white hover:text-[#8875FF] transition-colors"><path d="M20 5H9.5a4.5 4.5 0 0 0-4.5 4.5v5a4.5 4.5 0 0 0 4.5 4.5H20Z"/><path d="M4.5 9.5 4 19"/></svg>
                <span class="text-xs text-white">Kategori</span>
            </a>

            <!-- Profile -->
            <a href="{{ route('profile.index') }}" class="nav-item flex flex-col items-center gap-1 {{ request()->routeIs('profile.index') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white hover:text-[#8875FF] transition-colors"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                <span class="text-xs text-white">Profil</span>
            </a>
        </div>
    </div>
