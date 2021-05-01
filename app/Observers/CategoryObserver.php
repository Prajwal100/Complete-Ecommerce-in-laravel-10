<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    /**
     * Handle the category "created" event.
     *
     * @param  Category  $category
     */
    public function creating(Category $category)
    {
        $category->slug = Str::slug($category->title);
    }

    /**
     * Handle the category "updated" event.
     *
     * @param  Category  $category
     */
    public function updated(Category $category)
    {
        //
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  Category  $category
     */
    public function deleted(Category $category)
    {
        //
    }

    /**
     * Handle the category "restored" event.
     *
     * @param  Category  $category
     */
    public function restored(Category $category)
    {
        //
    }

    /**
     * Handle the category "force deleted" event.
     *
     * @param  Category  $category
     */
    public function forceDeleted(Category $category)
    {
        //
    }
}
