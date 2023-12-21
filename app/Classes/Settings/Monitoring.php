<?php

namespace App\Classes\Settings;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class Monitoring
{
    public function __construct()
    {

    }

    public function updateSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'node-1-name' => 'nullable|string',
            'node-1-load' => 'nullable|numeric',
            'node-2-name' => 'nullable|string',
            'node-2-load' => 'nullable|numeric',
            'node-3-name' => 'nullable|string',
            'node-3-load' => 'nullable|numeric',
            'node-4-name' => 'nullable|string',
            'node-4-load' => 'nullable|numeric',
        ]);
        if ($validator->fails()) {
            return redirect(route('admin.settings.index').'#monitoring')->with('error', __('Monitoring settings have not been updated!'))->withErrors($validator)
                ->withInput();
        }

        $values = [
            //SETTINGS::VALUE => REQUEST-VALUE (coming from the html-form)
            'SETTINGS::MONITORING:NODE1:NAME' => 'node-1-name',
            'SETTINGS::MONITORING:NODE1:LOAD' => 'node-1-load',
            'SETTINGS::MONITORING:NODE2:NAME' => 'node-2-name',
            'SETTINGS::MONITORING:NODE2:LOAD' => 'node-2-load',
            'SETTINGS::MONITORING:NODE3:NAME' => 'node-3-name',
            'SETTINGS::MONITORING:NODE3:LOAD' => 'node-3-load',
            'SETTINGS::MONITORING:NODE4:NAME' => 'node-4-name',
            'SETTINGS::MONITORING:NODE4:LOAD' => 'node-4-load',
        ];

        foreach ($values as $key => $value) {
            $param = $request->get($value);

            Settings::where('key', $key)->updateOrCreate(['key' => $key], ['value' => $param]);
            Cache::forget('setting'.':'.$key);
        }

        return redirect(route('admin.settings.index').'#monitoring')->with('success', __('Monitoring settings updated!'));
    }
}
