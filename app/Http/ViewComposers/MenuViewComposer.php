<?php

  namespace App\Http\ViewComposers;

  use App\Models\Category;
  use Illuminate\View\View;

  class MenuViewComposer
  {
    public function compose(View $view)
    {
      $view->with('categories', Category::whereNull('parent_id')->with('childrenCategories')->get());
    }
  }