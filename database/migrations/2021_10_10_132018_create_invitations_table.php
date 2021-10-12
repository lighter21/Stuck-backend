<?php

use App\Enums\InvitationType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->enum('type', InvitationType::getValues());
            $table->foreignId('user_from_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_to_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('invitable_id')->nullable();
            $table->string('invitable_type')->nullable();
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
        Schema::dropIfExists('invitations');
    }
}
