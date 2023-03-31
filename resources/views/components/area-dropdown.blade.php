<x-dropdown>
    <x-slot name="trigger">
        <button class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left flex inline-flex">

            {{ isset($currentArea) ? ucwords($currentArea->area_name) : 'Area Type' }}

            <x-icon name="down-arrow" class="absolute pointer-events-none" style="right: 12px;" />
        </button>
    </x-slot>

    <x-dropdown-item href="/cottages?{{ http_build_query(request()->except('area', 'page')) }}" :active="request()->routeIs('home')">All
        Areas
    </x-dropdown-item>


    @foreach ($areas as $area)
        <x-dropdown-item
            href="/cottages?area={{ $area->area_slug }}&{{ http_build_query(request()->except('area', 'page')) }}"
            :active='request()->is("areas/{$area->area_slug}")'>
            {{ ucwords($area->area_name) }}
        </x-dropdown-item>
    @endforeach

</x-dropdown>
