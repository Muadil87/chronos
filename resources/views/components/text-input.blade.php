@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full glass-input border-gray-300 dark:border-gray-700 dark:text-gray-300 focus:border-indigo-400 focus:ring-indigo-400 rounded-lg shadow-sm px-3 py-2']) }}>
