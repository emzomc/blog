<x-layout>

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">

    <h3>Browse all the cottages or use the filters to narrow down your search</h3>

    @include ('components._filter')

            @if ($posts->count())
            <x-posts-grid :posts="$posts" />

            {{ $posts->links() }}
        @else
            <p class="text-center">No accomodation matching your search, please search for something else.</p>
        @endif

    </main>

</x-layout>
