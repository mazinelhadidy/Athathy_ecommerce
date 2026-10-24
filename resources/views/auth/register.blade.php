<x-app-layout>


     <!-- Main Content Start -->

    <div class="relative bg-sky-700 text-white h-64 flex items-center justify-center bg-cover bg-center" style="background-image: url({{ asset('assets/images/page-banner.jpg') }});">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative z-10 text-center">
        <h2 class="text-4xl font-bold mb-2">Register</h2>
        <ul class="flex justify-center space-x-2 text-sm">
            <li><a href="{{ route('home.index') }}" class="hover:text-primary">Home</a></li>
            <li>/</li>
            <li class="text-primary">Register</li>
        </ul>
    </div>
</div>

<section class="py-20">
    <div class="container mx-auto px-4">
        <div class="flex justify-center">
            <div class="w-full lg:w-1/2">
                <div class="bg-gray-50 border rounded-lg p-8 shadow-sm">
                    <h4 class="text-2xl font-bold text-center mb-2">Create New Account</h4>
                    <p class="text-center text-sm mb-8 text-gray-500">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-primary hover:underline">Log in instead!</a>
                    </p>
                    
                    <form method="POST" action="{{ route('register') }}" class="space-y-4" >
                       @csrf
                        <div>                     
                             <input type="text" id='name' name='name' placeholder="Name" class="w-full border p-3 rounded focus:outline-none focus:border-primary transition" :value="old('name')" required autofocus autocomplete="name" />                                                
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <input type="email" id='email' name='email' placeholder="Email Address " class="w-full border p-3 rounded focus:outline-none focus:border-primary transition" :value="old('email')" required autocomplete="username" />
                             @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <input type="text" id='mobile' name='mobile' placeholder="Mobile Number " class="w-full border p-3 rounded focus:outline-none focus:border-primary transition" :value="old('mobile')" required autocomplete="mobile" />
                            @error('mobile')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <input type="password" id='password' name='password' placeholder="Password" class="w-full border p-3 rounded focus:outline-none focus:border-primary transition" required autocomplete="new-password" />
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <input type="password" id='password_confirmation' name='password_confirmation' placeholder="Confirm Password" class="w-full border p-3 rounded focus:outline-none focus:border-primary transition" required autocomplete="new-password" />
                            
                        </div>
                        
                        <div class="pt-4">
                            <button type="submit" class="w-full bg-primary text-white font-medium py-3 rounded hover:bg-blue-600 transition shadow-lg">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Main Content End -->

    {{-- <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Mobile Number -->
        <div class="mt-4">
            <x-input-label for="mobile" :value="__('Mobile')" />
            <x-text-input id="mobile" class="block mt-1 w-full" type="text" name="mobile" :value="old('mobile')" required autocomplete="mobile" />
            <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form> --}}
</x-app-layout>
