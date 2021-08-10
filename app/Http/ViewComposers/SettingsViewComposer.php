<?php

  namespace App\Http\ViewComposers;

  use App\Models\Category;
  use App\Models\Setting;
  use Illuminate\View\View;

  class SettingsViewComposer
  {
    public function compose(View $view)
    {
      $view->with('settings', Setting::get());
      $view->with('tree', Category::getList());
    }
  }
