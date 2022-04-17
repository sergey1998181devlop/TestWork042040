<?php

namespace App\Observers;

use App\Models\BlogCategory;
use Carbon\Carbon;

class BlogCategoryObserver
{
    /**
     * Handle the ModelsBlogCategory "created" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function created(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the ModelsBlogCategory "updated" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function updated(BlogCategory $blogCategory)
    {
        //
    }

    public function updating(BlogCategory $blogCategory){
        $this->setSlug($blogCategory);
    }

    /**
     * Handle the ModelsBlogCategory "deleted" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function deleted(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the ModelsBlogCategory "restored" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function restored(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the ModelsBlogCategory "force deleted" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function forceDeleted(BlogCategory $blogCategory)
    {
        //
    }

    protected function setPublishedAt(BlogCategory $blogCategory){
        if(empty($blogCategory->published_at) && $blogCategory->is_published ){
            $blogCategory->published_at = Carbon::now();
        }
    }

    protected function setSlug(BlogCategory $blogCategory){
        if(empty($blogCategory->slug)){
            $blogCategory->slug = \Str::slug($blogCategory->title);
        }
    }
}
