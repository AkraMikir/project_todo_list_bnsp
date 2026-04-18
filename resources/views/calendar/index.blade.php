<x-layouts.app>
    <x-header title="Kalender" />

    <div class="px-6 py-4 pb-24 text-white">
        <!-- Date Selector Strip / Month -->
        <div class="bg-uptodo-surface2 rounded-xl p-4 mb-6 sticky top-20 shadow-md z-10 relative">
            <!-- Currently mocked calendar strip for demo -->
            <div class="flex justify-between items-center mb-4 md:mb-6">
                <a href="{{ route('calendar.index', ['date' => \Carbon\Carbon::parse($date)->subWeek()->format('Y-m-d')]) }}" class="hover:text-white transition transform hover:scale-110 p-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="md:w-8 md:h-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg></a>
                <div class="flex flex-col items-center">
                    <span class="text-sm md:text-lg font-semibold tracking-widest text-uptodo-muted uppercase">{{ \Carbon\Carbon::parse($date)->format('F') }}</span>
                    <span class="text-xs md:text-sm text-uptodo-muted">{{ \Carbon\Carbon::parse($date)->format('Y') }}</span>
                </div>
                <a href="{{ route('calendar.index', ['date' => \Carbon\Carbon::parse($date)->addWeek()->format('Y-m-d')]) }}" class="hover:text-white transition transform hover:scale-110 p-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="md:w-8 md:h-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg></a>
            </div>
            
            <div class="flex justify-between mt-2">
                @php
                    $startOfWeek = \Carbon\Carbon::parse($date)->startOfWeek(\Carbon\Carbon::SUNDAY);
                @endphp
                @for ($i = 0; $i < 7; $i++)
                    @php
                        $day = $startOfWeek->copy()->addDays($i);
                        $isSelected = $day->format('Y-m-d') === $date;
                    @endphp
                    <a href="{{ route('calendar.index', ['date' => $day->format('Y-m-d')]) }}" class="flex flex-col items-center p-2 lg:px-4 lg:py-3 rounded md:rounded-lg transition-colors {{ $isSelected ? 'bg-uptodo-purple text-white hover:bg-uptodo-purple-dark shadow-md' : 'text-uptodo-muted hover:bg-[#4a4a4a] hover:text-white' }}">
                        <span class="text-[10px] md:text-sm font-bold uppercase {{ $day->isWeekend() ? 'text-red-400' : '' }}">{{ $day->format('D') }}</span>
                        <span class="text-sm md:text-xl md:mt-2 mt-1 font-medium">{{ $day->format('d') }}</span>
                    </a>
                @endfor
            </div>
        </div>

        <!-- Task List Header -->
        <div class="mb-4 md:mb-8">
            <h2 class="text-lg md:text-3xl font-semibold">{{ \Carbon\Carbon::parse($date)->isToday() ? 'Hari Ini' : \Carbon\Carbon::parse($date)->format('l, d M') }}</h2>
        </div>

        <!-- Task List -->
        <div class="space-y-4">
            @forelse($tasks as $task)
                <div class="bg-uptodo-surface2 p-4 md:p-6 rounded-lg md:rounded-xl flex items-start justify-between task-card hover:bg-[#4a4a4a] transition-all transform hover:-translate-y-1 hover:shadow-lg border border-transparent hover:border-uptodo-purple/30">
                    <div class="flex items-center gap-3 md:gap-5 w-full">
                        <form method="POST" action="{{ route('tasks.toggle', $task) }}" class="m-0 p-0 flex items-center pt-1 md:pt-0">
                            @csrf
                            <input type="checkbox" class="task-check w-6 h-6 md:w-8 md:h-8 cursor-pointer" onChange="this.form.submit()" {{ $task->is_completed ? 'checked' : '' }}>
                        </form>
                        <div class="flex-1 cursor-pointer" onclick="window.location='{{ route('tasks.show', $task) }}'">
                            <h3 class="{{ $task->is_completed ? 'line-through text-gray-400' : 'text-white' }} text-base md:text-xl font-medium">{{ $task->title }}</h3>
                            <div class="flex items-center justify-between mt-2 md:mt-3 flex-wrap gap-2">
                                <p class="text-xs md:text-sm text-uptodo-muted">
                                    @if($task->due_datetime)
                                        Pukul {{ $task->due_datetime->format('H:i') }}
                                    @endif
                                </p>
                                <div class="flex items-center gap-2">
                                    @if($task->category)
                                        <div class="px-2 py-1 md:px-3 md:py-1.5 flex items-center gap-1 rounded md:rounded-md text-xs md:text-sm text-white" style="background-color: {{ $task->category->color }}">
                                            <span><x-icon name="{{ $task->category->icon }}" class="w-4 h-4 md:w-5 md:h-5 text-current inline-block" /></span>
                                            <span>{{ $task->category->name }}</span>
                                        </div>
                                    @endif
                                    @if($task->priority)
                                        <div class="flex items-center justify-center border rounded md:rounded-md px-2 py-1 md:px-3 md:py-1.5 text-xs md:text-sm gap-1 priority-flag {{ $task->priority == 1 ? 'border-red-500 text-red-500 bg-red-400/10' : ($task->priority == 2 ? 'border-yellow-500 text-yellow-500 bg-yellow-400/10' : 'border-green-500 text-green-500 bg-green-400/10') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="md:w-5 md:h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" x2="4" y1="22" y2="15"/></svg>
                                            {{ $task->priority == 1 ? 'Tinggi' : ($task->priority == 2 ? 'Sedang' : 'Rendah') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            @if($task->subTasks->count() > 0)
                                <div class="mt-3 space-y-2 border-l-2 border-uptodo-purple/50 pl-3 py-1 cursor-default" onclick="event.stopPropagation();">
                                    @foreach($task->subTasks as $subTask)
                                        <div class="flex items-center gap-2 hover:bg-[#4a4a4a] rounded px-2 py-1 -ml-2 transition-colors">
                                            <form method="POST" action="{{ route('sub_tasks.toggle', $subTask) }}" class="m-0 p-0 flex items-center">
                                                @csrf
                                                <input type="checkbox" class="task-check w-4 h-4 md:w-5 md:h-5 cursor-pointer" onChange="this.form.submit()" {{ $subTask->is_completed ? 'checked' : '' }}>
                                            </form>
                                            <span class="text-xs md:text-sm {{ $subTask->is_completed ? 'line-through text-uptodo-muted' : 'text-gray-300' }}">{{ $subTask->title }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center text-center mt-12 md:mt-24 opacity-80">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#AFAFAF" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="mb-4 md:w-24 md:h-24 md:mb-6"><path d="M8 6h13"/><path d="M8 12h13"/><path d="M8 18h13"/><path d="M3 6h.01"/><path d="M3 12h.01"/><path d="M3 18h.01"/></svg>
                    <p class="text-uptodo-muted md:text-lg">Tidak ada tugas untuk tanggal ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.app>
