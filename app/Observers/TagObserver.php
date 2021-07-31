<?php

    namespace App\Observers;

    use App\Models\Tag;
    use Illuminate\Support\Str;

    class TagObserver
    {
        /**
         * Handle the post tag "created" event.
         *
         * @param  Tag  $postTag
         */
        public function creating(Tag $postTag)
        {
            $slug = Str::slug($postTag->title);
            if (Tag::whereSlug($slug)->count() > 0) {
                $postTag->slug = $slug;
            }
            $postTag->slug = $postTag->incrementSlug($slug);
        }

        /**
         * Handle the post tag "updated" event.
         *
         * @param  Tag  $postTag
         */
        public function updating(Tag $postTag)
        {
        }

        /**
         * Handle the post tag "deleted" event.
         *
         * @param  Tag  $postTag
         */
        public function deleted(Tag $postTag)
        {
            //
        }

        /**
         * Handle the post tag "restored" event.
         *
         * @param  Tag  $postTag
         */
        public function restored(Tag $postTag)
        {
            //
        }

        /**
         * Handle the post tag "force deleted" event.
         *
         * @param  Tag  $postTag
         */
        public function forceDeleted(Tag $postTag)
        {
            //
        }
    }