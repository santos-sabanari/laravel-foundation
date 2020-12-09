<?php

namespace SantosSabanari\LaravelFoundation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SantosSabanari\LaravelFoundation\Http\Requests\UpdateGeneralSettingsRequest;
use SantosSabanari\LaravelFoundation\Settings\GeneralSettings;

class GeneralSettingController extends Controller
{
    public function show(GeneralSettings $settings)
    {
        return view('backend.settings.show')->withSettings($settings);
    }

    public function edit(GeneralSettings $settings)
    {
        return view('backend.settings.edit')->withSettings($settings);
    }

    public function update(UpdateGeneralSettingsRequest $request, GeneralSettings $settings)
    {
        $validated = $request->validated();
        $settings->countdown = $validated['countdown'];
        $settings->save();

        return redirect()->route('backend.system.settings.general.show')->withFlashSuccess(__('The general settings was successfully updated.'));
    }
}
