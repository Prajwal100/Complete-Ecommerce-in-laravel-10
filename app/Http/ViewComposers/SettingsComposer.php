<?php

namespace App\Http\ViewComposers;

use App\Models\Settings;
use Illuminate\View\View;

class SettingsComposer
{
    public function compose(View $view)
    {
        $view->with('settings', Settings::get());
    }
}
