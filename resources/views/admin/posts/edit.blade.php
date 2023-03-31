<x-layout>

    <x-setting :heading="'Edit Post: ' . $post->title">

        <form method="POST" action="/admin/posts/{{ $post->id }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="title" :value="old('title', $post->title)" />
            <x-form.input name="slug" :value="old('slug', $post->slug)" />

            <div class="flex mt-6">
                <div class="flex-1">
                    <x-form.input name="thumbnail" type="file" :value="old('thumbnail', $post->thumbnail)" />
                </div>

                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="" class="rounded-xl" ml-6 width="100">
            </div>

            <x-form.textarea name="excerpt">{{ old('excerpt', $post->excerpt) }}</x-form.textarea>
            <x-form.textarea name="body">{{ old('body', $post->body) }}</x-form.textarea>

            <x-form.input name="address" :value="old('address', $post->address)" />
            <x-form.input name="city" :value="old('city', $post->city)" />
            <x-form.input name="postcode" :value="old('postcode', $post->postcode)" />
            <x-form.input name="latitude" :value="old('latitude', $post->latitude)" />
            <x-form.input name="longitude" :value="old('longitude', $post->longitude)" />

            <x-form.input name="maxGuests" :value="old('maxGuests', $post->maxGuests)" />
            <x-form.input name="numBedrooms" :value="old('numBedrooms', $post->numBedrooms)" />
            <x-form.input name="numBathrooms" :value="old('numBathrooms', $post->numBathrooms)" />
            <x-form.input name="costPerNight" :value="old('costPerNight', $post->costPerNight)" />

            <x-form.field>
                <x-form.label name="category" />
                <select name="category_id" id="category_id">
                    @foreach (\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}"
                            value="{{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}">
                            {{ ucwords($category->name) }}</option>
                    @endforeach
                </select>
                <x-form.error name="category" />
            </x-form.field>

            <x-form.field>
                <x-form.label name="area" />
                <select name="area_id" id="area_id">
                    @foreach (\App\Models\Area::all() as $area)
                        <option value="{{ $area->id }}"
                            value="{{ old('area_id', $post->area_id) == $area->id ? 'selected' : '' }}">
                            {{ ucwords($area->area_name) }}</option>
                    @endforeach
                </select>
            </x-form.field>


            <x-form.button>Update</x-form.button>

        </form>

    </x-setting>

</x-layout>
