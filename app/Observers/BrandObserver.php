<?php

namespace App\Observers;

use App\Models\Brand;
use Illuminate\Support\Str;

class BrandObserver
{
    /**
     * Handle the brand "created" event.
     *
     * @param  Brand  $brand
     */
    public function creating(Brand $brand)
    {
        $brand->slug = Str::slug($brand->title);
    }

    /**
     * Handle the brand "updated" event.
     *
     * @param  Brand  $brand
     */
    public function updating(Brand $brand)
    {
    }

    /**
     * Handle the brand "deleted" event.
     *
     * @param  Brand  $brand
     */
    public function deleted(Brand $brand)
    {
        //
    }

    /**
     * Handle the brand "restored" event.
     *
     * @param  Brand  $brand
     */
    public function restored(Brand $brand)
    {
        //
    }

    /**
     * Handle the brand "force deleted" event.
     *
     * @param  Brand  $brand
     */
    public function forceDeleted(Brand $brand)
    {
        //
    }
}
