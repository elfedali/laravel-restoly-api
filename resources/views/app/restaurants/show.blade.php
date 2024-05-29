<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.restaurants.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('restaurants.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.restaurants.inputs.user_id')
                        </h5>
                        <span
                            >{{ optional($restaurant->user)->name ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.restaurants.inputs.title')
                        </h5>
                        <span>{{ $restaurant->title ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.restaurants.inputs.slug')
                        </h5>
                        <span>{{ $restaurant->slug ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.restaurants.inputs.content')
                        </h5>
                        <span>{{ $restaurant->content ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.restaurants.inputs.excerpt')
                        </h5>
                        <span>{{ $restaurant->excerpt ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.restaurants.inputs.is_published')
                        </h5>
                        <span>{{ $restaurant->is_published ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.restaurants.inputs.comment_status')
                        </h5>
                        <span>{{ $restaurant->comment_status ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.restaurants.inputs.ping_status')
                        </h5>
                        <span>{{ $restaurant->ping_status ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.restaurants.inputs.published_at')
                        </h5>
                        <span>{{ $restaurant->published_at ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.restaurants.inputs.thumbnail')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $restaurant->thumbnail ? \Storage::url($restaurant->thumbnail) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.restaurants.inputs.phone')
                        </h5>
                        <span>{{ $restaurant->phone ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.restaurants.inputs.phone_2')
                        </h5>
                        <span>{{ $restaurant->phone_2 ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.restaurants.inputs.phone_3')
                        </h5>
                        <span>{{ $restaurant->phone_3 ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.restaurants.inputs.reservation_required')
                        </h5>
                        <span
                            >{{ $restaurant->reservation_required ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.restaurants.inputs.website_url')
                        </h5>
                        <span>{{ $restaurant->website_url ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.restaurants.inputs.address')
                        </h5>
                        <span>{{ $restaurant->address ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.restaurants.inputs.city')
                        </h5>
                        <span>{{ $restaurant->city ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.restaurants.inputs.country')
                        </h5>
                        <span>{{ $restaurant->country ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('restaurants.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Restaurant::class)
                    <a href="{{ route('restaurants.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
