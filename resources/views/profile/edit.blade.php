<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chronos - Settings</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
    </style>
</head>
<body class="bg-black text-white min-h-screen p-8">

    <header class="max-w-xl mx-auto flex justify-between items-center mb-12">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-gray-500 hover:text-white transition-colors group">
            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span class="text-sm font-mono uppercase tracking-widest">Back</span>
        </a>
        <h1 class="text-lg font-bold">Account Settings</h1>
    </header>

    <main class="max-w-xl mx-auto space-y-12">

        <section class="bg-gray-900/30 border border-gray-800 rounded-2xl p-8">
            <h2 class="text-lg font-semibold mb-6">Profile Information</h2>
            
            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('patch')

                <div>
                    <label class="block text-xs font-mono text-gray-500 uppercase tracking-widest mb-2">Display Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full bg-black border border-gray-800 rounded-lg px-4 py-3 text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all">
                    @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-mono text-gray-500 uppercase tracking-widest mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full bg-black border border-gray-800 rounded-lg px-4 py-3 text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all">
                    @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-white text-black px-6 py-2 rounded-lg font-medium hover:bg-gray-200 transition-colors">Save Changes</button>
                    
                    @if (session('status') === 'profile-updated')
                        <span class="text-sm text-green-500" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">Saved.</span>
                    @endif
                </div>
            </form>
        </section>

        <section class="bg-gray-900/30 border border-gray-800 rounded-2xl p-8">
            <h2 class="text-lg font-semibold mb-6">Update Password</h2>
            
            <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('put')

                <div>
                    <label class="block text-xs font-mono text-gray-500 uppercase tracking-widest mb-2">Current Password</label>
                    <input type="password" name="current_password" class="w-full bg-black border border-gray-800 rounded-lg px-4 py-3 text-white focus:border-indigo-500 outline-none">
                    @error('current_password', 'updatePassword') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-mono text-gray-500 uppercase tracking-widest mb-2">New Password</label>
                    <input type="password" name="password" class="w-full bg-black border border-gray-800 rounded-lg px-4 py-3 text-white focus:border-indigo-500 outline-none">
                    @error('password', 'updatePassword') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-mono text-gray-500 uppercase tracking-widest mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="w-full bg-black border border-gray-800 rounded-lg px-4 py-3 text-white focus:border-indigo-500 outline-none">
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-indigo-500 transition-colors">Update Password</button>
                    
                    @if (session('status') === 'password-updated')
                        <span class="text-sm text-green-500">Saved.</span>
                    @endif
                </div>
            </form>
        </section>

        <div class="flex justify-between items-center px-4">
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