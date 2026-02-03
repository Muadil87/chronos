<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chronos - Initialize System</title>
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
            <div class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-gray-800 border border-gray-700 mb-3 text-indigo-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            </div>
            <h1 class="text-xl font-bold tracking-tight">Initialize System</h1>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-3">
            @csrf

            <div>
                <label class="block text-[10px] font-mono text-gray-500 uppercase tracking-widest mb-1">Codename</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                    class="w-full bg-black/50 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all placeholder-gray-700"
                    placeholder="e.g. Neo">
                @error('name') <span class="text-red-500 text-[10px] mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-[10px] font-mono text-gray-500 uppercase tracking-widest mb-1">Comms Frequency</label>
                <input type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                    class="w-full bg-black/50 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all placeholder-gray-700"
                    placeholder="operator@chronos.system">
                @error('email') <span class="text-red-500 text-[10px] mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-[10px] font-mono text-gray-500 uppercase tracking-widest mb-1">Access Key</label>
                <input type="password" name="password" required autocomplete="new-password"
                    class="w-full bg-black/50 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all">
                @error('password') <span class="text-red-500 text-[10px] mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-[10px] font-mono text-gray-500 uppercase tracking-widest mb-1">Confirm Key</label>
                <input type="password" name="password_confirmation" required autocomplete="new-password"
                    class="w-full bg-black/50 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all">
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold py-3 rounded-lg transition-all shadow-lg shadow-indigo-500/20 mt-2 group">
                Establish Connection
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-xs text-gray-500">
                Already active? 
                <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 transition-colors font-medium">Log in</a>
            </p>
        </div>

    </div>

</body>
</html>