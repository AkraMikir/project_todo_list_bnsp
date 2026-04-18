<x-layouts.app>
    <x-slot name="title">Register</x-slot>
    <x-slot name="left">
        <a href="{{ route('login') }}" class="text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
    </x-slot>
    <x-slot name="right"><div></div></x-slot>

    <div class="px-6 mt-8">
        <h1 class="text-3xl font-bold mb-8 text-white">Register</h1>

        @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500 text-red-500 px-4 py-3 rounded-md mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-white mb-2">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                       class="w-full bg-uptodo-bg border border-[#979797] rounded flex px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-uptodo-purple transition-colors"
                       placeholder="Enter your name">
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-white mb-2">Username or Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                       class="w-full bg-uptodo-bg border border-[#979797] rounded flex px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-uptodo-purple transition-colors"
                       placeholder="Enter your email">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-white mb-2">Password</label>
                <input id="password" type="password" name="password" required
                       class="w-full bg-uptodo-bg border border-[#979797] rounded flex px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-uptodo-purple transition-colors"
                       placeholder="• • • • • • • • • • • •">
            </div>

            <!-- Password Confirmation -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-white mb-2">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                       class="w-full bg-uptodo-bg border border-[#979797] rounded flex px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-uptodo-purple transition-colors"
                       placeholder="• • • • • • • • • • • •">
            </div>

            <div class="pt-8">
                <button type="submit" class="w-full bg-uptodo-purple hover:bg-uptodo-purple-dark text-white font-medium py-3 rounded transition-colors focus:ring-4 focus:ring-uptodo-purple/30">
                    Register
                </button>
            </div>
        </form>

        <div class="mt-8 relative flex items-center justify-center">
            <span class="absolute px-2 bg-uptodo-bg text-[#979797] text-sm">or</span>
            <div class="w-full h-px bg-[#979797]"></div>
        </div>

        <div class="mt-8 flex justify-center gap-4">
            <a href="{{ route('login') }}" class="text-[#979797] hover:text-white transition-colors">
                Already have an account? <span class="text-white">Login</span>
            </a>
        </div>
    </div>
</x-layouts.app>
