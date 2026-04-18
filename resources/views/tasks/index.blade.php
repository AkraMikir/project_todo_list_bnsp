<x-layouts.app>
    <x-header title="Beranda">
        <x-slot name="left">
            <!-- Filter or menu icon -->
            <button class="text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="21" x2="14" y1="4" y2="4"/><line x1="10" x2="3" y1="4" y2="4"/><line x1="21" x2="12" y1="12" y2="12"/><line x1="8" x2="3" y1="12" y2="12"/><line x1="21" x2="16" y1="20" y2="20"/><line x1="12" x2="3" y1="20" y2="20"/><line x1="14" x2="14" y1="2" y2="6"/><line x1="8" x2="8" y1="10" y2="14"/><line x1="16" x2="16" y1="18" y2="22"/></svg>
            </button>
        </x-slot>
    </x-header>

    <div class="px-6 mt-4">
        @if($tasks->isEmpty())
            <!-- Empty State -->
            <div class="flex flex-col items-center justify-center h-[50vh] text-center">
                <!-- Checklist Illustration placeholder from Figma (Clipboard image) -->
                <svg width="227" height="227" viewBox="0 0 227 227" fill="none" xmlns="http://www.w3.org/2000/svg" class="mb-4 md:w-80 md:h-80 transition-transform hover:scale-105 cursor-pointer">
                    <path d="M141.875 56.75H85.125V37.8333C85.125 32.612 89.3453 28.375 94.5833 28.375C99.8213 28.375 104.041 32.612 104.041 37.8333H122.958C122.958 32.612 127.178 28.375 132.416 28.375C137.654 28.375 141.875 32.612 141.875 37.8333V56.75ZM151.333 47.2917V37.8333C151.333 27.3888 142.862 18.9167 132.416 18.9167C125.795 18.9167 119.957 22.28 116.593 27.3197C114.73 24.3168 111.458 22.2514 107.697 21.0505C104.629 20.0631 101.378 19.3879 98.0583 19.0628C96.9157 18.9507 95.757 18.8954 94.5833 18.8954C84.1388 18.8954 75.6666 27.3675 75.6666 37.812V47.2704H47.2916C42.0621 47.2704 37.8333 51.4992 37.8333 56.7287V179.687C37.8333 184.917 42.0621 189.145 47.2916 189.145H179.708C184.938 189.145 189.166 184.917 189.166 179.687V56.7287C189.166 51.4992 184.938 47.2704 179.708 47.2704H151.333ZM170.25 170.229H56.75V66.2084H170.25V170.229Z" fill="#AFAFAF"/>
                    <path d="M75.6667 94.5834H113.5V104.042H75.6667V94.5834ZM75.6667 122.958H151.333V132.417H75.6667V122.958ZM75.6667 151.333H132.417V160.792H75.6667V151.333Z" fill="#AFAFAF"/>
                </svg>
                <h2 class="text-xl md:text-3xl font-medium mb-3 text-white">Apa yang ingin Anda lakukan hari ini?</h2>
                <p class="text-base md:text-xl text-[#AFAFAF]">Ketuk + untuk menambahkan tugas</p>
            </div>
        @else
            <!-- Search Bar -->
            <form action="{{ route('tasks.index') }}" method="GET" class="mb-6 relative">
                <div class="absolute inset-y-0 left-0 pl-3 md:pl-5 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 md:h-7 md:w-7 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}"
                       class="block w-full pl-10 md:pl-16 pr-3 py-2 md:py-4 md:text-lg border border-[#979797] rounded-md md:rounded-lg leading-5 bg-[#1D1D1D] text-gray-300 placeholder-gray-500 focus:outline-none focus:bg-[#272727] focus:ring-2 focus:ring-[#8875FF] focus:border-[#8875FF] transition-all duration-150 ease-in-out"
                       placeholder="Cari tugas Anda...">
            </form>

            @if(request('search'))
                <div class="mb-4 text-sm flex justify-between items-center text-gray-400">
                    <span>Hasil pencarian untuk "{{ request('search') }}"</span>
                    <a href="{{ route('tasks.index') }}" class="text-[#8875FF] hover:underline">Hapus</a>
                </div>
            @endif

            <!-- Today's Tasks Dropdown -->
            <div x-data="{ expandedToday: true }" class="mb-6">
                <button @click="expandedToday = !expandedToday" class="flex items-center gap-2 px-3 py-1 md:px-5 md:py-2 md:text-base bg-[#272727] rounded md:rounded-lg text-sm text-gray-300 mb-4 transition-colors hover:bg-[#363636] hover:text-white">
                    Hari Ini 
                    <svg x-show="expandedToday" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                    <svg x-show="!expandedToday" style="display: none;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                </button>

                <div x-show="expandedToday" x-transition.opacity class="space-y-4">
                    @forelse($todayTasks->where('is_completed', false) as $task)
                        <div class="bg-[#363636] p-4 md:p-6 rounded-lg md:rounded-xl flex items-start justify-between task-card hover:bg-[#4a4a4a] transition-all transform hover:-translate-y-1 hover:shadow-lg border border-transparent hover:border-[#8875FF]/30">
                            <div class="flex items-center gap-3 md:gap-5 w-full">
                                <form method="POST" action="{{ route('tasks.toggle', $task) }}" class="m-0 p-0 flex items-center">
                                    <input type="checkbox" class="task-check w-6 h-6 md:w-8 md:h-8 cursor-pointer" onChange="this.form.submit()" {{ $task->is_completed ? 'checked' : '' }}>
                                </form>
                                <div class="flex-1 cursor-pointer" onclick="window.location='{{ route('tasks.show', $task) }}'">
                                    <h3 class="text-white text-base md:text-xl {{ $task->is_completed ? 'line-through text-gray-400' : '' }} font-medium">{{ $task->title }}</h3>
                                    <div class="flex items-center justify-between mt-2 flex-wrap gap-2 md:mt-3">
                                        <p class="text-xs md:text-sm text-[#AFAFAF]">
                                            @if($task->due_datetime)
                                                Hari ini Pukul {{ $task->due_datetime->format('H:i') }}
                                            @endif
                                        </p>
                                        <div class="flex items-center gap-2">
                                            @if($task->category)
                                                <div class="px-2 py-1 md:px-3 md:py-1.5 flex items-center gap-1 rounded md:rounded-md text-xs md:text-sm text-white" style="background-color: {{ $task->category->color }}">
                                                    <span>{{ $task->category->icon }}</span>
                                                    <span>{{ $task->category->name }}</span>
                                                </div>
                                            @endif
                                            @if($task->priority)
                                                <div class="flex items-center justify-center border border-[#8875FF] text-[#8875FF] rounded md:rounded-md px-2 py-1 md:px-3 md:py-1.5 text-xs md:text-sm gap-1 priority-flag">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" md:width="20" md:height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" x2="4" y1="22" y2="15"/></svg>
                                                    {{ $task->priority }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    @if($task->subTasks->count() > 0)
                                        <div class="mt-3 space-y-2 border-l-2 border-[#8875FF]/50 pl-3 py-1 cursor-default" onclick="event.stopPropagation();">
                                            @foreach($task->subTasks as $subTask)
                                                <div class="flex items-center gap-2 hover:bg-[#4a4a4a] rounded px-2 py-1 -ml-2 transition-colors">
                                                    <form method="POST" action="{{ route('sub_tasks.toggle', $subTask) }}" class="m-0 p-0 flex items-center">
                                                        <input type="checkbox" class="task-check w-4 h-4 md:w-5 md:h-5 cursor-pointer" onChange="this.form.submit()" {{ $subTask->is_completed ? 'checked' : '' }}>
                                                    </form>
                                                    <span class="text-xs md:text-sm {{ $subTask->is_completed ? 'line-through text-[#AFAFAF]' : 'text-gray-300' }}">{{ $subTask->title }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm italic py-2">Tidak ada tugas hari ini.</p>
                    @endforelse
                </div>
            </div>

            <!-- Completed Tasks Dropdown -->
            <div x-data="{ expandedCompleted: true }" class="mb-6">
                <button @click="expandedCompleted = !expandedCompleted" class="flex items-center gap-2 px-3 py-1 md:px-5 md:py-2 md:text-base bg-[#272727] rounded md:rounded-lg text-sm text-gray-300 mb-4 transition-colors hover:bg-[#363636] hover:text-white">
                    Selesai
                    <svg x-show="expandedCompleted" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                    <svg x-show="!expandedCompleted" style="display: none;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                </button>

                <div x-show="expandedCompleted" x-transition.opacity class="space-y-4 opacity-75">
                    @forelse($completedTasks as $task)
                        <div class="bg-[#363636] p-4 md:p-6 rounded-lg md:rounded-xl flex items-start justify-between task-card hover:bg-[#4a4a4a] transition-all transform hover:-translate-y-1 hover:shadow-lg border border-transparent hover:border-[#8875FF]/30">
                            <div class="flex items-center gap-3 md:gap-5 w-full">
                                <form method="POST" action="{{ route('tasks.toggle', $task) }}" class="m-0 p-0 flex items-center">
                                    @csrf
                                    <input type="checkbox" class="task-check w-6 h-6 md:w-8 md:h-8 cursor-pointer" onChange="this.form.submit()" checked>
                                </form>
                                <div class="flex-1 cursor-pointer" onclick="window.location='{{ route('tasks.show', $task) }}'">
                                    <h3 class="text-[#AFAFAF] text-base md:text-xl line-through font-medium">{{ $task->title }}</h3>
                                    <div class="flex items-center gap-2 mt-2 md:mt-3">
                                        <p class="text-xs md:text-sm text-[#AFAFAF]">
                                            @if($task->due_datetime)
                                                {{ $task->due_datetime->format('M d') }} Pukul {{ $task->due_datetime->format('H:i') }}
                                            @endif
                                        </p>
                                    </div>
                                    
                                    @if($task->subTasks->count() > 0)
                                        <div class="mt-3 space-y-2 border-l-2 border-gray-600 pl-3 py-1 cursor-default" onclick="event.stopPropagation();">
                                            @foreach($task->subTasks as $subTask)
                                                <div class="flex items-center gap-2 hover:bg-[#4a4a4a] rounded px-2 py-1 -ml-2 transition-colors">
                                                    <form method="POST" action="{{ route('sub_tasks.toggle', $subTask) }}" class="m-0 p-0 flex items-center">
                                                        @csrf
                                                        <input type="checkbox" class="task-check w-4 h-4 md:w-5 md:h-5 cursor-pointer" onChange="this.form.submit()" checked>
                                                    </form>
                                                    <span class="text-xs md:text-sm line-through text-[#AFAFAF]">{{ $subTask->title }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm italic py-2">Belum ada tugas yang selesai.</p>
                    @endforelse
                </div>
            </div>
        @endif
    </div>
    
    <!-- Include modals via a separate partial later -->
</x-layouts.app>
