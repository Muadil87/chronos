<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chronos - Settings</title>
    <link rel="icon" href="/logo.png" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
    </style>
</head>
<body class="bg-black text-white min-h-screen p-8">

    <header class="max-w-7xl mx-auto flex justify-between items-center mb-20 mt-8">
        
        <div class="flex items-center gap-8">
            <img src="/logo.png" alt="Chronos Logo" class="h-20 w-auto object-contain hover:scale-105 transition-transform duration-300">
            
            <a href="{{ route('dashboard') }}" class="group flex items-center gap-3 text-gray-500 hover:text-white transition-colors">
                <svg class="w-6 h-6 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="text-lg font-mono uppercase tracking-widest">Back</span>
            </a>
        </div>

        <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight">
            Account Settings
        </h1>
    </header>

    <main class="max-w-xl mx-auto space-y-12">

        <section class="bg-gray-900/30 border border-gray-800 rounded-2xl p-8">
            <h2 class="text-xl font-bold mb-8 text-indigo-400">Profile Information</h2>
            
            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('patch')

                <div>
                    <label class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-3">Display Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full bg-black border border-gray-800 rounded-lg px-5 py-4 text-lg text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all placeholder-gray-700">
                    @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-3">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full bg-black border border-gray-800 rounded-lg px-5 py-4 text-lg text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all">
                    @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center justify-between pt-4">
                    <button type="submit" class="bg-white text-black px-8 py-3 rounded-lg font-bold text-lg hover:bg-gray-200 transition-colors">Save Changes</button>
                    
                    @if (session('status') === 'profile-updated')
                        <span class="text-sm text-green-500 font-mono" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">SAVED successfully.</span>
                    @endif
                </div>
            </form>
        </section>

        <section class="bg-gray-900/30 border border-gray-800 rounded-2xl p-8">
            <h2 class="text-xl font-bold mb-8 text-indigo-400">Update Password</h2>
            
            <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('put')

                <div>
                    <label class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-3">Current Password</label>
                    <input type="password" name="current_password" class="w-full bg-black border border-gray-800 rounded-lg px-5 py-4 text-lg text-white focus:border-indigo-500 outline-none">
                    @error('current_password', 'updatePassword') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-3">New Password</label>
                    <input type="password" name="password" class="w-full bg-black border border-gray-800 rounded-lg px-5 py-4 text-lg text-white focus:border-indigo-500 outline-none">
                    @error('password', 'updatePassword') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-3">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="w-full bg-black border border-gray-800 rounded-lg px-5 py-4 text-lg text-white focus:border-indigo-500 outline-none">
                </div>

                <div class="flex items-center justify-between pt-4">
                    <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-bold text-lg hover:bg-indigo-500 transition-colors">Update Password</button>
                    
                    @if (session('status') === 'password-updated')
                        <span class="text-sm text-green-500 font-mono">Saved.</span>
                    @endif
                </div>
            </form>
        </section>

        <div class="flex justify-between items-center px-4 pt-8 border-t border-gray-900">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-gray-500 hover:text-white text-sm font-mono uppercase tracking-widest transition-colors">
                    Log Out
                </button>
            </form>

            <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you sure? This cannot be undone.');">
                @csrf
                @method('delete')
                <div class="hidden">
                     <input type="password" name="password" required placeholder="Confirm Password to Delete" class="bg-transparent border-b border-red-900 text-red-500 mb-2">
                </div>
                <button type="submit" class="text-red-900 hover:text-red-500 text-xs font-mono uppercase tracking-widest transition-colors">
                    Delete Account
                </button>
            </form>
        </div>

    </main>
</body>
</html>