<x-app-layout>
    <div class="min-h-screen bg-black flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-indigo-900/20 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-4xl w-full space-y-8 relative z-10">
            
            <div class="text-center">
                <h2 class="text-4xl font-bold tracking-tight text-white sm:text-5xl">
                    Initiate Sequence
                </h2>
                <p class="mt-4 text-lg text-gray-400">
                    Select a time protocol to begin deep work.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">

                <a href="{{ route('timer.show', ['minutes' => 60, 'mode' => 'Deep Focus']) }}" class="group relative bg-gray-900/50 backdrop-blur-xl border border-gray-800 rounded-2xl p-8 hover:bg-gray-800/80 hover:border-indigo-500/50 transition-all duration-300 hover:-translate-y-1 cursor-pointer">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 to-transparent opacity-0 group-hover:opacity-100 rounded-2xl transition-opacity"></div>
                    
                    <div class="relative">
                        <div class="text-indigo-400 font-mono text-xs uppercase tracking-widest mb-2">Standard Protocol</div>
                        <div class="text-4xl font-bold text-white mb-1">1 hr</div>
                        <div class="text-gray-500 text-sm">3 Cycles</div>

                        <div class="mt-6 flex gap-1">
                            <div class="h-1.5 w-8 bg-indigo-500 rounded-full"></div>
                            <div class="h-1.5 w-2 bg-gray-700 rounded-full"></div>
                            <div class="h-1.5 w-8 bg-indigo-500 rounded-full"></div>
                            <div class="h-1.5 w-2 bg-gray-700 rounded-full"></div>
                            <div class="h-1.5 w-8 bg-indigo-500 rounded-full"></div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('timer.show', ['minutes' => 120, 'mode' => 'Deep Flow']) }}" class="group relative bg-gray-900/50 backdrop-blur-xl border border-gray-800 rounded-2xl p-8 hover:bg-gray-800/80 hover:border-purple-500/50 transition-all duration-300 hover:-translate-y-1 cursor-pointer">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-transparent opacity-0 group-hover:opacity-100 rounded-2xl transition-opacity"></div>
                    
                    <div class="relative">
                        <div class="text-purple-400 font-mono text-xs uppercase tracking-widest mb-2">Extended Flow</div>
                        <div class="text-4xl font-bold text-white mb-1">2 hrs</div>
                        <div class="text-gray-500 text-sm">6 Cycles</div>

                        <div class="mt-6 flex gap-1 opacity-50">
                            <div class="h-1.5 w-full bg-purple-500 rounded-full"></div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('timer.show', ['minutes' => 180, 'mode' => 'Monk Mode']) }}" class="group relative bg-gray-900/50 backdrop-blur-xl border border-gray-800 rounded-2xl p-8 hover:bg-gray-800/80 hover:border-emerald-500/50 transition-all duration-300 hover:-translate-y-1 cursor-pointer">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-transparent opacity-0 group-hover:opacity-100 rounded-2xl transition-opacity"></div>
                    
                    <div class="relative">
                        <div class="text-emerald-400 font-mono text-xs uppercase tracking-widest mb-2">Monk Mode</div>
                        <div class="text-4xl font-bold text-white mb-1">3 hrs</div>
                        <div class="text-gray-500 text-sm">9 Cycles</div>

                        <div class="mt-6 flex gap-1 opacity-50">
                            <div class="h-1.5 w-full bg-emerald-500 rounded-full"></div>
                        </div>
                    </div>
                </a>

            </div>

            <div class="mt-8 text-center">
                 <form action="{{ route('timer.show') }}" method="GET" class="inline-flex items-center gap-2 bg-gray-900 border border-gray-800 rounded-lg p-1 pr-4">
                    <input type="number" name="minutes" placeholder="Custom min" class="bg-transparent border-none text-white text-sm w-24 focus:ring-0 text-center" min="1" max="600">
                    <button type="submit" class="text-xs text-indigo-400 hover:text-white font-bold uppercase">Start</button>
                 </form>
            </div>

        </div>
    </div>
</x-app-layout>