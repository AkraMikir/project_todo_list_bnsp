@props(['id', 'title' => null])

<div x-data="{ show: false }"
     x-show="show"
     x-on:open-modal.window="if ($event.detail === '{{ $id }}') show = true"
     x-on:close-modal.window="if ($event.detail === '{{ $id }}') show = false"
     x-on:keydown.escape.window="show = false"
     style="display: none;"
     class="fixed inset-0 z-50 flex items-end sm:items-center justify-center pb-0 sm:pb-0 h-full w-full mx-auto overflow-hidden text-white"
>
    <!-- Backdrop -->
    <div x-show="show"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="absolute inset-0 bg-black/60 backdrop-blur-sm"
         x-on:click="show = false"
    ></div>

    <!-- Modal Panel -->
    <div x-show="show"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-full"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-full"
         class="relative w-full sm:max-w-md bg-uptodo-surface2 rounded-t-3xl sm:rounded-2xl shadow-xl z-50 transform transition-all modal-slide max-h-[90vh] overflow-y-auto"
    >
        @if($title)
            <div class="px-6 py-4 flex justify-between items-center border-b border-uptodo-border">
                <h3 class="text-lg font-bold text-white">{{ $title }}</h3>
                <button type="button" x-on:click="show = false" class="text-gray-400 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
        @endif
        
        <div class="px-6 py-6 pb-12">
            {{ $slot }}
        </div>
    </div>
</div>
