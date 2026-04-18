<x-layouts.app>
    <x-header title="Kategori">
        <x-slot name="left">
            <button onclick="window.history.back()" class="text-white hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            </button>
        </x-slot>
    </x-header>

    <div class="px-6 py-6 md:py-10 pb-24 md:px-12">
        <!-- Add Category Form -->
        <h2 class="text-xl md:text-3xl font-semibold text-white mb-6 md:mb-10">Buat kategori baru</h2>
        
        <div class="space-y-6 md:space-y-8" x-data="{
            name: '',
            icon: 'home',
            color: '#8875FF',
            availableColors: [
                '#FFCC80', '#FF9680', '#80FFFF', '#CCFF80', '#809CFF', '#FF80EB', '#FC80FF', '#80FFA3', '#FF8080'
            ]
        }">
            <form id="createCategoryForm" action="{{ route('categories.store') }}" method="POST">
                @csrf

            <!-- Name -->
            <div>
                <label class="block text-sm md:text-lg font-medium text-white mb-2 md:mb-3">Nama kategori :</label>
                <input type="text" name="name" x-model="name" required
                       class="w-full bg-uptodo-bg border border-[#979797] rounded md:rounded-lg px-4 py-3 md:py-4 md:text-lg text-white focus:outline-none focus:border-uptodo-purple hover:border-gray-400 transition-colors"
                       placeholder="Nama kategori">
            </div>

            <!-- Icon -->
            <div class="mb-4 md:mb-6">
                <label class="block text-sm md:text-lg font-medium text-white mb-2 md:mb-3">Ikon kategori :</label>
                <input type="hidden" name="icon" x-model="icon">
                <div class="flex flex-wrap gap-3 md:gap-5">
                    @php
                        $availableIcons = ['briefcase', 'shopping-cart', 'activity', 'pen-tool', 'graduation-cap', 'users', 'music', 'heart', 'film', 'home'];
                    @endphp
                    @foreach($availableIcons as $i)
                        <button type="button" @click="icon = '{{ $i }}'" 
                                :class="icon === '{{ $i }}' ? 'border-uptodo-purple scale-110 shadow-lg bg-[#4a4a4a] text-uptodo-purple' : 'border-uptodo-border hover:border-uptodo-purple/50 text-[#AFAFAF] hover:text-white'"
                                class="w-12 h-12 md:w-14 md:h-14 bg-uptodo-surface2 rounded-md md:rounded-lg flex items-center justify-center border transition-all transform hover:scale-110 hover:shadow-lg">
                            <x-icon name="{{ $i }}" class="w-6 h-6 md:w-8 md:h-8" />
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Color -->
            <div>
                <label class="block text-sm md:text-lg font-medium text-white mb-2 md:mb-3">Warna kategori :</label>
                <input type="hidden" name="color" x-model="color">
                <div class="flex flex-wrap gap-3 md:gap-5">
                    <template x-for="c in availableColors" :key="c">
                        <button type="button" @click="color = c" class="w-8 h-8 md:w-12 md:h-12 rounded-full flex items-center justify-center transition-all transform hover:scale-125 hover:shadow-lg" :style="`background-color: ${c}`">
                            <svg x-show="color === c" xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="md:w-6 md:h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-white"><polyline points="20 6 9 17 4 12"/></svg>
                        </button>
                    </template>
                </div>
            </div>
            </form>

            <!-- Existing Categories List -->
            <div class="pt-8 md:pt-12">
                <h3 class="text-uptodo-muted text-sm md:text-xl font-medium mb-4 md:mb-6 uppercase tracking-wider">Kategori Anda</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                    @forelse($categories as $category)
                        <div class="bg-uptodo-surface2 p-4 md:p-6 rounded-lg md:rounded-xl flex items-center gap-3 md:gap-4 hover:bg-[#4a4a4a] transition-all transform hover:-translate-y-1 hover:shadow-lg border border-transparent hover:border-uptodo-purple/30">
                            <div class="w-10 h-10 md:w-14 md:h-14 rounded-full flex justify-center items-center text-lg md:text-2xl shadow-sm text-white" style="background-color: {{ $category->color }}"><x-icon name="{{ $category->icon }}" class="w-5 h-5 md:w-7 md:h-7" /></div>
                            <div class="flex-1 overflow-hidden">
                                <h4 class="text-white text-sm md:text-lg font-medium truncate">{{ $category->name }}</h4>
                            </div>
                            <!-- Delete Route -->
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="m-0" onsubmit="return confirm('Hapus kategori ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-400 transition-transform transform hover:scale-125 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="md:w-6 md:h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                </button>
                            </form>
                        </div>
                    @empty
                        <p class="text-uptodo-muted text-sm md:text-lg italic col-span-2 md:col-span-4">Belum ada kategori buatan sendiri.</p>
                    @endforelse
                </div>
            </div>

            <div class="fixed bottom-24 left-0 w-full flex justify-center px-6 sticky-btns" style="position: fixed; bottom: 100px;">
                <div class="w-full max-w-[342px] md:max-w-xl flex justify-between gap-4 md:gap-8">
                    <button type="button" onclick="window.history.back()" class="flex-1 bg-transparent hover:bg-uptodo-bg text-uptodo-purple font-medium py-3 md:py-4 md:text-lg rounded md:rounded-lg transition-all transform hover:scale-105 border border-uptodo-purple">Batal</button>
                    <button type="submit" form="createCategoryForm" class="flex-1 bg-uptodo-purple hover:bg-uptodo-purple-dark text-white font-medium py-3 md:py-4 md:text-lg rounded md:rounded-lg transition-all transform hover:scale-105 shadow-lg shadow-uptodo-purple/20" x-bind:disabled="!name">Buat Kategori</button>
                </div>
            </div>
            <!-- padding to avoid button overlap with the list -->
            <div class="h-[100px]"></div>
        </div>
    </div>
</x-layouts.app>
