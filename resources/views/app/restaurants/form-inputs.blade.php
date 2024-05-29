@php $editing = isset($restaurant) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $restaurant->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="title"
            label="Title"
            :value="old('title', ($editing ? $restaurant->title : ''))"
            maxlength="255"
            placeholder="Title"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="slug"
            label="Slug"
            :value="old('slug', ($editing ? $restaurant->slug : ''))"
            maxlength="255"
            placeholder="Slug"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="content" label="Content" maxlength="255"
            >{{ old('content', ($editing ? $restaurant->content : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="excerpt"
            label="Excerpt"
            :value="old('excerpt', ($editing ? $restaurant->excerpt : ''))"
            maxlength="255"
            placeholder="Excerpt"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="is_published"
            label="Is Published"
            :checked="old('is_published', ($editing ? $restaurant->is_published : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="comment_status"
            label="Comment Status"
            :checked="old('comment_status', ($editing ? $restaurant->comment_status : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="ping_status"
            label="Ping Status"
            :checked="old('ping_status', ($editing ? $restaurant->ping_status : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.datetime
            name="published_at"
            label="Published At"
            value="{{ old('published_at', ($editing ? optional($restaurant->published_at)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $restaurant->thumbnail ? \Storage::url($restaurant->thumbnail) : '' }}')"
        >
            <x-inputs.partials.label
                name="thumbnail"
                label="Thumbnail"
            ></x-inputs.partials.label
            ><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img
                    :src="imageUrl"
                    class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100px;"
                />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div
                    class="border rounded border-gray-200 bg-gray-100"
                    style="width: 100px; height: 100px;"
                ></div>
            </template>

            <div class="mt-2">
                <input
                    type="file"
                    name="thumbnail"
                    id="thumbnail"
                    @change="fileChosen"
                />
            </div>

            @error('thumbnail') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="phone"
            label="Phone"
            :value="old('phone', ($editing ? $restaurant->phone : ''))"
            maxlength="255"
            placeholder="Phone"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="phone_2"
            label="Phone 2"
            :value="old('phone_2', ($editing ? $restaurant->phone_2 : ''))"
            maxlength="255"
            placeholder="Phone 2"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="phone_3"
            label="Phone 3"
            :value="old('phone_3', ($editing ? $restaurant->phone_3 : ''))"
            maxlength="255"
            placeholder="Phone 3"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="reservation_required"
            label="Reservation Required"
            :checked="old('reservation_required', ($editing ? $restaurant->reservation_required : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="website_url"
            label="Website Url"
            :value="old('website_url', ($editing ? $restaurant->website_url : ''))"
            maxlength="255"
            placeholder="Website Url"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="address"
            label="Address"
            :value="old('address', ($editing ? $restaurant->address : ''))"
            maxlength="255"
            placeholder="Address"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="city"
            label="City"
            :value="old('city', ($editing ? $restaurant->city : ''))"
            maxlength="255"
            placeholder="City"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="country"
            label="Country"
            :value="old('country', ($editing ? $restaurant->country : ''))"
            maxlength="255"
            placeholder="Country"
        ></x-inputs.text>
    </x-inputs.group>
</div>
