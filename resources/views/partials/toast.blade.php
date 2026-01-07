<div x-data="{
    show: false,
    message: '',
    type: 'success',
    init() {
        @if (session('success')) this.notify('{{ session('success') }}', 'success'); @endif
        @if (session('error')) this.notify('{{ session('error') }}', 'error'); @endif

        window.addEventListener('notify', (event) => {
            this.notify(event.detail.message, event.detail.type);
        });
    },
    notify(message, type = 'success') {
        this.message = message;
        this.type = type;
        this.show = true;
        setTimeout(() => this.show = false, 3000);
    }
}" x-show="show" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="translate-y-2 opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-y-0 opacity-100"
    x-transition:leave-end="translate-y-2 opacity-0"
    class="fixed top-4 right-4 z-[300] w-full max-w-sm p-4 bg-shop-black text-white rounded-xl shadow-2xl border border-white/10 flex items-center justify-between gap-4"
    style="display: none;">

    <div class="flex-1 min-w-0">
        <h3 class="text-sm font-bold text-white tracking-wide" x-text="type === 'success' ? 'Success' : 'Error'"></h3>
        <p class="text-xs text-gray-400 mt-1 leading-relaxed font-medium" x-text="message"></p>
    </div>

    <!-- Accent Button -->
    <button @click="show = false"
        class="px-4 py-2 bg-accent text-primary text-xs font-bold rounded-lg hover:brightness-110 transition shadow-lg shadow-accent/20 shrink-0">
        Close
    </button>
</div>
