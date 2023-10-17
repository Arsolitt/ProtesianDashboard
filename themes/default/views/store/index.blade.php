@extends('layouts.main')
<?php use App\Models\ShopProduct; ?>

@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{ __('Store') }}
        </h2>


        @if ($isPaymentSetup && $products->count() > 0)
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                {{ __('Price') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ __('Type') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ __('Description') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ __('Action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php /** @var $product ShopProduct */
                        ?>
                        @foreach ($products as $product)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="py-4 px-6 font-medium whitespace-nowrap">
                                    {{ $product->formatToCurrency($product->price) }}
                                </th>
                                <td class="py-4 px-6">
                                    {{ strtolower($product->type) == 'credits' ? __('Balance') : $product->type }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $product->display }}
                                </td>
                                <td class="py-4 px-6">
                                    <a href="{{ route('checkout', $product->id) }}"
                                        class="font-medium text-purple-600 dark:text-purple-500 hover:underline">{{ __('Purchase') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- <x-pagination></x-pagination> --}}
        @else
            <x-alert title="" type="danger">
            @if ($products->count() == 0)
                {{ __('There are no store products!') }}
            @else
                {{ __('The store is not correctly configured!') }}
            @endif</x-alert>
        @endif

    </div>
@endsection
