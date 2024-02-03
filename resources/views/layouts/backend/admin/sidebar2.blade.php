@inject('Salz_Menu', 'App\Models\Utils\Salz_Menu')


<x-maz-sidebar :href="route('backend.admin.member')" :logo="asset('images/logo/logo.png')">

    {{ $Salz_Menu->printMenu2() }}

    {{-- <x-maz-sidebar-item name="Component" icon="bi bi-stack" :navigate="false">
        <x-maz-sidebar-sub-item name="Accordion" :link="route('backend.admin.member')" :navigate="true"></x-maz-sidebar-sub-item>
        <x-maz-sidebar-sub-item name="Alert" :link="route('backend.admin.member')" :navigate="true"></x-maz-sidebar-sub-item>
    </x-maz-sidebar-item> --}}

</x-maz-sidebar>

{{-- <livewire:Backend.Admin.Components.MazSidebar :href="route('backend.admin.member')" :logo="asset('images/logo/logo.png')">
    {{ $Salz_Menu->printMenu2() }}
</livewire> --}}
