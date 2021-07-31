<?php

    namespace App\Http\ViewComposers;

    use App\Models\Setting;
    use Illuminate\View\View;

    class SettingsComposer
    {
        public function compose(View $view)
        {
            $view->with('settings', Setting::get());
        }
    }
