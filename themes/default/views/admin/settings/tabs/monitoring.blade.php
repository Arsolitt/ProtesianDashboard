<x-card class="mt-4">
    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.settings.update.monitoringsettings') }}">
        @csrf
        @method('PATCH')

        <x-validation-errors :errors="$errors" />

        <div class="grid gap-x-4 md:grid-cols-2 lg:grid-cols-2">
            <x-card title="NODE 1" class="p-0 shadow-none" style="padding: 0 !important;">
                <x-label title="NODE-1 Name">
                    <x-input x-todo="node-1-name" id="node-1-name" name="node-1-name" type="text"
                             value="{{ config('SETTINGS::MONITORING:NODE1:NAME') }}" />
                </x-label>
                <x-label title="NODE-1 Load">
                    <x-input x-todo="node-1-load" id="node-1-load" name="node-1-load"
                             type="number" step="1" value="{{ config('SETTINGS::MONITORING:NODE1:LOAD') }}" />
                </x-label>
            </x-card>

            <x-card title="NODE 2" class="p-0 shadow-none" style="padding: 0 !important;">
                <x-label title="NODE-2 Name">
                    <x-input x-todo="node-2-name" id="node-2-name" name="node-2-name" type="text"
                             value="{{ config('SETTINGS::MONITORING:NODE2:NAME') }}" />
                </x-label>
                <x-label title="NODE-2 Load">
                    <x-input x-todo="node-2-load" id="node-2-load" name="node-2-load"
                             type="number" step="1" value="{{ config('SETTINGS::MONITORING:NODE2:LOAD') }}" />
                </x-label>
            </x-card>

            <x-card title="NODE 3" class="p-0 shadow-none" style="padding: 0 !important;">
                <x-label title="NODE-3 Name">
                    <x-input x-todo="node-3-name" id="node-3-name" name="node-3-name" type="text"
                             value="{{ config('SETTINGS::MONITORING:NODE3:NAME') }}" />
                </x-label>
                <x-label title="NODE-3 Load">
                    <x-input x-todo="node-3-load" id="node-3-load" name="node-3-load"
                             type="number" step="1" value="{{ config('SETTINGS::MONITORING:NODE3:LOAD') }}" />
                </x-label>
            </x-card>

            <x-card title="NODE 4" class="p-0 shadow-none" style="padding: 0 !important;">
                <x-label title="NODE-4 Name">
                    <x-input x-todo="node-4-name" id="node-4-name" name="node-4-name" type="text"
                             value="{{ config('SETTINGS::MONITORING:NODE4:NAME') }}" />
                </x-label>
                <x-label title="NODE-4 Load">
                    <x-input x-todo="node-4-load" id="node-4-load" name="node-4-load"
                             type="number" step="1" value="{{ config('SETTINGS::MONITORING:NODE4:LOAD') }}" />
                </x-label>
            </x-card>
        </div>

        <x-button type='submit'>{{ __('Submit') }}</x-button>
    </form>

</x-card>
