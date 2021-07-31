<?php

    namespace App\Observers;

    use App\Models\Product;
    use Illuminate\Support\Str;

    class ProductObserver
    {
        /**
         * Handle the product "created" event.
         *
         * @param  Product  $product
         */
        public function creating(Product $product)
        {
            $slug = Str::slug($product->title);
            if (Product::whereSlug($slug)->count() > 0) {
                $product->slug = $slug;
            }
            $product->slug = $product->incrementSlug($slug);
        }
    }
