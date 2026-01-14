@extends('app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-50 to-slate-100 py-10 px-4">
    <div class="w-full max-w-2xl">
        <h2 class="text-3xl font-bold text-slate-800 mb-8 text-center">Formulario de Pago</h2>

        {{-- CARD GLASS: Vista previa de tarjeta con efecto glassmorphism --}}
        <div id="cardPreview" class="relative mb-8 p-8 rounded-2xl backdrop-blur-md bg-gradient-to-br from-white/30 to-white/10 border border-white/30 shadow-xl overflow-hidden">
            {{-- Decorative waves/circles --}}
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-400/20 to-purple-400/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-40 h-40 bg-gradient-to-tr from-cyan-400/20 to-blue-400/20 rounded-full blur-3xl"></div>

            <div class="relative z-10">
                {{-- Card chip icon --}}
                <div class="mb-6">
                    <svg class="w-12 h-10 text-amber-400/80" fill="currentColor" viewBox="0 0 48 40">
                        <rect x="4" y="4" width="40" height="32" rx="4" fill="currentColor" opacity="0.3"/>
                        <rect x="8" y="8" width="12" height="10" rx="2" fill="currentColor"/>
                        <rect x="8" y="22" width="12" height="10" rx="2" fill="currentColor"/>
                        <rect x="24" y="8" width="12" height="10" rx="2" fill="currentColor"/>
                        <rect x="24" y="22" width="12" height="10" rx="2" fill="currentColor"/>
                    </svg>
                </div>

                {{-- Card number --}}
                <div class="mb-6">
                    <p id="previewNumber" class="text-2xl font-mono tracking-wider text-slate-700 font-semibold">
                        •••• •••• •••• ••••
                    </p>
                </div>

                {{-- Card holder and expiration --}}
                <div class="flex justify-between items-end">
                    <div>
                        <p class="text-xs text-slate-500 mb-1">TITULAR</p>
                        <p id="previewHolder" class="text-sm font-semibold text-slate-700 uppercase">
                            NOMBRE DEL TITULAR
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-slate-500 mb-1">EXPIRA</p>
                        <p id="previewExpiry" class="text-sm font-semibold text-slate-700 font-mono">
                            MM/YY
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- FORM: Formulario de pago --}}
        <div class="bg-white p-8 rounded-xl shadow-lg">
            <form id="paymentForm" action="{{ route('pays.store') }}" method="POST" class="space-y-6">
                @csrf

                <input type="hidden" name="flight_id" value="{{ $flight->id }}">
                <input type="hidden" name="userPassenger" value="{{ $flight->userPassenger }}">

                {{-- Método de pago --}}
                <div>
                    <label for="metodoPago" class="block text-slate-700 font-medium mb-2">Método de Pago</label>
                    <flux:select id="metodoPago" name="metodoPago" class="w-full border-slate-500 rounded-md p-2" required>
                        <flux:select.option value="">Seleccione un método</flux:select.option>
                        <flux:select.option value="tarjeta credito">Tarjeta de Crédito</flux:select.option>
                        <flux:select.option value="tarjeta debito">Tarjeta de Débito</flux:select.option>
                        <flux:select.option value="paypal">PayPal</flux:select.option>
                    </flux:select>
                </div>

                {{-- PayPal message --}}
                <div id="paypalMessage" class="hidden p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <p class="text-blue-700 text-sm">
                        <svg class="inline w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        Pago simulado por PayPal. Serás redirigido al completar el formulario.
                    </p>
                </div>

                {{-- Card fields container --}}
                <div id="cardFields" class="space-y-6">
                    {{-- Titular de la tarjeta --}}
                    <div>
                        <label for="card_holder" class="block text-slate-700 font-medium mb-2">
                            Nombre del titular
                            <span class="text-red-500" aria-label="requerido">*</span>
                        </label>
                        <flux:input
                            id="card_holder"
                            name="card_holder"
                            type="text"
                            class="w-full border-slate-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Juan Pérez"
                            required
                            aria-required="true"
                        />
                    </div>

                    {{-- Número de tarjeta --}}
                    <div>
                        <label for="card_number" class="block text-slate-700 font-medium mb-2">
                            Número de tarjeta
                            <span class="text-red-500" aria-label="requerido">*</span>
                        </label>
                        <flux:input
                            id="card_number"
                            name="card_number"
                            type="text"
                            class="w-full border-slate-300 rounded-md p-2 font-mono focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="1234 5678 9012 3456"
                            maxlength="19"
                            required
                            aria-required="true"
                            inputmode="numeric"
                        />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        {{-- Fecha de expiración --}}
                        <div>
                            <label for="expiration" class="block text-slate-700 font-medium mb-2">
                                Expiración (MM/YY)
                                <span class="text-red-500" aria-label="requerido">*</span>
                            </label>
                            <flux:input
                                id="expiration"
                                name="expiration"
                                type="text"
                                class="w-full border-slate-300 rounded-md p-2 font-mono focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="MM/YY"
                                maxlength="5"
                                required
                                aria-required="true"
                                inputmode="numeric"
                            />
                        </div>

                        {{-- CVV --}}
                        <div>
                            <label for="cvv" class="block text-slate-700 font-medium mb-2">
                                CVV
                                <span class="text-red-500" aria-label="requerido">*</span>
                            </label>
                            <flux:input
                                id="cvv"
                                name="cvv"
                                type="text"
                                class="w-full border-slate-300 rounded-md p-2 font-mono focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                maxlength="4"
                                placeholder="123"
                                required
                                aria-required="true"
                                inputmode="numeric"
                            />
                        </div>
                    </div>
                </div>

                {{-- Checkbox de términos --}}
                <div class="flex items-start">
                    <input
                        id="accept_terms"
                        name="accept_terms"
                        type="checkbox"
                        class="mt-1 mr-3 w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-2 focus:ring-blue-500"
                        required
                        aria-required="true"
                    >
                    <label for="accept_terms" class="text-slate-700 text-sm">
                        Acepto los <a href="#" class="text-blue-600 underline hover:text-blue-700">Términos y Condiciones</a> y el
                        <a href="#" class="text-blue-600 underline hover:text-blue-700">tratamiento de datos personales</a>.
                        <span class="text-red-500" aria-label="requerido">*</span>
                    </label>
                </div>

                {{-- Botón de envío --}}
                <button
                    id="submitBtn"
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 focus:ring-4 focus:ring-blue-300 focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center"
                    aria-label="Procesar pago"
                >
                    <span id="btnText">Pagar ahora</span>
                    <svg id="btnSpinner" class="hidden animate-spin ml-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
(function() {
    'use strict';

    // ELEMENTS
    const metodoPagoSelect = document.getElementById('metodoPago');
    const cardFields = document.getElementById('cardFields');
    const paypalMessage = document.getElementById('paypalMessage');
    const cardPreview = document.getElementById('cardPreview');

    const cardHolderInput = document.getElementById('card_holder');
    const cardNumberInput = document.getElementById('card_number');
    const expirationInput = document.getElementById('expiration');

    const previewHolder = document.getElementById('previewHolder');
    const previewNumber = document.getElementById('previewNumber');
    const previewExpiry = document.getElementById('previewExpiry');

    const paymentForm = document.getElementById('paymentForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnSpinner = document.getElementById('btnSpinner');

    // TOGGLE PAYPAL: Show/hide card fields based on payment method
    metodoPagoSelect.addEventListener('change', function() {
        const isPaypal = this.value === 'paypal';

        if (isPaypal) {
            cardFields.classList.add('hidden');
            paypalMessage.classList.remove('hidden');
            cardPreview.classList.add('opacity-50', 'pointer-events-none');

            // Disable card field requirements
            cardHolderInput.removeAttribute('required');
            cardNumberInput.removeAttribute('required');
            expirationInput.removeAttribute('required');
            document.getElementById('cvv').removeAttribute('required');
        } else {
            cardFields.classList.remove('hidden');
            paypalMessage.classList.add('hidden');
            cardPreview.classList.remove('opacity-50', 'pointer-events-none');

            // Re-enable card field requirements
            cardHolderInput.setAttribute('required', 'required');
            cardNumberInput.setAttribute('required', 'required');
            expirationInput.setAttribute('required', 'required');
            document.getElementById('cvv').setAttribute('required', 'required');
        }
    });

    // MASK: Card number formatting (groups of 4)
    cardNumberInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\s/g, '').replace(/\D/g, '');
        let formatted = value.match(/.{1,4}/g)?.join(' ') || '';
        e.target.value = formatted;

        // Update preview
        previewNumber.textContent = formatted || '•••• •••• •••• ••••';
    });

    // MASK: Expiration formatting (MM/YY)
    expirationInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length >= 2) {
            value = value.slice(0, 2) + '/' + value.slice(2, 4);
        }
        e.target.value = value;

        // Update preview
        previewExpiry.textContent = value || 'MM/YY';
    });

    // LIVE PREVIEW: Update card holder
    cardHolderInput.addEventListener('input', function(e) {
        const value = e.target.value.trim().toUpperCase();
        previewHolder.textContent = value || 'NOMBRE DEL TITULAR';
    });

    // CVV: Only numbers
    document.getElementById('cvv').addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/\D/g, '');
    });

    // SUBMIT STATE: Handle form submission with loading state
    paymentForm.addEventListener('submit', function(e) {
        e.preventDefault();

        // Disable button and show spinner
        submitBtn.disabled = true;
        btnText.textContent = 'Procesando...';
        btnSpinner.classList.remove('hidden');

        // Simulate processing delay (1.5s) then submit
        setTimeout(function() {
            paymentForm.submit();
        }, 1500);
    });

    // Basic Luhn validation (optional)
    function luhnCheck(cardNumber) {
        const digits = cardNumber.replace(/\s/g, '').split('').reverse();
        let sum = 0;

        for (let i = 0; i < digits.length; i++) {
            let digit = parseInt(digits[i]);

            if (i % 2 === 1) {
                digit *= 2;
                if (digit > 9) digit -= 9;
            }

            sum += digit;
        }

        return sum % 10 === 0;
    }

    // Optional: Add Luhn validation on blur
    cardNumberInput.addEventListener('blur', function() {
        const cardNum = this.value.replace(/\s/g, '');
        if (cardNum.length >= 13 && !luhnCheck(cardNum)) {
            this.setAttribute('aria-invalid', 'true');
            this.classList.add('border-red-500');
        } else {
            this.removeAttribute('aria-invalid');
            this.classList.remove('border-red-500');
        }
    });

    // Expiration validation: Check if date is in the future
    expirationInput.addEventListener('blur', function() {
        const value = this.value;
        if (value.length === 5) {
            const [month, year] = value.split('/').map(v => parseInt(v));
            const currentDate = new Date();
            const currentYear = currentDate.getFullYear() % 100;
            const currentMonth = currentDate.getMonth() + 1;

            if (year < currentYear || (year === currentYear && month < currentMonth)) {
                this.setAttribute('aria-invalid', 'true');
                this.classList.add('border-red-500');
            } else if (month < 1 || month > 12) {
                this.setAttribute('aria-invalid', 'true');
                this.classList.add('border-red-500');
            } else {
                this.removeAttribute('aria-invalid');
                this.classList.remove('border-red-500');
            }
        }
    });
})();
</script>
@endsection
