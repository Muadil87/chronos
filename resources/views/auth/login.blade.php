<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chronos - Identify</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
    </style>
</head>
<body class="bg-black text-white min-h-screen flex flex-col items-center justify-center selection:bg-indigo-500/30">

    <div class="fixed inset-0 z-0 pointer-events-none" style="background-image: radial-gradient(rgba(50, 50, 50, 0.2) 1px, transparent 1px); background-size: 24px 24px; opacity: 0.2;"></div>

    <div class="w-full max-w-md px-6 relative z-10">
        
      <div class="mb-10 text-center">
    <img src="{{ asset('logo.png') }}" alt="Chronos Logo" class="w-20 h-20 mx-auto mb-6 drop-shadow-[0_0_15px_rgba(99,102,241,0.5)]">
    
    <h1 class="text-2xl font-bold tracking-tight text-white">Chronos</h1>
    <p class="text-gray-500 mt-2 text-sm">Enter the flow state.</p>
     </div>
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div class="space-y-2">
                <label for="email" class="block text-xs font-mono text-gray-400 uppercase tracking-widest">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                    class="w-full bg-gray-900/50 border border-gray-800 rounded-lg px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all shadow-sm">
                @error('email')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-2">
                <div class="flex justify-between items-center">
                    <label for="password" class="block text-xs font-mono text-gray-400 uppercase tracking-widest">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs text-indigo-400 hover:text-indigo-300 transition-colors">Forgot?</a>
                    @endif
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="w-full bg-gray-900/50 border border-gray-800 rounded-lg px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all shadow-sm">
                @error('password')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember" 
                    class="rounded bg-gray-900 border-gray-800 text-indigo-600 shadow-sm focus:ring-indigo-500 focus:ring-offset-black">
                <span class="ml-2 text-sm text-gray-400">Remember me</span>
            </div>

            <button type="submit" class="w-full bg-white text-black font-semibold py-3.5 rounded-lg hover:bg-gray-200 transition-all shadow-[0_0_20px_rgba(255,255,255,0.1)] hover:shadow-[0_0_25px_rgba(255,255,255,0.2)]">
                Authenticate
            </button>
            
            <div class="text-center mt-6">
                <p class="text-sm text-gray-500">
                    No access? 
                    <a href="{{ route('register') }}" class="text-white hover:underline decoration-gray-600 underline-offset-4">Request clearance</a>
                </p>
            </div>
        </form>
    </div>
</body>
</html>