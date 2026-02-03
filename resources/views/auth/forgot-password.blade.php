<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chronos - Recovery Protocol</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
    </style>
</head>
<body class="bg-black text-white min-h-screen flex items-center justify-center p-4 relative overflow-y-auto">

    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-indigo-600/20 rounded-full blur-[100px] -z-10"></div>

    <div class="w-full max-w-sm bg-gray-900/40 backdrop-blur-xl border border-gray-800 rounded-2xl p-6 shadow-2xl">
        
        <div class="text-center mb-6">
            <div class="flex justify-center mb-4">
                 <img src="{{ asset('logo.png') }}" alt="Chronos Logo" class="w-16 h-16 object-contain">
            </div>
            <h1 class="text-xl font-bold tracking-tight">Recovery Protocol</h1>
            <p class="text-xs text-gray-500 mt-2 leading-relaxed">
                Lost your access key? No problem. Provide your comms frequency below and we will transmit a reset link.
            </p>
        </div>

        @if (session('status'))
            <div class="mb-4 text-xs font-medium text-emerald-400 bg-emerald-900/30 p-3 rounded-lg border border-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-[10px] font-mono text-gray-500 uppercase tracking-widest mb-1">Comms Frequency / Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full bg-black/50 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all placeholder-gray-700"
                    placeholder="operator@chronos.system">
                @error('email') <span class="text-red-500 text-[10px] mt-1 block">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold py-3 rounded-lg transition-all shadow-lg shadow-indigo-500/20 mt-2 group flex items-center justify-center gap-2">
                <span>Transmit Reset Link</span>
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
            </button>
        </form>

        <div class="mt-6 text-center border-t border-gray-800 pt-4">
            <a href="{{ route('login') }}" class="text-xs text-gray-500 hover:text-white transition-colors flex items-center justify-center gap-2">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Return to Login
            </a>
        </div>

    </div>

</body>
</html>