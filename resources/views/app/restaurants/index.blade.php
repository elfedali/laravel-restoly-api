<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.restaurants.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}"
                                        autocomplete="off"
                                    ></x-inputs.text>

                                    <div class="ml-1">
                                        <button
                                            type="submit"
                                            class="button button-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\Restaurant::class)
                            <a
                                href="{{ route('restaurants.create') }}"
                                class="button button-primary"
                            >
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.restaurants.inputs.user_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.restaurants.inputs.title')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.restaurants.inputs.slug')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.restaurants.inputs.content')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.restaurants.inputs.excerpt')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.restaurants.inputs.is_published')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.restaurants.inputs.comment_status')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.restaurants.inputs.ping_status')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.restaurants.inputs.published_at')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.restaurants.inputs.thumbnail')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.restaurants.inputs.phone')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.restaurants.inputs.phone_2')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.restaurants.inputs.phone_3')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.restaurants.inputs.reservation_required')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.restaurants.inputs.website_url')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.restaurants.inputs.address')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.restaurants.inputs.city')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.restaurants.inputs.country')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($restaurants as $restaurant)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ optional($restaurant->user)->name ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $restaurant->title ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $restaurant->slug ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $restaurant->content ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $restaurant->excerpt ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $restaurant->is_published ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $restaurant->comment_status ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $restaurant->ping_status ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $restaurant->published_at ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <x-partials.thumbnail
                                        src="{{ $restaurant->thumbnail ? \Storage::url($restaurant->thumbnail) : '' }}"
                                    />
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $restaurant->phone ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $restaurant->phone_2 ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $restaurant->phone_3 ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $restaurant->reservation_required ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $restaurant->website_url ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $restaurant->address ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $restaurant->city ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $restaurant->country ?? '-' }}
                                </td>
                                <td
                                    class="px-4 py-3 text-center"
                                    style="width: 134px;"
                                >
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="
                                            relative
                                            inline-flex
                                            align-middle
                                        "
                                    >
                                        @can('update', $restaurant)
                                        <a
                                            href="{{ route('restaurants.edit', $restaurant) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i
                                                    class="icon ion-md-create"
                                                ></i>
                                            </button>
                                        </a>
                                        @endcan @can('view', $restaurant)
                                        <a
                                            href="{{ route('restaurants.show', $restaurant) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $restaurant)
                                        <form
                                            action="{{ route('restaurants.destroy', $restaurant) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                        >
                                            @csrf @method('DELETE')
                                            <button
                                                type="submit"
                                                class="button"
                                            >
                                                <i
                                                    class="
                                                        icon
                                                        ion-md-trash
                                                        text-red-600
                                                    "
                                                ></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="19">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="19">
                                    <div class="mt-10 px-4">
                                        {!! $restaurants->render() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
