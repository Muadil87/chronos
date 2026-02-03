<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chronos - Enter Flow State</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&family=JetBrains+Mono:wght@400;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        
        /* Subtle background glow animation */
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.1); }
        }
        .glow-blob {
            animation: pulse-glow 8s infinite ease-in-out;
        }
    </style>
</head>
<body class="bg-black text-white min-h-screen flex flex-col selection:bg-indigo-500 selection:text-white overflow-x-hidden">

    <nav class="w-full py-6 px-8 flex justify-between items-center max-w-7xl mx-auto z-50">
        <div class="flex items-center gap-4">
            <img src="{{ asset('logo.png') }}" alt="Chronos Logo" class="w-24 h-24 object-contain">
            
            <span class="text-3xl font-bold tracking-tight text-white">Chronos</span>
        </div>

        @if (Route::has('login'))
            <div class="flex items-center gap-6">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-300 hover:text-white transition-colors">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-300 hover:text-white transition-colors">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-white text-black px-5 py-2 rounded-full text-sm font-semibold hover:bg-gray-200 transition-colors">
                            Get Started
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>

    <main class="flex-grow flex flex-col items-center justify-center relative px-6 text-center z-10">
        
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-indigo-600/20 rounded-full blur-[120px] -z-10 glow-blob"></div>

        <div class="space-y-6 max-w-3xl mx-auto mt-12">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-gray-800 bg-gray-900/50 backdrop-blur-sm">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-xs font-mono text-gray-400 uppercase tracking-widest">v1.0 System Online</span>
            </div>

            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight leading-tight">
                Master your <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">time.</span><br>
                Own your <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">focus.</span>
            </h1>

            <p class="text-lg md:text-xl text-gray-400 max-w-2xl mx-auto leading-relaxed">
                Chronos is the minimal operating system for deep work. Track tasks, enter flow states, and analyze your productivity without distractions.
            </p>

            <div class="pt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl font-semibold transition-all shadow-lg shadow-indigo-500/25 flex items-center justify-center gap-2 group">
                    Start Your Mission
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </a>
                <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 bg-gray-900 border border-gray-800 hover:bg-gray-800 text-gray-300 rounded-xl font-medium transition-all">
                    Sign In
                </a>
            </div>
        </div>

        <div class="mt-24 grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto pb-20">
            <div class="p-6 rounded-2xl bg-gray-900/30 border border-gray-800 backdrop-blur-sm">
                <div class="w-10 h-10 bg-indigo-900/50 rounded-lg flex items-center justify-center mb-4 text-indigo-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-lg font-bold mb-2">Deep Focus</h3>
                <p class="text-sm text-gray-400">Distraction-free timer designed to keep you in the zone for longer stretches.</p>
            </div>

            <div class="p-6 rounded-2xl bg-gray-900/30 border border-gray-800 backdrop-blur-sm">
                <div class="w-10 h-10 bg-emerald-900/50 rounded-lg flex items-center justify-center mb-4 text-emerald-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                </div>
                <h3 class="text-lg font-bold mb-2">Task Tracking</h3>
                <p class="text-sm text-gray-400">Manage your active protocols and missions with a clean, command-line inspired interface.</p>
            </div>

            <div class="p-6 rounded-2xl bg-gray-900/30 border border-gray-800 backdrop-blur-sm">
                <div class="w-10 h-10 bg-amber-900/50 rounded-lg flex items-center justify-center mb-4 text-amber-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <h3 class="text-lg font-bold mb-2">Data Analytics</h3>
                <p class="text-sm text-gray-400">Visualize your productivity patterns and understand how you spend your time.</p>
            </div>
        </div>
    </main>

    <footer class="border-t border-gray-900 py-8 text-center text-gray-600 text-sm">
        <p>&copy; 2026 Chronos Systems. All rights reserved.</p>
    </footer>

</body>
</html>