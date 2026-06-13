@props(['class' => ''])
<div {{ $attributes->merge(['class' => 'flex items-center gap-2 ' . $class]) }}>
    <div class="flex items-center justify-center w-9 h-9 bg-gradient-to-br from-primary-500 to-primary-700 rounded-lg shadow-sm">
        <span class="text-white font-bold text-sm">GO</span>
    </div>
    <div class="flex flex-col leading-tight">
        <span class="font-bold text-sm {{ str_contains($attributes->get('class', ''), 'text-white') ? 'text-white' : 'text-dark-900' }}">Gudang</span>
        <span class="text-xs font-medium {{ str_contains($attributes->get('class', ''), 'text-white') ? 'text-primary-200' : 'text-primary-600' }}">Online</span>
    </div>
</div>
