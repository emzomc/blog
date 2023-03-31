<x-layout>

    <x-setting heading="Add Cottage ">

        <form method="POST" action="/admin/posts" enctype="multipart/form-data">
            @csrf

            <x-form.input name="title" />
            <x-form.input name="slug" />
            <x-form.input name="thumbnail" type="file" />
            <x-form.textarea name="excerpt" />
            <x-form.textarea name="body" />

            <x-form.input name="address" />
            <x-form.input name="city" />
            <x-form.input name="postcode" />
            <x-form.input name="latitude" />
            <x-form.input name="longitude" />

            <x-form.input name="maxGuests" />
            <x-form.input name="numBedrooms" />
            <x-form.input name="numBathrooms" />
            <x-form.input name="costPerNight" />

            <x-form.field>
                <x-form.label name="category" />
                <select name="category_id" id="category_id">
                    @foreach (\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}"
                            value="{{ old('category_id') == $category->id ? 'selected' : '' }}">
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
                            value="{{ old('area_id') == $area->id ? 'selected' : '' }}">
                            {{ ucwords($area->area_name) }}</option>
                    @endforeach
                </select>
            </x-form.field>


            <x-form.button>Publish</x-form.button>

        </form>

    </x-setting>

</x-layout>
