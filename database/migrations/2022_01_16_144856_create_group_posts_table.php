<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_posts', function (Blueprint $table) {
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
            $table->foreignId('group_id')->constrained('groups')->onDelete('cascade');

            $table->unique(['group_id', 'post_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_posts');
    }
}
