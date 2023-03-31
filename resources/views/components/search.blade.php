<div class="location">
    <label for="location">Location</label>
    <select class="border-2 border-gray-200 p-1" name="area">
        @foreach ($locations as $location)
            <option value="{{ $location->area_slug }} ">
                {{ $location->area_name }}
            </option>
        @endforeach
    </select>
</div>



<div class="guests">
    <label for="guests">No. of Guests</label>
    <input class="border-2 border-gray-200 p-1" type="number" name="guests" min="1" max="10"
        class="bg-transparent placeholder-black font-semibold text-sm" value="{{ old('guests') }}">
</div>



<div class="accomodation">
    <label for="accomodation">Accomodation Type</label>
    <select class="border-2 border-gray-200 p-1" name="category">
        @foreach ($accomodations as $accomodation)
            <option value="{{ $accomodation->slug }}">
                {{ $accomodation->name }}</option>
        @endforeach
    </select>
</div>
