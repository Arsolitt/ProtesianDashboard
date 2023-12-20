@extends('layouts.main')

@section('content')
    <div class="container px-6 mx-auto grid" x-data="{ server_id: null }">

        <div class="mb-4 flex justify-between py-6">

            <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-200">
                {{ __('Servers') }}
            </h2>
            <button @if (Auth::user()->Servers->count() >= Auth::user()->server_limit) disabled="disabled" title="Server limit reached!" @endif
                href="{{ route('servers.create') }}"
                class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md focus:shadow-outline-purple
            @if (Auth::user()->Servers->count() >= Auth::user()->server_limit) opacity-50 cursor-not-allowed
            @else active:bg-purple-600 hover:bg-purple-700 focus:shadow-outline-purple @endif focus:outline-none"
                onclick="window.location.href = '{{ route('servers.create') }}'">{{ __('Create Server') }}</button>
        </div>

        <div class="grid gap-6 mb-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($servers as $server)
                @if ($server->location && $server->node && $server->nest && $server->egg)
                    <div class="p-4 rounded-lg shadow-sm bg-gray-800" style="min-width: 320px">
                        <h2 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                            {{ $server->name }}
                        </h2>
                        <div class="w-full overflow-x-auto rounded-lg shadow-sm ">
                            <table class="w-full whitespace-no-wrap">
                                {{--<thead>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-4 py-3">{{ __('Resources') }}</th>
                                        <th class="px-4 py-3">{{ __('Details') }}</th>
                                    </tr>
                                </thead>--}}
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <p class="font-semibold">
                                                    {{ __('Location') }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $server->location }}
                                        </td>
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <p class="font-semibold">
                                                    {{ __('Node') }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $server->node }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <p class="font-semibold">
                                                    {{ __('Software') }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $server->nest }}, {{ $server->egg }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <p class="font-semibold">
                                                    {{ __('Specification') }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $server->product->name }} BUILD<br />
                                            <span>{{ __('CPU') }}: <span class="text-xl">∞</span></span>
                                            <br />{{ __('RAM') }}: {{ $server->product->memory / 1024 }} {{ __('GB') }} <br />
                                            {{ __('Disk') }}: {{ $server->product->disk / 1024 }} {{ __('GB') }} <br />
                                            {{--{{ __('Backups') }}: {{ $server->product->backups }} <br />
                                            {{ __('MySQL Databases') }}: {{ $server->product->databases }} <br />
                                            {{ __('Allocations') }}: {{ $server->product->allocations }}--}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <p class="font-semibold">
                                                    {{ __('Price') }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            <div class="flex items-center">
                                                <span>{{ $server->product->getHourlyPrice() * 24 * 30 }}</span>
                                                <svg class="w-4 h-4 ml-1 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                          d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="font-normal dark:text-gray-400/75 text-gray-600">({{ __('per Month') }})</span>
                                            </div>

                                            <div class="flex items-center">
                                                <span>{{ number_format($server->product->getHourlyPrice(), 2, '.', '') }}</span>
                                                <svg class="w-4 h-4 ml-1 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                          d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="font-normal dark:text-gray-400/75 text-gray-600">({{ __('per Hour') }})</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 flex justify-evenly">
                            <a href="{{ config('SETTINGS::SYSTEM:PTERODACTYL:PUBLIC_URL') }}/server/{{ $server->identifier }}"
                                target="__blank"
                                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                {{ __('Manage') }}
                            </a>
                            <a href="{{ route('servers.show', ['server' => $server->id]) }}"
                                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                {{ __('Settings') }}
                            </a>
                        </div>
                    </div>
                @endif
            @empty
                <div class="min-w-0 p-4 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                    <h4 class="font-semibold text-gray-600 dark:text-gray-300">
                    {{ __('No Servers Found') }}!
                    </h4>
                </div>
            @endforelse
        </div>

    </div>
@endsection
