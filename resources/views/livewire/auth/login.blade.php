<x-layouts.auth>
    {{-- LOGIN CONTAINER --}}
    <div class="flex flex-col gap-6 w-full max-w-md mx-auto">
        
        {{-- FORM HEADER --}}
        <x-auth-header 
            :title="__('Log in to your account')" 
            :description="__('Enter your email and password below to log in')" 
        />

        {{-- SESSION STATUS --}}
        <x-auth-session-status class="text-center" :status="session('status')" />

        {{-- LOGIN FORM --}}
        <form 
            method="POST" 
            action="{{ route('login.store') }}" 
            class="flex flex-col gap-6 p-8 rounded-2xl border border-zinc-200/60 dark:border-zinc-800/80 shadow-sm bg-white/80 dark:bg-zinc-900/60 backdrop-blur"
            id="loginForm"
        >
            @csrf

            {{-- FIELDS --}}
            <div class="space-y-5">
                {{-- Email Address --}}
                <div>
                    <flux:input
                        name="email"
                        :label="__('Email address')"
                        type="email"
                        required
                        autofocus
                        autocomplete="email"
                        placeholder="email@example.com"
                        class="focus:ring-2 focus:ring-sky-500/70 border-zinc-300 dark:border-zinc-700 text-zinc-800 dark:text-zinc-200"
                        :aria-invalid="$errors->has('email') ? 'true' : 'false'"
                    />
                    {{-- Added error display for email field --}}
                    @error('email')
                        <p class="text-rose-600 dark:text-rose-400 text-sm mt-1" role="alert" aria-live="polite">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <div class="relative">
                        <flux:input
                            name="password"
                            :label="__('Password')"
                            type="password"
                            required
                            autocomplete="current-password"
                            :placeholder="__('Password')"
                            viewable
                            class="focus:ring-2 focus:ring-sky-500/70 border-zinc-300 dark:border-zinc-700 text-zinc-800 dark:text-zinc-200"
                            :aria-invalid="$errors->has('password') ? 'true' : 'false'"
                        />

                        @if (Route::has('password.request'))
                            <flux:link 
                                class="absolute top-0 text-sm end-0 text-sky-600 hover:text-sky-700 dark:text-sky-400 dark:hover:text-sky-300" 
                                :href="route('password.request')" 
                                wire:navigate
                            >
                                {{ __('Forgot your password?') }}
                            </flux:link>
                        @endif
                    </div>
                    {{-- Added error display for password field --}}
                    @error('password')
                        <p class="text-rose-600 dark:text-rose-400 text-sm mt-1" role="alert" aria-live="polite">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            {{-- REMEMBER ME --}}
            {{-- Added remember me checkbox (UI only) --}}
            <div class="flex items-center gap-2">
                <input 
                    type="checkbox" 
                    name="remember" 
                    id="remember"
                    class="w-4 h-4 text-sky-600 border-zinc-300 dark:border-zinc-700 rounded focus:ring-2 focus:ring-sky-500/70 dark:bg-zinc-800"
                >
                <label for="remember" class="text-sm text-zinc-700 dark:text-zinc-300 cursor-pointer">
                    {{ __('Remember me') }}
                </label>
            </div>

            {{-- SUBMIT BUTTON --}}
            {{-- Added loading state with spinner and disabled state --}}
            <div class="flex items-center justify-end">
                <flux:button 
                    variant="primary" 
                    type="submit" 
                    class="w-full bg-sky-600 hover:bg-sky-700 disabled:opacity-60 disabled:cursor-not-allowed transition-colors" 
                    data-test="login-button"
                    id="loginButton"
                >
                    <span id="buttonText">{{ __('Log in') }}</span>
                    <svg id="buttonSpinner" class="hidden animate-spin ml-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </flux:button>
            </div>
        </form>

        {{-- LINKS --}}
        @if (Route::has('register'))
            <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400">
                <span>{{ __('Don\'t have an account?') }}</span>
                <flux:link 
                    :href="route('register')" 
                    wire:navigate
                    class="text-sky-600 hover:text-sky-700 dark:text-sky-400 dark:hover:text-sky-300 font-medium"
                >
                    {{ __('Sign up') }}
                </flux:link>
            </div>
        @endif
    </div>

    {{-- SUBMIT LOADING STATE --}}
    {{-- Added vanilla JS for submit loading state and double-submit prevention --}}
    <script>
        (function() {
            const form = document.getElementById('loginForm');
            const button = document.getElementById('loginButton');
            const buttonText = document.getElementById('buttonText');
            const buttonSpinner = document.getElementById('buttonSpinner');

            if (form && button) {
                form.addEventListener('submit', function(e) {
                    // Disable button and show loading state
                    button.disabled = true;
                    button.classList.add('pointer-events-none');
                    buttonText.textContent = '{{ __("Ingresando...") }}';
                    buttonSpinner.classList.remove('hidden');
                });
            }
        })();
    </script>
</x-layouts.auth>
