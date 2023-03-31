<x-layout>

    <x-setting :heading="'Edit Booking: ' . $booking->post->title">

        <form method="POST" action="/user/posts/bookings/{{ $booking->id }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.number name="guests" :value="old('guests', $booking->guests)" />

            <x-form.calendar name="checkin" :value="old('checkin', $booking->checkin)" />

            <x-form.calendar name="checkout" :value="old('checkout', $booking->checkout)" />

            <x-form.button>Update</x-form.button>

        </form>

    </x-setting>
    
</x-layout>
