<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen antialiased bg-gradient-to-b from-sky-50 to-white dark:from-neutral-950 dark:to-neutral-900">
        {{-- Added subtle cloud background decorations --}}
        <div aria-hidden="true" class="pointer-events-none fixed inset-0 -z-10 overflow-hidden">
            {{-- Top left cloud --}}
            <div class="absolute -top-24 -left-16 h-72 w-72 rounded-full bg-sky-200/40 dark:bg-sky-400/10 blur-3xl"></div>
            
            {{-- Top right cloud --}}
            <div class="absolute top-20 -right-16 h-64 w-64 rounded-full bg-cyan-200/40 dark:bg-cyan-400/10 blur-3xl"></div>
            
            {{-- Bottom decorative wave --}}
            <svg class="absolute bottom-10 left-1/2 -translate-x-1/2 w-full max-w-[720px] h-48 opacity-20 dark:opacity-10" viewBox="0 0 1440 320" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,96L60,85.3C120,75,240,53,360,74.7C480,96,600,160,720,181.3C840,203,960,181,1080,154.7C1200,128,1320,96,1380,80L1440,64L1440,320L0,320Z" class="fill-sky-100 dark:fill-white/5"/>
            </svg>
        </div>

        {{-- Restructured main container with better spacing and card wrapper --}}
        <div class="relative flex min-h-svh flex-col items-center justify-center p-6 md:p-10">
            <div class="w-full max-w-md">
                {{-- Removed Laravel icon, replaced with text-based branding --}}
                <div class="flex flex-col items-center gap-2 text-center mb-6">
                    <a href="{{ route('home') }}" class="text-2xl font-semibold tracking-tight text-zinc-900 dark:text-zinc-100 hover:text-sky-600 dark:hover:text-sky-400 transition-colors" wire:navigate>
                        {{ 'AirHub' }}
                    </a>
                </div>

                {{-- Added glassmorphism card wrapper around slot --}}
                <div class="flex flex-col gap-6 rounded-2xl border border-zinc-200/60 dark:border-zinc-800/70 bg-white/80 dark:bg-zinc-900/60 shadow-lg backdrop-blur-sm p-6 md:p-8">
                    {{ $slot }}
                </div>
            </div>
        </div>

        @fluxScripts
    </body>
</html>
