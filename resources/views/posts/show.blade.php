<x-layout>

    <section class="px-6 py-8">
        <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
            <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
                <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="" class="rounded-xl">
                    <div class="flex items-center lg:justify-center text-sm mt-4">

                        <div class="ml-3 text-left">
                            <h5 class="font-bold">

                            </h5>
                        </div>
                    </div>
                </div>

                <div class="col-span-8">
                    <div class="hidden lg:flex justify-between mb-6">
                        <a href="/cottages"
                            class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                            <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                                <g fill="none" fill-rule="evenodd">
                                    <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                    </path>
                                    <path class="fill-current"
                                        d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                                    </path>
                                </g>
                            </svg>

                            Back to Cottages
                        </a>

                        <div class="space-x-2">
                            <x-category-button :category="$post->category" />
                        </div>
                    </div>

                    <h1 class="font-bold text-3xl lg:text-4xl mb-10">
                        {{ $post->title }}
                    </h1>

                    <div class="space-y-4 lg:text-lg leading-loose">
                        {!! $post->body !!}
                    </div>
                </div>

                <table class="col-span-8 col-start-1 mt-10 space-y-6"
                    style="border: 1px solid #ddd; text-align: center;">
                    <tr>
                        <th>City</th>
                        <th>Guests</th>
                        <th>Bedrooms</th>
                        <th>Bathrooms</th>
                        <th>Cost Per Night</th>
                    </tr>
                    <tr>
                        <td>{!! $post->city !!}</td>
                        <td>{!! $post->maxGuests !!}</td>
                        <td>{!! $post->numBedrooms !!}</td>
                        <td>{!! $post->numBathrooms !!}</td>
                        <td>£{!! $post->costPerNight !!}</td>
                    </tr>
                </table>
                <a href="https://maps.google.com/?q={{ $post->latitude }},{{ $post->longitude }}">
                    <button class="btn btn-success">
                        View in Google Maps
                    </button>
                </a>

                @can('user')
                    <form class="col-span-6 col-start-1 mt-10 space-y-4" id="bookingForm" action="/booking" method="POST">
                        @csrf
                        <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                        <input type="hidden" value="{{ $post->id }}" name="post_id">
                        <input type="hidden" value="{{ $post->maxGuests }}" name="maxGuests">
                        <input type="hidden" value="{{ $post->costPerNight }}" name="costPerNight">
                        <x-form.number name="guests" min="1" max="{{ $post->maxGuests }}" />
                        <hr>
                        <x-form.calendar name="checkin" />
                        <hr>
                        <x-form.calendar name="checkout" />
                        <hr>
                        <x-form.button>Book</x-form.button>
                    </form>
                @else
                    <a href="/login">
                        <button type="button" class="btn btn-primary">Login to book</button>
                    </a>
                @endcan

                <!--map-->
                <div id="map" class="col-span-8 col-start-1 mt-20 space-y-4" style="height:500px">
                @include ('components.map')
                </div>

                <!--calendar-->
                <div class="col-span-8 mt-10">
                    <div id="calendar">
                        <input type="hidden" value="{{ $post->id }}" name="id" id="id">
                    </div>
                </div>


                <!--reviev and commment-->
                <section class="col-span-8 col-start-5 mt-10">


                    <!--checkout date for cottage booked by logged in user has passed - user can leave review-->
                    @can('user')
                        @if ($checkoutDateReview)
                            @include ('components.reviewform')
                        @endif
                    @endcan

                    @if ($post->comments->count())
                        @foreach ($post->comments as $comment)
                            <x-review :comment="$comment" />
                        @endforeach
                    @else
                        <p class="text-center">No reviews yet.</p>
                    @endif

                </section>

            </article>
        </main>

    </section>

</x-layout>

<!--Calendar-->
<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            events: [
                @foreach ($bookings as $booking)
                    {
                        title: 'UNAVAILABLE',
                        start: '{{ $booking->checkin }}',
                        end: '{{ $booking->checkout }}T23:00:00',
                        backgroundColor: '#006bc9',
                        textColor: '#ffffff'
                    },
                @endforeach
            ]
        });
    });
</script>
<!--Calendar-->
