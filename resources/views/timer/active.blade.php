<x-app-layout>
    <div class="min-h-screen bg-black flex flex-col items-center justify-center relative overflow-hidden" x-data="timer({{ $minutes * 60 }})">
        
        <div class="absolute inset-0 bg-gradient-to-b from-indigo-900/10 to-black pointer-events-none"></div>

        <div class="z-10 mb-8">
            <span class="px-4 py-1.5 rounded-full border border-gray-800 bg-gray-900/50 text-indigo-400 text-xs font-mono uppercase tracking-widest">
                {{ $mode }}
            </span>
        </div>

        <div class="z-10 relative">
            <h1 class="text-[12rem] leading-none font-bold text-white font-mono tracking-tighter tabular-nums" x-text="formattedTime">
                00:00
            </h1>
        </div>

        <div class="z-10 mt-12 flex items-center gap-6">
            <button @click="toggle" class="group flex items-center justify-center w-16 h-16 rounded-full bg-white text-black hover:scale-110 transition-all duration-200">
                <svg x-show="!running" class="w-6 h-6 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                <svg x-show="running" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
            </button>

            <button @click="reset" class="group flex items-center justify-center w-12 h-12 rounded-full border border-gray-700 text-gray-400 hover:border-gray-500 hover:text-white hover:bg-gray-800 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
            </button>
            
            <a href="{{ route('timer.index') }}" class="group flex items-center justify-center w-12 h-12 rounded-full border border-gray-700 text-red-400 hover:border-red-500 hover:text-red-500 hover:bg-red-900/20 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </a>
        </div>

    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('timer', (initialSeconds) => ({
                timeLeft: initialSeconds,
                totalTime: initialSeconds,
                running: false,
                interval: null,

                init() {
                    // Auto-start when page loads
                    this.start();
                },

                get formattedTime() {
                    const m = Math.floor(this.timeLeft / 60);
                    const s = this.timeLeft % 60;
                    return `${String(m).padStart(2, '0')}:${String(s).padStart(2, '0')}`;
                },

                toggle() {
                    this.running ? this.pause() : this.start();
                },

                start() {
                    if (!this.running) {
                        this.running = true;
                        this.interval = setInterval(() => {
                            if (this.timeLeft > 0) {
                                this.timeLeft--;
                                // Update browser tab title
                                document.title = `${this.formattedTime} - Chronos`;
                            } else {
                                this.complete();
                            }
                        }, 1000);
                    }
                },

                pause() {
                    this.running = false;
                    clearInterval(this.interval);
                    document.title = 'Paused - Chronos';
                },

                reset() {
                    this.pause();
                    this.timeLeft = this.totalTime;
                    document.title = 'Chronos';
                },

                complete() {
                    this.pause();
                    // Play a sound or show notification here
                    alert('Session Complete.');
                }
            }));
        });
    </script>
</x-app-layout>