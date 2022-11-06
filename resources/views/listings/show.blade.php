<x-layout>
    <x-partials._search />

    <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <div class="mx-4">
        <div class="bg-gray-50 border border-gray-200 p-10 rounded">
            <div class="flex flex-col items-center justify-center text-center">
                <img class="w-48 mr-6 mb-6" src="{{ asset('images/no-image.png') }}" alt="" />

                <h3 class="text-2xl mb-2">{{ $listing->title }}</h3>
                <div class="text-xl font-bold mb-4">{{ $listing->company }}</div>
                <x-listing-tags :tagsCsv="$listing->tags":tagsCsv="$listing->tags" />
                <div class="text-lg my-4">
                    <i class="fa-solid fa-location-dot"></i>{{ $listing->location }}
                </div>
                <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <h3 class="text-3xl font-bold mb-4">
                        Job Description
                    </h3>
                    <div class="text-lg space-y-6">
                        <p>
                            {{ $listing->description }}
                        </p>
                        <a href="mailto:{{ $listing->email }}"
                            class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"><i
                                class="fa-solid fa-envelope"></i>
                            Contact Employer</a>

                        <a href="{{ $listing->website }}" target="_blank"
                            class="block bg-black text-white py-2 rounded-xl hover:opacity-80"><i
                                class="fa-solid fa-globe"></i> Visit
                            Website</a>
                    </div>
                </div>
            </div>
        </div>
        @isset(auth()->user()->id)
            @if ($listing->user->id === auth()->user()->id)
                <div class="mt-4 p-2 flex space-x-6">
                    <a href="/listings/{{ $listing->id }}/edit"
                        class="bg-gray-400 text-white px-3 py-1 text-xl rounded-lg">Edit</a>

                    <form method="POST" action="/listings/{{ $listing->id }}/delete">
                        @csrf
                        @method('delete')
                        <button class="bg-red-400 text-white px-3 py-1 text-xl rounded-lg">Delete</button>
                    </form>

                </div>
            @endif
        @endisset
    </div>
    <x-partials._footer />
</x-layout>
