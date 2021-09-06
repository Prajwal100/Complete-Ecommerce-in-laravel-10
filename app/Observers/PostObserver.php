<?php

    namespace App\Observers;

    use App\Models\Post;
    use Illuminate\Support\Str;

    class PostObserver
    {
        /**
         * Handle the post "created" event.
         *
         * @param  Post  $post
         */
        public function creating(Post $post)
        {
            $slug = Str::slug($post->title);
            if (Post::whereSlug($slug)->count() > 0) {
                $post->slug = $slug;
            }
            $post->slug = $post->incrementSlug($slug);
        }

        /**
         * Handle the post "updated" event.
         *
         * @param  Post  $post
         */
        public function updated(Post $post)
        {
            //
        }

        /**
         * Handle the post "deleted" event.
         *
         * @param  Post  $post
         */
        public function deleted(Post $post)
        {
            //
        }

        /**
         * Handle the post "restored" event.
         *
         * @param  Post  $post
         */
        public function restored(Post $post)
        {
            //
        }

        /**
         * Handle the post "force deleted" event.
         *
         * @param  Post  $post
         */
        public function forceDeleted(Post $post)
        {
            //
        }
    }
