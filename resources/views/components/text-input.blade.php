@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-dark-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm text-dark-900 placeholder-dark-400']) }}>
