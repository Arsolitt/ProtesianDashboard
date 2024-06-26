<x-card class="mt-4">
    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.settings.update.paymentsettings') }}">
        @csrf
        @method('PATCH')

        <x-validation-errors :errors="$errors" />

        <div class="grid gap-x-4 md:grid-cols-2 lg:grid-cols-3">
            <x-card title="YooKassa" class="p-0 shadow-none" style="padding: 0 !important;">
                <x-label title="YooKassa Shop ID">
                    <x-input x-todo="yookassa-shop-id" id="yookassa-shop-id" name="yookassa-shop-id" type="text"
                        value="{{ config('SETTINGS::PAYMENTS:YOOKASSA:SHOP_ID') }}" />
                </x-label>
                <x-label title="YooKassa Secret Key">
                    <x-input x-todo="yookassa-secret-key" id="yookassa-secret-key" name="yookassa-secret-key"
                        type="text" value="{{ config('SETTINGS::PAYMENTS:YOOKASSA:SECRET_KEY') }}" />
                </x-label>
            </x-card>

            <x-card title="Paypalych" class="p-0 shadow-none" style="padding: 0 !important;">
                <x-label title="Paypalych Shop ID">
                    <x-input x-todo="paypalych-shop-id" id="paypalych-shop-id" name="paypalych-shop-id" type="text"
                             value="{{ config('SETTINGS::PAYMENTS:PAYPALYCH:SHOP_ID') }}" />
                </x-label>
                <x-label title="Paypalych Secret Key">
                    <x-input x-todo="paypalych-secret-key" id="paypalych-secret-key" name="paypalych-secret-key"
                             type="text" value="{{ config('SETTINGS::PAYMENTS:PAYPALYCH:SECRET_KEY') }}" />
                </x-label>
            </x-card>

{{--            <x-card title="Stripe" class="p-0 shadow-none" style="padding: 0 !important;">
                <x-label title="Stripe Secret key">
                    <x-input x-todo="stripe-secret" id="stripe-secret" name="stripe-secret" type="text"
                        value="{{ config('SETTINGS::PAYMENTS:STRIPE:SECRET') }}" />
                </x-label>
                <x-label title="Stripe Endpoint Secret Key">
                    <x-input x-todo="stripe-endpoint-secret" id="stripe-endpoint-secret" name="stripe-endpoint-secret"
                        type="text" value="{{ config('SETTINGS::PAYMENTS:STRIPE:ENDPOINT_SECRET') }}" />
                </x-label>
                <x-label title="Stripe Test Secret key (optional)">
                    <x-input x-todo="stripe-test-secret" id="stripe-test-secret" name="stripe-test-secret"
                        type="text" value="{{ config('SETTINGS::PAYMENTS:STRIPE:TEST_SECRET') }}" />
                </x-label>
                <x-label title="Stripe Test Endpoint Secret key (optional)">
                    <x-input x-todo="stripe-endpoint-test-secret" id="stripe-endpoint-test-secret"
                        name="stripe-endpoint-test-secret" type="text"
                        value="{{ config('SETTINGS::PAYMENTS:STRIPE:ENDPOINT_TEST_SECRET') }}" />
                </x-label>
                <x-label title="Payment Methods">
                    <x-input x-todo="stripe-methods" id="stripe-methods" name="stripe-methods" type="text"
                        value="{{ config('SETTINGS::PAYMENTS:STRIPE:METHODS') }}" />
                    @slot('text')
                        Comma separated list of payment methods without whitespaces. <br> Example: card,klarna,sepa
                    @endslot
                </x-label>
            </x-card>--}}

            <x-card title="Other" class="p-0 shadow-none" style="padding: 0 !important;">
                <x-label title="Tax Value in %">
                    <x-input x-todo="sales-tax" id="sales-tax" name="sales-tax" type="number" step=".01"
                             value="{{ config('SETTINGS::PAYMENTS:SALES_TAX') }}" />
                    @slot('text')
                        Tax Value that will be added to the total price of the order. <br>Example: 19 results in (19%)
                    @endslot
                </x-label>
                <x-label title="Minimum payment amount">
                    <x-input x-todo="minimum-amount" id="minimum-amount" name="minimum-amount" type="number" step="1"
                             value="{{ config('SETTINGS::PAYMENTS:MINIMUM_AMOUNT') }}" />
                </x-label>
                <x-label title="Maximum payment amount">
                    <x-input x-todo="maximum-amount" id="maximum-amount" name="maximum-amount" type="number" step="1"
                             value="{{ config('SETTINGS::PAYMENTS:MAXIMUM_AMOUNT') }}" />
                </x-label>
            </x-card>

        </div>

        <x-button type='submit'>{{ __('Submit') }}</x-button>
    </form>

</x-card>
