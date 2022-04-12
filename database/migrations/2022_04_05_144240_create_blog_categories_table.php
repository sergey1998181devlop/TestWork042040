<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();//bigIncrements
            $table->integer('parent_id')->unsigned()->default(1);//unsigned - = or > 0 similar id

            $table->string('slug')->unique();//unique val) i will create url from slug
            $table->string('title');//name category
            $table->text('description')->nullable();//this val can be  null

            $table->timestamps();//updated_at , create_at
            $table->softDeletes();//deleted_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_categories');
    }
}
