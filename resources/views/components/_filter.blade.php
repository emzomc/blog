<div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-4">
    <!--  Category -->
    <div class="relative lg:inline-flex bg-gray-100 rounded-xl">
        <x-category-dropdown />
    </div>

    <!--  Area -->
    <div class="relative lg:inline-flex bg-gray-100 rounded-xl">
        <x-area-dropdown />
    </div>

    <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
        <form method="GET" action="/cottages">
            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif

            <input type="text" name="search" placeholder="Search"
                class="bg-transparent placeholder-black font-semibold text-sm" value="{{ request('search') }}">
        </form>
        
    </div>
</div>
