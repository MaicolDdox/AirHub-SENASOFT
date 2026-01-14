<x-layouts.auth>
<div class="flex flex-col gap-8 max-w-3xl mx-auto">
    <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6" id="registerForm">
        @csrf

        {{-- Sección: Datos personales con card y título --}}
        <div class="rounded-2xl border border-zinc-200/60 dark:border-zinc-800/70 bg-white/80 dark:bg-zinc-900/60 shadow-sm backdrop-blur p-5">
            <h2 class="text-base font-semibold text-zinc-900 dark:text-zinc-100 mb-4">{{ __('Datos personales') }}</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Primer Nombre -->
                <div>
                    <flux:input
                        wire:model="first_name"
                        :label="__('Primer Nombre')"
                        type="text"
                        required
                        autofocus
                        autocomplete="given-name"
                        :placeholder="__('Primer nombre')"
                        :aria-invalid="$errors->has('first_name') ? 'true' : 'false'"
                    />
                    @error('first_name')
                        <p class="mt-1 text-sm text-rose-600 dark:text-rose-400" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Segundo Nombre -->
                <div>
                    <flux:input
                        wire:model="middle_name"
                        :label="__('Segundo Nombre')"
                        type="text"
                        autocomplete="additional-name"
                        :placeholder="__('Segundo nombre')"
                        :aria-invalid="$errors->has('middle_name') ? 'true' : 'false'"
                    />
                    @error('middle_name')
                        <p class="mt-1 text-sm text-rose-600 dark:text-rose-400" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Primer Apellido -->
                <div>
                    <flux:input
                        wire:model="first_surname"
                        :label="__('Primer Apellido')"
                        type="text"
                        required
                        autocomplete="family-name"
                        :placeholder="__('Primer apellido')"
                        :aria-invalid="$errors->has('first_surname') ? 'true' : 'false'"
                    />
                    @error('first_surname')
                        <p class="mt-1 text-sm text-rose-600 dark:text-rose-400" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Segundo Apellido -->
                <div>
                    <flux:input
                        wire:model="middle_surname"
                        :label="__('Segundo Apellido')"
                        type="text"
                        autocomplete="family-name"
                        :placeholder="__('Segundo apellido')"
                        :aria-invalid="$errors->has('middle_surname') ? 'true' : 'false'"
                    />
                    @error('middle_surname')
                        <p class="mt-1 text-sm text-rose-600 dark:text-rose-400" role="alert">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Sección: Contacto con card y título --}}
        <div class="rounded-2xl border border-zinc-200/60 dark:border-zinc-800/70 bg-white/80 dark:bg-zinc-900/60 shadow-sm backdrop-blur p-5">
            <h2 class="text-base font-semibold text-zinc-900 dark:text-zinc-100 mb-4">{{ __('Contacto') }}</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Correo electrónico -->
                <div>
                    <flux:input
                        wire:model="email"
                        :label="__('Correo Electrónico')"
                        type="email"
                        required
                        autocomplete="email"
                        placeholder="email@example.com"
                        :aria-invalid="$errors->has('email') ? 'true' : 'false'"
                    />
                    @error('email')
                        <p class="mt-1 text-sm text-rose-600 dark:text-rose-400" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Número de celular cambiado a type="tel" inputmode="numeric" -->
                <div>
                    <flux:input
                        wire:model="number_phone"
                        :label="__('Número de Celular')"
                        type="tel"
                        inputmode="numeric"
                        required
                        autocomplete="tel"
                        :placeholder="__('Número de celular')"
                        :aria-invalid="$errors->has('number_phone') ? 'true' : 'false'"
                    />
                    @error('number_phone')
                        <p class="mt-1 text-sm text-rose-600 dark:text-rose-400" role="alert">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Sección: Documento con card y título --}}
        <div class="rounded-2xl border border-zinc-200/60 dark:border-zinc-800/70 bg-white/80 dark:bg-zinc-900/60 shadow-sm backdrop-blur p-5">
            <h2 class="text-base font-semibold text-zinc-900 dark:text-zinc-100 mb-4">{{ __('Documento') }}</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tipo de documento -->
                <div>
                    <flux:label>{{ __('Tipo de Documento') }}</flux:label>
                    <flux:select wire:model="type_document" placeholder="Seleccione..." :aria-invalid="$errors->has('type_document') ? 'true' : 'false'">
                        <flux:select.option value="cedula_ciudadana">Cédula Ciudadana</flux:select.option>
                        <flux:select.option value="registro_civil">Registro Civil</flux:select.option>
                        <flux:select.option value="pasaporte">Pasaporte</flux:select.option>
                        <flux:select.option value="cedula_extrangera">Cédula Extranjera</flux:select.option>
                    </flux:select>
                    @error('type_document')
                        <p class="mt-1 text-sm text-rose-600 dark:text-rose-400" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Número de documento cambiado a type="text" inputmode="numeric" pattern="[0-9]*" -->
                <div>
                    <flux:input
                        wire:model="number_document"
                        :label="__('Número de Documento')"
                        type="text"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        required
                        :placeholder="__('Número de documento')"
                        :aria-invalid="$errors->has('number_document') ? 'true' : 'false'"
                    />
                    @error('number_document')
                        <p class="mt-1 text-sm text-rose-600 dark:text-rose-400" role="alert">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Sección: Seguridad con card, título y texto de ayuda --}}
        <div class="rounded-2xl border border-zinc-200/60 dark:border-zinc-800/70 bg-white/80 dark:bg-zinc-900/60 shadow-sm backdrop-blur p-5">
            <h2 class="text-base font-semibold text-zinc-900 dark:text-zinc-100 mb-4">{{ __('Seguridad') }}</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Contraseña -->
                <div>
                    <flux:input
                        wire:model="password"
                        :label="__('Contraseña')"
                        type="password"
                        required
                        autocomplete="new-password"
                        :placeholder="__('Contraseña')"
                        viewable
                        :aria-invalid="$errors->has('password') ? 'true' : 'false'"
                    />
                    <p class="mt-1 text-xs text-zinc-600 dark:text-zinc-400">{{ __('Mínimo 8 caracteres, incluye mayúsculas, minúsculas y números') }}</p>
                    @error('password')
                        <p class="mt-1 text-sm text-rose-600 dark:text-rose-400" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirmar contraseña -->
                <div>
                    <flux:input
                        wire:model="password_confirmation"
                        :label="__('Confirmar Contraseña')"
                        type="password"
                        required
                        autocomplete="new-password"
                        :placeholder="__('Confirmar contraseña')"
                        viewable
                        :aria-invalid="$errors->has('password_confirmation') ? 'true' : 'false'"
                    />
                    @error('password_confirmation')
                        <p class="mt-1 text-sm text-rose-600 dark:text-rose-400" role="alert">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Botón con estado de carga --}}
        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full md:w-auto bg-sky-600 hover:bg-sky-700 disabled:opacity-60 disabled:cursor-not-allowed" id="submitBtn">
                <span id="btnText">{{ __('Crear cuenta') }}</span>
                <svg id="btnSpinner" class="hidden animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </flux:button>
        </div>
    </form>

    <div class="text-center text-sm text-zinc-600 dark:text-zinc-400 space-x-1 rtl:space-x-reverse">
        <span>{{ __('¿Ya tienes una cuenta?') }}</span>
        <flux:link :href="route('login')" wire:navigate>{{ __('Iniciar sesión') }}</flux:link>
    </div>
</div>

{{-- JavaScript inline para estado de carga del botón --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnSpinner = document.getElementById('btnSpinner');

    form.addEventListener('submit', function() {
        // Deshabilitar botón
        submitBtn.disabled = true;
        
        // Mostrar spinner y cambiar texto
        btnSpinner.classList.remove('hidden');
        btnText.textContent = '{{ __("Creando cuenta...") }}';
        
        // Prevenir doble submit
        form.style.pointerEvents = 'none';
    });
});
</script>
</x-layouts.auth>
