<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminWebSettingController extends Controller
{
    public function edit(): View
    {
        $downloadLink = Setting::where('key', 'download_link')->value('value');

        return view('admin.settings.edit', [
            'downloadLink' => $downloadLink,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'download_link' => ['required', 'string', 'max:2048'],
        ]);

        Setting::updateOrCreate(
            ['key' => 'download_link'],
            ['value' => $validated['download_link']]
        );

        return back()->with('status', 'Download link updated.');
    }
}

