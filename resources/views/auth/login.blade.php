<x-app-layout>

     <!-- Main Content Start -->

    <div class="relative bg-sky-700 text-white h-64 flex items-center justify-center bg-cover bg-center" style="background-image: url({{asset('assets/images/page-banner.jpg')}});">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative z-10 text-center">
        <h2 class="text-4xl font-bold mb-2">Login</h2>
        <ul class="flex justify-center space-x-2 text-sm">
            <li><a href="{{ route('home.index') }}" class="hover:text-primary">Home</a></li>
            <li>/</li>
            <li class="text-primary">Login</li>
        </ul>
    </div>
</div>

<section class="py-20">
    <div class="container mx-auto px-4">
        <div class="flex justify-center">
            <div class="w-full lg:w-1/2">
                <div class="bg-gray-50 border rounded-lg p-8 shadow-sm">
                    <h4 class="text-2xl font-bold text-center mb-6">Login to Your Account</h4>
                    
                    <form method="POST" action="{{ route('login') }} " class="space-y-4" >
                       @csrf
                        <div>
                            <input id="email" name="email" type="email" placeholder="email " class="w-full border p-3 rounded focus:outline-none focus:border-primary transition" :value="old('email')" required autofocus autocomplete="username" />
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <input id="password" name="password" type="password" placeholder="Password" class="w-full border p-3 rounded focus:outline-none focus:border-primary transition" required autocomplete="current-password" />
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" id="remember_me" name="remember" class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary cursor-pointer" />
                            <label for="remember_me" class="ml-2 text-sm text-gray-600 cursor-pointer">Remember me</label>
                        </div>
                        
                        <div>
                            <button type ="submit" class="w-full bg-primary text-white font-medium py-3 rounded hover:bg-blue-600 transition shadow-lg">
                                Login
                            </button>
                        </div>
                    </form>
                    
                    <div class="mt-6 text-center text-sm space-y-2">
                        <p><a href="{{ route('password.request') }}" class="text-gray-500 hover:text-primary transition">Lost your password?</a></p>
                        <p class="text-gray-600">
                            No account? 
                            <a href="{{ route('register') }}" class="text-primary font-bold hover:underline">Create one here.</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Main Content End -->
{{-- 
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>  --}}

</x-app-layout>
