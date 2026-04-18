<x-layouts.app>
    <x-header title="Detail Tugas">
        <x-slot name="left">
            <button onclick="window.history.back()" class="text-white hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            </button>
        </x-slot>
        <x-slot name="right">
            <div x-data>
                <button @click="$dispatch('open-modal', 'edit-task-modal')" class="text-white hover:text-[#8875FF] transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                </button>
            </div>
        </x-slot>
    </x-header>

    <div class="px-6 py-6 pb-24">
        <!-- Title and Checkbox -->
        <div class="flex items-start gap-4 mb-8">
            <form method="POST" action="{{ route('tasks.toggle', $task) }}" class="m-0 p-0 flex items-center pt-2">
                @csrf
                <input type="checkbox" class="task-check w-6 h-6 md:w-8 md:h-8" onChange="this.form.submit()" {{ $task->is_completed ? 'checked' : '' }}>
            </form>
            <div>
                <h1 class="text-2xl font-semibold text-white {{ $task->is_completed ? 'line-through text-gray-400' : '' }} mb-2">{{ $task->title }}</h1>
                <p class="text-[#AFAFAF] text-sm">{{ $task->description ?? 'Tidak ada deskripsi.' }}</p>
            </div>
        </div>

        <!-- Task Metadata List -->
        <div class="space-y-6">
            <!-- Time -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    <span class="text-base text-[#AFAFAF]">Waktu Tugas :</span>
                </div>
                <div class="bg-[#363636] px-4 py-2 rounded">
                    <span class="text-white text-sm">
                        @if($task->due_datetime)
                            {{ $task->due_datetime->isToday() ? 'Hari Ini' : $task->due_datetime->format('d M') }} Pukul {{ $task->due_datetime->format('H:i') }}
                        @else
                            Waktu belum diatur
                        @endif
                    </span>
                </div>
            </div>

            <!-- Category -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 5H9.5a4.5 4.5 0 0 0-4.5 4.5v5a4.5 4.5 0 0 0 4.5 4.5H20Z"/><path d="M4.5 9.5 4 19"/></svg>
                    <span class="text-base text-[#AFAFAF]">Kategori Tugas :</span>
                </div>
                <div>
                    @if($task->category)
                        <div class="px-4 py-2 flex items-center gap-2 rounded text-sm text-white" style="background-color: {{ $task->category->color }}">
                            <span>{{ $task->category->icon }}</span>
                            <span>{{ $task->category->name }}</span>
                        </div>
                    @else
                        <div class="bg-[#363636] px-4 py-2 rounded text-white text-sm">Tanpa kategori</div>
                    @endif
                </div>
            </div>

            <!-- Priority -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" x2="4" y1="22" y2="15"/></svg>
                    <span class="text-base text-[#AFAFAF]">Prioritas Tugas :</span>
                </div>
                <div class="bg-[#363636] px-4 py-2 rounded">
                    <span class="text-white text-sm">{{ $task->priority ?? 'Bawaan' }}</span>
                </div>
            </div>

            <!-- Sub Tasks section -->
            <div class="mt-8">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 6h13"/><path d="M8 12h13"/><path d="M8 18h13"/><path d="M3 6h.01"/><path d="M3 12h.01"/><path d="M3 18h.01"/></svg>
                        <span class="text-base text-[#AFAFAF]">Sub-Tugas</span>
                    </div>
                </div>

                <div class="space-y-3 pl-2">
                    @foreach($task->subTasks as $subTask)
                        <div class="flex items-center justify-between bg-[#363636] rounded px-4 py-3 hover:bg-[#3E3E3E] transition-colors shadow-sm">
                            <div class="flex items-center gap-3 flex-1">
                                <form method="POST" action="{{ route('sub_tasks.toggle', $subTask) }}" class="m-0 p-0 flex items-center">
                                    @csrf
                                    <input type="checkbox" class="task-check w-4 h-4 md:w-5 md:h-5 cursor-pointer" onChange="this.form.submit()" {{ $subTask->is_completed ? 'checked' : '' }}>
                                </form>
                                <span class="text-white {{ $subTask->is_completed ? 'line-through text-gray-500' : '' }} text-sm font-medium">{{ $subTask->title }}</span>
                            </div>
                            <form method="POST" action="{{ route('sub_tasks.destroy', $subTask) }}" class="m-0 p-0 flex items-center" onsubmit="return confirm('Hapus sub-tugas?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <!-- Add SubTask Form -->
                <form action="{{ route('sub_tasks.store', $task) }}" method="POST" class="mt-4 flex gap-3 ml-2">
                    @csrf
                    <input type="text" name="title" required placeholder="Tambah sub-tugas baru..." class="flex-grow bg-[#363636] hover:bg-[#3E3E3E] transition-colors rounded px-4 py-3 text-white border border-[#3E3E3E] focus:outline-none focus:border-[#8875FF] text-sm shadow-sm placeholder-[#AFAFAF]">
                    <button type="submit" class="bg-transparent text-[#8875FF] border border-[#8875FF] px-4 py-2 hover:bg-[#8875FF] hover:text-white rounded transition-colors text-sm shadow-sm font-medium flex-shrink-0 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Tambah
                    </button>
                </form>
            </div>
            
            <!-- Delete Task -->
            <div class="flex items-center justify-start mt-8 pt-4">
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex items-center gap-3 text-[#FF4949] hover:text-red-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                        <span class="text-base">Hapus Tugas</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Task Modal -->
    <x-modal id="edit-task-modal" title="Ubah Tugas">
        <form action="{{ route('tasks.update', $task) }}" method="POST" id="editTaskForm" x-data="{
            title: '{{ addslashes($task->title) }}',
            description: '{{ addslashes($task->description ?? '') }}',
            category_id: {{ $task->category_id ?? 'null' }},
            priority: {{ $task->priority ?? 4 }},
            date_input: '{{ $task->due_datetime ? $task->due_datetime->format("Y-m-d") : now()->format("Y-m-d") }}',
            time_input: '{{ $task->due_datetime ? $task->due_datetime->format("H:i") : "" }}',
            hour: '{{ $task->due_datetime ? $task->due_datetime->format("H") : "12" }}',
            minute: '{{ $task->due_datetime ? $task->due_datetime->format("i") : "00" }}',
            showCategorySelector: false,
            showTimeSelector: false,
            showPrioritySelector: false
        }">
            @csrf
            @method('PUT')
            
            <input type="hidden" name="category_id" x-model="category_id">
            <input type="hidden" name="priority" x-model="priority">
            <input type="hidden" name="date_input" x-model="date_input">
            <input type="hidden" name="time_input" x-model="time_input">

            <!-- Main Edit block -->
            <div x-show="!showCategorySelector && !showTimeSelector && !showPrioritySelector">
                <input type="text" x-model="title" name="title" required placeholder="Contoh: Belajar Mtk" 
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
                    
                    <button type="submit" x-bind:disabled="!title" class="text-[#8875FF] hover:text-white transition disabled:opacity-50 flex items-center gap-2">
                        <span class="text-sm font-semibold">Simpan</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" x2="11" y1="2" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    </button>
                </div>
            </div>

            <!-- Inline Time/Date Selector -->
            <div x-show="showTimeSelector" style="display: none;" class="pb-12">
                <h4 class="text-center font-bold mb-6 text-white">Pilih Waktu</h4>
                <div class="mb-6">
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
                    <button type="button" @click="showTimeSelector = false" class="w-full bg-transparent hover:bg-[#1D1D1D] text-[#8875FF] font-medium py-3 rounded transition-colors border border-[#8875FF]">Batal</button>
                    <button type="button" @click="time_input = hour + ':' + minute; showTimeSelector = false" class="w-full bg-[#8875FF] hover:bg-[#6B5CE7] text-white font-medium py-3 rounded transition-colors shadow-lg">Simpan</button>
                </div>
            </div>

            <!-- Inline Category Selector -->
            <div x-show="showCategorySelector" style="display: none;" class="pb-12">
                <h4 class="text-center font-bold mb-6 text-white">Pilih Kategori</h4>
                <div class="grid grid-cols-3 gap-4 mb-6 text-center max-h-60 overflow-y-auto">
                    @foreach (auth()->check() ? auth()->user()->categories : [] as $category)
                        <div @click="category_id = {{ $category->id }}; showCategorySelector = false" 
                             class="flex flex-col items-center gap-2 cursor-pointer p-2 rounded hover:bg-[#272727] transition-colors"
                             :class="category_id == {{ $category->id }} ? 'bg-[#272727] ring-1 ring-white' : ''">
                            <div class="w-16 h-16 rounded flex justify-center items-center text-2xl" style="background-color: {{ $category->color }}">{{ $category->icon }}</div>
                            <span class="text-xs text-white">{{ $category->name }}</span>
                        </div>
                    @endforeach
                    <!-- Create New -> Route -->
                    <a href="{{ route('categories.index') }}" class="flex flex-col items-center gap-2 cursor-pointer p-2 rounded hover:bg-[#272727] transition-colors">
                        <div class="w-16 h-16 rounded bg-[#20FF96] flex justify-center items-center text-2xl text-[#1D1D1D]"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div>
                        <span class="text-xs text-white">Buat Baru</span>
                    </a>
                </div>
            </div>

            <!-- Inline Priority Selector -->
            <div x-show="showPrioritySelector" style="display: none;" class="pb-12">
                <h4 class="text-center font-bold mb-6 border-b border-[#3E3E3E] pb-2 text-white">Prioritas Tugas</h4>
                <div class="grid grid-cols-4 gap-4 mb-8 text-center pt-2">
                    @for($i = 1; $i <= 10; $i++)
                        <div @click="priority = {{ $i }}" 
                             class="cursor-pointer py-3 rounded-lg flex flex-col items-center justify-center transition-colors shadow-sm"
                             :class="priority == {{ $i }} ? 'bg-[#8875FF] text-white' : 'bg-[#272727] text-gray-300 hover:bg-[#3E3E3E] hover:text-white'">
                             <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 opacity-80"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" x2="4" y1="22" y2="15"/></svg>
                            <span class="text-sm">{{ $i }}</span>
                        </div>
                    @endfor
                </div>
                <div class="flex justify-between gap-4">
                    <button type="button" @click="showPrioritySelector = false" class="w-full bg-transparent hover:bg-[#1D1D1D] text-[#8875FF] font-medium py-3 rounded transition-colors border border-[#8875FF]">Batal</button>
                    <button type="button" @click="showPrioritySelector = false" class="w-full bg-[#8875FF] hover:bg-[#6B5CE7] text-white font-medium py-3 rounded transition-colors shadow-lg">Simpan</button>
                </div>
            </div>
        </form>
    </x-modal>
</x-layouts.app>
