@props(['icon', 'link', 'name', 'navigate'])

@php
    $routeName = Request::route()->getName();
    $active = str_contains($routeName, strtolower($name));
    $classes = $active ? 'sidebar-item active' : 'sidebar-item';
@endphp

<li class="{{ $classes }} {{ $slot->isEmpty() ? '' : 'has-sub' }}">
    <a class='sidebar-link' href="{{ $slot->isEmpty() ? $link : '#' }}" {{ $navigate == true ? 'wire:navigate' : '' }}>
        <i class="{{ $icon }}"></i>
        <span>{{ $name }}</span>
    </a>

    @if (!$slot->isEmpty())
        <ul class="submenu" style="display: {{ $active ? 'block' : '' }};">
            {{ $slot }}
        </ul>
    @endif

</li>
