<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main class="flex-1 p-6 lg:p-8">
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>
