<!-- Add Task Modal -->
<x-modal id="add-task-modal" title="Tambah Tugas">
    <form action="{{ route('tasks.store') }}" method="POST" id="addTaskForm" x-data="{
        title: '',
        description: '',
        category_id: null,
        priority: 2,
        date_input: '{{ now()->format("Y-m-d") }}',
        time_input: '',
        deadline_date: '',
        deadline_time: '',
        hour: '12',
        minute: '00',
        deadline_hour: '12',
        deadline_minute: '00',
        showCategorySelector: false,
        showTimeSelector: false,
        showDeadlineSelector: false,
        showPrioritySelector: false
    }">
        @csrf
        
        <input type="hidden" name="category_id" x-model="category_id">
        <input type="hidden" name="priority" x-model="priority">
        <input type="hidden" name="date_input" x-model="date_input">
        <input type="hidden" name="time_input" x-model="time_input">
        <input type="hidden" name="deadline_date" x-model="deadline_date">
        <input type="hidden" name="deadline_time" x-model="deadline_time">

        <!-- Main Add block -->
        <div x-show="!showCategorySelector && !showTimeSelector && !showPrioritySelector && !showDeadlineSelector">
            <input type="text" x-model="title" name="title" required placeholder="Belajar Laravel..." 
                   class="w-full text-xl bg-transparent border-none text-white focus:ring-0 px-0 mb-4 placeholder-gray-500 font-semibold focus:outline-none">
            
            <textarea x-model="description" name="description" placeholder="Deskripsi" rows="2"
                    class="w-full bg-transparent border-none text-uptodo-muted text-sm focus:ring-0 px-0 mb-4 placeholder-gray-600 resize-none focus:outline-none"></textarea>

            <div class="flex justify-between items-center mt-2">
                <div class="flex gap-4">
                    <button type="button" @click="showTimeSelector = true" class="text-gray-400 hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" :class="time_input ? 'text-uptodo-purple' : ''"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </button>
                    <button type="button" @click="showDeadlineSelector = true" class="text-gray-400 hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" :class="deadline_date ? 'text-uptodo-purple' : ''"><path d="M12 2v4"/><path d="M12 18v4"/><path d="M4.93 4.93l2.83 2.83"/><path d="M16.24 16.24l2.83 2.83"/><path d="M2 12h4"/><path d="M18 12h4"/><path d="M4.93 19.07l2.83-2.83"/><path d="M16.24 7.76l2.83-2.83"/></svg>
                    </button>
                    <button type="button" @click="showCategorySelector = true" class="text-gray-400 hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" :class="category_id ? 'text-uptodo-purple' : ''"><path d="M20 5H9.5a4.5 4.5 0 0 0-4.5 4.5v5a4.5 4.5 0 0 0 4.5 4.5H20Z"/><path d="M4.5 9.5 4 19"/></svg>
                    </button>
                    <button type="button" @click="showPrioritySelector = true" class="text-gray-400 hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" :class="priority != 2 ? 'text-uptodo-purple' : ''"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" x2="4" y1="22" y2="15"/></svg>
                    </button>
                </div>
                
                <button type="submit" x-bind:disabled="!title" class="text-uptodo-purple hover:text-white transition disabled:opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" x2="11" y1="2" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                </button>
            </div>
        </div>

        <!-- Inline Time/Date Selector -->
        <div x-show="showTimeSelector" style="display: none;" class="pb-12">
            <h4 class="text-center font-bold mb-6">Pilih Waktu</h4>
            <div class="mb-6">
                <!-- Native datetime local is simplest since Alpine complex datepickers are heavy -->
                <input type="date" x-model="date_input" class="w-full bg-uptodo-bg rounded px-4 py-3 text-white border border-uptodo-border mb-4">
                <div class="flex items-center gap-4">
                    <div class="flex-1">
                        <label class="block text-xs text-uptodo-muted mb-1">Jam (24h)</label>
                        <select x-model="hour" class="w-full bg-uptodo-bg rounded px-4 py-3 text-white border border-uptodo-border text-center focus:outline-none focus:border-uptodo-purple">
                            @for($i=0; $i<24; $i++)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                            @endfor
                        </select>
                    </div>
                    <span class="text-2xl font-bold self-end mb-2">:</span>
                    <div class="flex-1">
                        <label class="block text-xs text-uptodo-muted mb-1">Menit</label>
                        <select x-model="minute" class="w-full bg-uptodo-bg rounded px-4 py-3 text-white border border-uptodo-border text-center focus:outline-none focus:border-uptodo-purple">
                            @for($i=0; $i<60; $i+=5)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="flex justify-between gap-4 mt-8">
                <button type="button" @click="showTimeSelector = false" class="w-full bg-transparent hover:bg-uptodo-bg text-uptodo-purple font-medium py-3 rounded transition-colors focus:ring-4 focus:ring-uptodo-purple/30 border border-uptodo-purple">Batal</button>
                <button type="button" @click="time_input = hour + ':' + minute; showTimeSelector = false" class="w-full bg-uptodo-purple hover:bg-uptodo-purple-dark text-white font-medium py-3 rounded transition-colors focus:ring-4 focus:ring-uptodo-purple/30">Simpan</button>
            </div>
        </div>

        <!-- Inline Deadline Selector -->
        <div x-show="showDeadlineSelector" style="display: none;" class="pb-12">
            <h4 class="text-center font-bold mb-6">Pilih Deadline</h4>
            <div class="mb-6">
                <input type="date" x-model="deadline_date" class="w-full bg-uptodo-bg rounded px-4 py-3 text-white border border-uptodo-border mb-4">
                <div class="flex items-center gap-4">
                    <div class="flex-1">
                        <label class="block text-xs text-uptodo-muted mb-1">Jam (24h)</label>
                        <select x-model="deadline_hour" class="w-full bg-uptodo-bg rounded px-4 py-3 text-white border border-uptodo-border text-center focus:outline-none focus:border-uptodo-purple">
                            @for($i=0; $i<24; $i++)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                            @endfor
                        </select>
                    </div>
                    <span class="text-2xl font-bold self-end mb-2">:</span>
                    <div class="flex-1">
                        <label class="block text-xs text-uptodo-muted mb-1">Menit</label>
                        <select x-model="deadline_minute" class="w-full bg-uptodo-bg rounded px-4 py-3 text-white border border-uptodo-border text-center focus:outline-none focus:border-uptodo-purple">
                            @for($i=0; $i<60; $i+=5)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="flex justify-between gap-4 mt-8">
                <button type="button" @click="deadline_date = ''; deadline_time = ''; showDeadlineSelector = false" class="w-full bg-transparent hover:bg-uptodo-bg text-red-500 font-medium py-3 rounded transition-colors focus:ring-4 focus:ring-red-500/30 border border-red-500">Hapus</button>
                <button type="button" @click="deadline_time = deadline_hour + ':' + deadline_minute; showDeadlineSelector = false" class="w-full bg-uptodo-purple hover:bg-uptodo-purple-dark text-white font-medium py-3 rounded transition-colors focus:ring-4 focus:ring-uptodo-purple/30">Simpan</button>
            </div>
        </div>

        <!-- Inline Category Selector -->
        <div x-show="showCategorySelector" style="display: none;" class="pb-12">
            <h4 class="text-center font-bold mb-6">Pilih Kategori</h4>
            <div class="grid grid-cols-3 gap-4 mb-6 text-center max-h-60 overflow-y-auto">
                @foreach (auth()->check() ? auth()->user()->categories : [] as $category)
                    <div @click="category_id = {{ $category->id }}; showCategorySelector = false" 
                         class="flex flex-col items-center gap-2 cursor-pointer p-2 rounded hover:bg-uptodo-surface transition-colors"
                         :class="category_id == {{ $category->id }} ? 'bg-uptodo-surface ring-1 ring-white' : ''">
                        <div class="w-16 h-16 rounded flex justify-center items-center text-white" style="background-color: {{ $category->color }}"><x-icon name="{{ $category->icon }}" class="w-8 h-8" /></div>
                        <span class="text-xs">{{ $category->name }}</span>
                    </div>
                @endforeach
                <!-- Create New -> Route -->
                <a href="{{ route('categories.index') }}" class="flex flex-col items-center gap-2 cursor-pointer p-2 rounded hover:bg-uptodo-surface transition-colors">
                    <div class="w-16 h-16 rounded bg-[#20FF96] flex justify-center items-center text-2xl text-uptodo-bg"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div>
                    <span class="text-xs">Buat Baru</span>
                </a>
            </div>
        </div>

        <!-- Inline Priority Selector -->
        <div x-show="showPrioritySelector" style="display: none;" class="pb-12">
            <h4 class="text-center font-bold mb-6 border-b border-uptodo-border pb-2">Prioritas Tugas</h4>
            <div class="grid grid-cols-3 gap-4 mb-8 text-center pt-2">
                <!-- Tinggi (High) -->
                <div @click="priority = 1" 
                     class="cursor-pointer py-3 rounded-lg flex flex-col items-center justify-center transition-colors border"
                     :class="priority == 1 ? 'bg-red-500 border-red-500 text-white shadow-[0_0_15px_rgba(239,68,68,0.5)] scale-105' : 'bg-transparent hover:bg-uptodo-surface border-red-500/30 text-red-400'">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 opacity-80"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" x2="4" y1="22" y2="15"/></svg>
                    <span class="font-bold text-sm">Tinggi</span>
                </div>
                <!-- Sedang (Medium) -->
                <div @click="priority = 2" 
                     class="cursor-pointer py-3 rounded-lg flex flex-col items-center justify-center transition-colors border"
                     :class="priority == 2 ? 'bg-yellow-500 border-yellow-500 text-white shadow-[0_0_15px_rgba(234,179,8,0.5)] scale-105' : 'bg-transparent hover:bg-uptodo-surface border-yellow-500/30 text-yellow-500'">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 opacity-80"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" x2="4" y1="22" y2="15"/></svg>
                    <span class="font-bold text-sm">Sedang</span>
                </div>
                <!-- Rendah (Low) -->
                <div @click="priority = 3" 
                     class="cursor-pointer py-3 rounded-lg flex flex-col items-center justify-center transition-colors border"
                     :class="priority == 3 ? 'bg-green-500 border-green-500 text-white shadow-[0_0_15px_rgba(34,197,94,0.5)] scale-105' : 'bg-transparent hover:bg-uptodo-surface border-green-500/30 text-green-400'">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 opacity-80"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" x2="4" y1="22" y2="15"/></svg>
                    <span class="font-bold text-sm">Rendah</span>
                </div>
            </div>
            <div class="flex justify-between gap-4">
                <button type="button" @click="showPrioritySelector = false" class="w-full bg-transparent hover:bg-uptodo-bg text-uptodo-purple font-medium py-3 rounded transition-colors focus:ring-4 focus:ring-uptodo-purple/30 border border-uptodo-purple">Batal</button>
                <button type="button" @click="showPrioritySelector = false" class="w-full bg-uptodo-purple hover:bg-uptodo-purple-dark text-white font-medium py-3 rounded transition-colors focus:ring-4 focus:ring-uptodo-purple/30">Simpan</button>
            </div>
        </div>
    </form>
</x-modal>
