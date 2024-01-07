@extends('layouts.main')

@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{ __('Store') }}
        </h2>


        @if ($isPaymentSetup)
            <form
                x-data="{ payment_method: '{{ isset($paymentGateways[0]) ? $paymentGateways[0]->name : '' }}', clicked: false }"
                x-ref="form"
                action="{{ route('store.checkout') }}"
                method="POST"
                class="overflow-x-auto">
                @csrf
                @method('post')

                <div class="">
                    <h4 class="flex justify-between">
                        <span>{{ config('app.name', 'Laravel') }}</span>
                        <span class="float-right">{{ __('Date') }}: {{ Carbon\Carbon::now()->isoFormat('LL') }}</span>
                    </h4>
                </div>
                <div
                    class="my-4 p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">

                    <div class="grid gap-6 sm:grid-cols-2 ">
                        <div class="w-full overflow-hidden">
                            <h2 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200 flex justify-between items-center">
                                {{ __('Payment Methods') }}:
                            </h2>
                            <div class="mb-4 grid sm:grid-cols-2 gap-6">
                                @foreach ($paymentGateways as $gateway)
                                    <div class="">
                                        <label
                                            class="inline-flex flex-col items-center text-gray-600 dark:text-gray-400 relative"
                                            for="{{ $gateway->name }}">
                                            <img class="w-44 " src="{{ $gateway->image }}"
                                                 alt="{{ $gateway->name }} logo">
                                            <div class="inline-flex items-center">
                                                <input type="radio"
                                                       class="text-purple-600 form-radio focus:border-purple-400 "
                                                       x-on:click="clicked = false" x-model="payment_method"
                                                       id="{{ $gateway->name }}"
                                                       value="{{ $gateway->name }}" name="payment_method">
                                                <span
                                                    class="ml-2 font-bold text-lg dark:text-gray-200 text-gray-800">{{ $gateway->name }}</span>
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="w-full flex flex-col">
                            <h2 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200 flex justify-between items-center">
                                <span>{{ __('Amount Due') }}</span>
                            </h2>
                            <x-validation-errors class="mb-4" :errors="$errors" />
                            <input type="text"
                                   required
                                   pattern="[0-9]+"
                                   title="Payment amount"
                                   name="payment_amount"
                                   id="payment_amount"
                                   oninput="validity.valid||(value='');"
                                   class="dark:bg-gray-800 justify-center max-w-xs mt-5 inline-flex items-center py-2 px-3 text-sm font-medium text-center text-black dark:text-white rounded-lg hover:bg-gray-300 dark:hover:bg-gray-900">
                            <button type="submit" :disabled="(!payment_method || clicked)"
                                    @click="clicked = true"
                                    x-on:click="clicked = true; $refs.form.submit()"
                                    class="justify-center max-w-xs mt-5 print:hidden inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-purple-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800 disabled:bg-purple-500 disabled:dark:bg-purple-800 disabled:cursor-not-allowed">
                                {{ __('Submit Payment') }}
                                <svg aria-hidden="true" class="ml-2 -mr-1 w-4 h-4" fill="currentColor"
                                     viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        @else
            <x-alert title="" type="danger">{{ __('The store is not correctly configured!') }}</x-alert>
        @endif

    </div>

    <script>
        const getUrlParameter = (param) => {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            return urlParams.get(param);
        };
        document.addEventListener("DOMContentLoaded", function(event) {
            const voucherCode = getUrlParameter("voucher");

            //if voucherCode not empty, open the modal and fill the input
            if (voucherCode) {
                document.querySelector("[x-data=data]")._x_dataStack[0].openRedeemModal();
                document.querySelector("#redeemVoucherCode").value = voucherCode;
            }
        });
    </script>

@endsection
