<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('photo_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name', 256)->unique();
            $table->string('slug', 64)->unique();
            $table->timestamps();
        });

        Schema::create('pivot_photo_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('photo_id')->index();
            $table->unsignedBigInteger('tag_id')->index();

            $table->foreign('photo_id')
                ->references('id')->on('photos')
                ->onDelete('cascade');

            $table->foreign('tag_id')
                ->references('id')->on('photo_tags')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pivot_photo_tags', function (Blueprint $table) {
            $table->dropForeign(['photo_id']);
            $table->dropForeign(['tag_id']);
        });

        Schema::dropIfExists('pivot_photo_tags');
        Schema::dropIfExists('photo_tags');
    }
};
