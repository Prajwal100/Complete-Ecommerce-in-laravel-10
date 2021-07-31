<?php

    namespace App\Observers;

    use App\Models\PostCategory;
    use Illuminate\Support\Str;

    class PostCategoryObserver
    {
        /**
         * Handle the post category "created" event.
         *
         * @param  PostCategory  $postCategory
         */
        public function creating(PostCategory $postCategory)
        {
            $slug = Str::slug($postCategory->title);
            if (PostCategory::whereSlug($slug)->count() > 0) {
                $postCategory->slug = $slug;
            }
            $postCategory->slug = $postCategory->incrementSlug($slug);
        }

        /**
         * Handle the post category "updated" event.
         *
         * @param  PostCategory  $postCategory
         */
        public function updating(PostCategory $postCategory)
        {
        }

        /**
         * Handle the post category "deleted" event.
         *
         * @param  PostCategory  $postCategory
         */
        public function deleted(PostCategory $postCategory)
        {
            //
        }

        /**
         * Handle the post category "restored" event.
         *
         * @param  PostCategory  $postCategory
         */
        public function restored(PostCategory $postCategory)
        {
            //
        }

        /**
         * Handle the post category "force deleted" event.
         *
         * @param  PostCategory  $postCategory
         */
        public function forceDeleted(PostCategory $postCategory)
        {
            //
        }
    }