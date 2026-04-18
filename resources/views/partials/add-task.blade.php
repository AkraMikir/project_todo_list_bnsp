<!-- Add Task Modal -->
<x-modal id="add-task-modal" title="Tambah Tugas">
    <form action="{{ route('tasks.store') }}" method="POST" id="addTaskForm" x-data="{
        title: '',
        description: '',
        category_id: null,
        priority: 4,
        date_input: '{{ now()->format("Y-m-d") }}',
        time_input: '',
        hour: '12',
        minute: '00',
        showCategorySelector: false,
        showTimeSelector: false,
        showPrioritySelector: false
    }">
        @csrf
        
        <input type="hidden" name="category_id" x-model="category_id">
        <input type="hidden" name="priority" x-model="priority">
        <input type="hidden" name="date_input" x-model="date_input">
        <input type="hidden" name="time_input" x-model="time_input">

        <!-- Main Add block -->
        <div x-show="!showCategorySelector && !showTimeSelector && !showPrioritySelector">
            <input type="text" x-model="title" name="title" required placeholder="Belajar Laravel..." 
                   class="w-full text-xl bg-transparent border-none text-white focus:ring-0 px-0 mb-4 placeholder-gray-500 font-semibold focus:outline-none">
            
            <textarea x-model="description" name="description" placeholder="Deskripsi" rows="2"
                    class="w-full bg-transparent border-none text-[#AFAFAF] text-sm focus:ring-0 px-0 mb-4 placeholder-gray-600 resize-none focus:outline-none"></textarea>

            <div class="flex justify-between items-center mt-2">
                <div class="flex gap-4">
                    <button type="button" @click="showTimeSelector = true" class="text-gray-400 hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" :class="time_input ? 'text-[#8875FF]' : ''"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </button>
                    <button type="button" @click="showCategorySelector = true" class="text-gray-400 hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" :class="category_id ? 'text-[#8875FF]' : ''"><path d="M20 5H9.5a4.5 4.5 0 0 0-4.5 4.5v5a4.5 4.5 0 0 0 4.5 4.5H20Z"/><path d="M4.5 9.5 4 19"/></svg>
                    </button>
                    <button type="button" @click="showPrioritySelector = true" class="text-gray-400 hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" :class="priority != 4 ? 'text-[#8875FF]' : ''"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" x2="4" y1="22" y2="15"/></svg>
                    </button>
                </div>
                
                <button type="submit" x-bind:disabled="!title" class="text-[#8875FF] hover:text-white transition disabled:opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" x2="11" y1="2" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                </button>
            </div>
        </div>

        <!-- Inline Time/Date Selector -->
        <div x-show="showTimeSelector" style="display: none;" class="pb-12">
            <h4 class="text-center font-bold mb-6">Pilih Waktu</h4>
            <div class="mb-6">
                <!-- Native datetime local is simplest since Alpine complex datepickers are heavy -->
                <input type="date" x-model="date_input" class="w-full bg-[#1D1D1D] rounded px-4 py-3 text-white border border-[#3E3E3E] mb-4">
                <div class="flex items-center gap-4">
                    <div class="flex-1">
                        <label class="block text-xs text-[#AFAFAF] mb-1">Jam (24h)</label>
                        <select x-model="hour" class="w-full bg-[#1D1D1D] rounded px-4 py-3 text-white border border-[#3E3E3E] text-center focus:outline-none focus:border-[#8875FF]">
                            @for($i=0; $i<24; $i++)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                            @endfor
                        </select>
                    </div>
                    <span class="text-2xl font-bold self-end mb-2">:</span>
                    <div class="flex-1">
                        <label class="block text-xs text-[#AFAFAF] mb-1">Menit</label>
                        <select x-model="minute" class="w-full bg-[#1D1D1D] rounded px-4 py-3 text-white border border-[#3E3E3E] text-center focus:outline-none focus:border-[#8875FF]">
                            @for($i=0; $i<60; $i+=5)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="flex justify-between gap-4 mt-8">
                <button type="button" @click="showTimeSelector = false" class="w-full bg-transparent hover:bg-[#1D1D1D] text-[#8875FF] font-medium py-3 rounded transition-colors focus:ring-4 focus:ring-[#8875FF]/30 border border-[#8875FF]">Batal</button>
                <button type="button" @click="time_input = hour + ':' + minute; showTimeSelector = false" class="w-full bg-[#8875FF] hover:bg-[#6B5CE7] text-white font-medium py-3 rounded transition-colors focus:ring-4 focus:ring-[#8875FF]/30">Simpan</button>
            </div>
        </div>

        <!-- Inline Category Selector -->
        <div x-show="showCategorySelector" style="display: none;" class="pb-12">
            <h4 class="text-center font-bold mb-6">Pilih Kategori</h4>
            <div class="grid grid-cols-3 gap-4 mb-6 text-center max-h-60 overflow-y-auto">
                @foreach (auth()->check() ? auth()->user()->categories : [] as $category)
                    <div @click="category_id = {{ $category->id }}; showCategorySelector = false" 
                         class="flex flex-col items-center gap-2 cursor-pointer p-2 rounded hover:bg-[#272727] transition-colors"
                         :class="category_id == {{ $category->id }} ? 'bg-[#272727] ring-1 ring-white' : ''">
                        <div class="w-16 h-16 rounded flex justify-center items-center text-2xl" style="background-color: {{ $category->color }}">{{ $category->icon }}</div>
                        <span class="text-xs">{{ $category->name }}</span>
                    </div>
                @endforeach
                <!-- Create New -> Route -->
                <a href="{{ route('categories.index') }}" class="flex flex-col items-center gap-2 cursor-pointer p-2 rounded hover:bg-[#272727] transition-colors">
                    <div class="w-16 h-16 rounded bg-[#20FF96] flex justify-center items-center text-2xl text-[#1D1D1D]"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div>
                    <span class="text-xs">Buat Baru</span>
                </a>
            </div>
        </div>

        <!-- Inline Priority Selector -->
        <div x-show="showPrioritySelector" style="display: none;" class="pb-12">
            <h4 class="text-center font-bold mb-6 border-b border-[#3E3E3E] pb-2">Prioritas Tugas</h4>
            <div class="grid grid-cols-4 gap-4 mb-8 text-center pt-2">
                @for($i = 1; $i <= 10; $i++)
                    <div @click="priority = {{ $i }}" 
                         class="cursor-pointer py-3 rounded-lg flex flex-col items-center justify-center transition-colors"
                         :class="priority == {{ $i }} ? 'bg-[#8875FF]' : 'bg-[#272727] hover:bg-[#3E3E3E]'">
                         <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 opacity-80"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" x2="4" y1="22" y2="15"/></svg>
                        <span>{{ $i }}</span>
                    </div>
                @endfor
            </div>
            <div class="flex justify-between gap-4">
                <button type="button" @click="showPrioritySelector = false" class="w-full bg-transparent hover:bg-[#1D1D1D] text-[#8875FF] font-medium py-3 rounded transition-colors focus:ring-4 focus:ring-[#8875FF]/30 border border-[#8875FF]">Batal</button>
                <button type="button" @click="showPrioritySelector = false" class="w-full bg-[#8875FF] hover:bg-[#6B5CE7] text-white font-medium py-3 rounded transition-colors focus:ring-4 focus:ring-[#8875FF]/30">Simpan</button>
            </div>
        </div>
    </form>
</x-modal>
