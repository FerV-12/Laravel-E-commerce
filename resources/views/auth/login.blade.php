<x-guest-layout>
    <div class="flex items-center justify-center bg-gradient-to-br from-purple-400 via-pink-400 to-orange-300 animate-gradient-x" style="min-height: 60vh;">
        <!-- Login Card -->
        <div class="relative bg-white/90 backdrop-blur-lg rounded-3xl shadow-2xl w-full max-w-xs p-6 md:p-8">

            <!-- Decorative Background Shapes -->
            <div class="absolute -top-16 -left-16 w-32 h-32 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse"></div>
            <div class="absolute -bottom-16 -right-16 w-32 h-32 bg-yellow-300 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse"></div>

            <!-- Heading -->
            <h2 class="text-3xl font-bold text-center mb-2 animate-fadeInDown animate-welcome bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-orange-400">Welcome Back!</h2>
            <p class="text-center text-gray-700 mb-6 animate-fadeInDown animation-delay-100 text-sm">Log in to continue shopping</p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div class="relative">
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 text-sm font-semibold"/>
                    <x-text-input 
                        id="email" 
                        class="block mt-1 w-full rounded-xl border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50 pr-10 py-2 text-sm" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required autofocus 
                        autocomplete="username" 
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-500 text-xs" />
                </div>

                <!-- Password -->
                <div class="relative">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 text-sm font-semibold"/>
                    <x-text-input 
                        id="password" 
                        class="block mt-1 w-full rounded-xl border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50 pr-10 py-2 text-sm" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="current-password" 
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-500 text-xs" />
                </div>

                <!-- Remember + Forgot -->
                <div class="flex items-center justify-between text-sm text-gray-600 mt-2">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-pink-500 shadow-sm focus:ring-pink-400" name="remember">
                        <span class="ml-2">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-pink-500 hover:text-pink-700 underline transition duration-300" href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Login Button: center text -->
                <x-primary-button class="w-full bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 rounded-xl shadow-lg transition transform hover:-translate-y-0.5 hover:scale-105 text-sm flex items-center justify-center mt-4">
                    {{ __('Log in') }}
                </x-primary-button>
            </form>
        </div>
    </div>

    <style>
        @keyframes gradient-x {0% {background-position:0% 50%;} 50% {background-position:100% 50%;} 100% {background-position:0% 50%;}}
        .animate-gradient-x {background-size: 200% 200%; animation: gradient-x 8s ease infinite;}

        @keyframes fadeInDown {0% {opacity:0; transform:translateY(-20px);} 100% {opacity:1; transform:translateY(0);}}
        .animate-fadeInDown {animation: fadeInDown 1s ease forwards;}
        .animation-delay-100 {animation-delay: 0.1s;}

        /* Welcome heading subtle float + shimmer */
        @keyframes welcomeFloat {0% {transform: translateY(0);} 50% {transform: translateY(-6px);} 100% {transform: translateY(0);} }
        .animate-welcome {animation: fadeInDown 0.9s ease forwards, welcomeFloat 4s ease-in-out 0.9s infinite;}

    </style>
</x-guest-layout>
