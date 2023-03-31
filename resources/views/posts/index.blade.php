<x-layout>

        <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">

            <div class="flex justify-center">
                <form action="/" method="get" class="border-2 border-gray-200 p-2 mt-10 space-y-4">
                        @include ('components.search')
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>
            </div>


            @if ($posts->count())
                <x-posts-grid :posts="$posts" />

                {{ $posts->links() }}
            @else
                <p class="text-center">No accomodations matching your search. Please check back later.</p>
            @endif

        </main>

</x-layout>
