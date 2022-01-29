<?php

use App\Enums\RelationshipType;
use App\Enums\StatusType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relationships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_first_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_second_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('type', RelationshipType::getValues());
            $table->enum('status', StatusType::getValues());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relationships');
    }
}
