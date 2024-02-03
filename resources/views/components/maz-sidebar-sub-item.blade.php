@props(['link', 'name', 'navigate'])

<li class="submenu-item">
    <a href="{{ $link }}" {{ $navigate == true ? 'wire:navigate' : '' }}>{{ $name }}</a>
</li>
