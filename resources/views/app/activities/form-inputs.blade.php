@php $editing = isset($activity) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="activity_key"
            label="Activity Key"
            :value="old('activity_key', ($editing ? $activity->activity_key : ''))"
            maxlength="255"
            placeholder="Activity Key"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="activity_content"
            label="Activity Content"
            :value="old('activity_content', ($editing ? $activity->activity_content : ''))"
            maxlength="255"
            placeholder="Activity Content"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $activity->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
