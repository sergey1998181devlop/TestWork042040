<?php

namespace App\Observers;

use App\Models\BlogPost;
use Carbon\Carbon;

class BlogPostObserver
{
    /**
     * Handle the ModelsBlogPost "created" event.
     *
     * @param  BlogPost  $blogPost
     * @return void
     */
    public function created(BlogPost $blogPost)
    {
        //
    }
//то что происходит перед обновлением
    public function updating(BlogPost $blogPost){
//        $blogPost->isDirty() узнать изменялась ли модель вообще или нет(хоть одно поле поменялось - тру)
//        $blogPost->isDirty('is_published');
//        $blogPost->getAttribute('is_published'); уже изменненого - которое щас полетит в базу
//        $blogPost->getOriginal(); старое значение  - что было до текущего изменения
        $this->setPublishedAt($blogPost);

        $this->setSlug($blogPost);
    }
    /**
     * Handle the ModelsBlogPost "updated" event.
     *
     * @param  BlogPost  $blogPost
     * @return void
     */
    public function updated(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the ModelsBlogPost "deleted" event.
     *
     * @param  BlogPost  $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the ModelsBlogPost "restored" event.
     *
     * @param  BlogPost  $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the ModelsBlogPost "force deleted" event.
     *
     * @param  BlogPost  $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }

    public function creating(BlogPost $blogPost){
        $this->setPublishedAt($blogPost);

        $this->setSlug($blogPost);

        $this->setHtml($blogPost);

        $this->setUser($blogPost);
    }
    public function setUser(BlogPost $blogPost){
        $blogPost->user_id = auth()->id() ?? BlogPost::UNKNOWN_USER;
    }
    public function setHtml(BlogPost $blogPost){
        if($blogPost->isDirty('content_row')){
            $blogPost->content_html = $blogPost->content_row;
        }
    }
    /**
     * Handle the ModelsBlogPost "created" event.
     *
     * @param  BlogPost  $blogPost
     * @return void
     */
    protected function setPublishedAt(BlogPost $blogPost){
        if(empty($blogPost->published_at) && $blogPost->is_published ){
            $blogPost->published_at = Carbon::now();
        }
    }

    protected function setSlug(BlogPost $blogPost){
        if(empty($blogPost->slug)){
            $blogPost->slug = \Str::slug($blogPost->title);
        }
    }
}
