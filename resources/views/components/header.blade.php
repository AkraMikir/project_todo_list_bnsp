@props(['title' => ''])

<header class="w-full px-6 py-6 flex items-center justify-between sticky top-0 z-10 bg-[#1D1D1D]/90 backdrop-blur-sm">
    <!-- Left Action (Optional Back Button or empty space to center title) -->
    <div class="w-8">
        @if(isset($left))
            {{ $left }}
        @else
            <!-- Placeholder for balance -->
        @endif
    </div>

    <!-- Center Title -->
    <h1 class="text-xl md:text-2xl lg:text-3xl font-semibold text-white tracking-wide">
        {{ $title }}
    </h1>

    <!-- Right Action (Avatar or Settings) -->
    <div class="w-12 flex justify-end">
        @if(isset($right))
            {{ $right }}
        @else
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=random" 
                 alt="User Avatar" class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 hover:scale-110 cursor-pointer hover:ring-2 hover:ring-[#8875FF] transition-all rounded-full border border-[#3E3E3E]">
        @endif
    </div>
</header>
