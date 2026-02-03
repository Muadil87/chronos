<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chronos - Focus Mode</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600&family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .timer-font { font-family: 'JetBrains Mono', monospace; letter-spacing: 0.05em; }
        .pulse-subtle { animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.8; } }
    </style>
</head>
<body class="bg-black text-white">
    <div class="min-h-screen bg-black flex flex-col items-center justify-center relative overflow-hidden">
        
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-gray-700 rounded-full blur-3xl"></div>
            <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-gray-800 rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10 flex flex-col items-center justify-center">
            
            <div class="mb-16 text-center">
                <p class="text-gray-500 text-sm font-500 tracking-wide mb-2">FOCUS SESSION</p>
                <h1 class="text-2xl font-bold text-white tracking-tight">{{ $task->title }}</h1>
            </div>

            <div class="mb-16">
                <div id="timer-display" class="timer-font text-9xl font-600 text-white text-center leading-tight">
                    {{ sprintf("%02d", $task->time_goal) }}:00
                </div>
                <p id="timer-status" class="text-center text-gray-600 text-sm mt-8 tracking-wide">Ready to focus?</p>
            </div>

            <div class="flex items-center gap-6">
                <button id="toggleBtn" onclick="toggleTimer()" class="flex items-center justify-center w-16 h-16 rounded-full border-2 border-gray-700 hover:border-gray-600 hover:bg-gray-900 transition-all duration-200 group">
                    <svg id="playIcon" class="w-7 h-7 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"></path></svg>
                    <svg id="pauseIcon" class="hidden w-7 h-7 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M5.75 1.5a.75.75 0 00-.75.75v16.5c0 .414.336.75.75.75h1.5a.75.75 0 00.75-.75V2.25a.75.75 0 00-.75-.75h-1.5zm8 0a.75.75 0 00-.75.75v16.5c0 .414.336.75.75.75h1.5a.75.75 0 00.75-.75V2.25a.75.75 0 00-.75-.75h-1.5z"></path></svg>
                </button>

                <a href="{{ route('tasks.show', $task) }}" class="flex items-center justify-center w-16 h-16 rounded-full bg-gray-900 border-2 border-gray-700 hover:border-red-500 hover:bg-red-500 hover:bg-opacity-10 transition-all duration-200 group">
                    <svg class="w-7 h-7 text-gray-600 group-hover:text-red-400 transition-colors" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.5 2A2.5 2.5 0 002 4.5v11A2.5 2.5 0 004.5 18h11a2.5 2.5 0 002.5-2.5v-11A2.5 2.5 0 0015.5 2h-11zm0 2h11a.5.5 0 01.5.5v11a.5.5 0 01-.5.5h-11a.5.5 0 01-.5-.5v-11a.5.5 0 01.5-.5z" clip-rule="evenodd"></path></svg>
                </a>
            </div>

            <div class="mt-16 text-center">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gray-900 border border-gray-800">
                    <span class="text-xs text-gray-400">No distractions. No notifications.</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        let timeLeft = {{ $task->time_goal * 60 }}; // Convert minutes to seconds
        let timerInterval;
        let isRunning = false;

        const display = document.getElementById('timer-display');
        const status = document.getElementById('timer-status');
        const playIcon = document.getElementById('playIcon');
        const pauseIcon = document.getElementById('pauseIcon');

        function updateDisplay() {
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            // Add leading zeros
            display.textContent = 
                (minutes < 10 ? "0" : "") + minutes + ":" + 
                (seconds < 10 ? "0" : "") + seconds;
        }

        function toggleTimer() {
            if (isRunning) {
                // PAUSE
                clearInterval(timerInterval);
                isRunning = false;
                playIcon.classList.remove('hidden');
                pauseIcon.classList.add('hidden');
                status.textContent = "Paused";
                display.classList.remove('pulse-subtle');
            } else {
                // START
                isRunning = true;
                playIcon.classList.add('hidden');
                pauseIcon.classList.remove('hidden');
                status.textContent = "Stay focused. You've got this.";
                display.classList.add('pulse-subtle');

                timerInterval = setInterval(() => {
                    if (timeLeft > 0) {
                        timeLeft--;
                        updateDisplay();
                    } else {
                        // Timer Finished
                        clearInterval(timerInterval);
                        display.classList.remove('pulse-subtle');
                        status.textContent = "Session Complete!";
                        playIcon.classList.remove('hidden');
                        pauseIcon.classList.add('hidden');
                        alert("Great job! Session complete.");
                    }
                }, 1000);
            }
        }
    </script>
</body>
</html>