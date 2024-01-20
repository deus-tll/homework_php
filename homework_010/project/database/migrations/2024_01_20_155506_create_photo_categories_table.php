<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('photo_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64)->unique();
            $table->timestamps();
        });

        DB::table('photo_categories')
            ->insert([
                'id' => 1,
                'name' => 'No Category'
            ]);

        Schema::table('photos', function(Blueprint $table) {
            $table->unsignedBigInteger('category_id')->default(1);

            $table->foreign('category_id', 'photos_category_id_foreign')->references('id')->on('photo_categories')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->dropForeign(['photos_category_id_foreign']);
            $table->dropColumn('category_id');
        });

        Schema::dropIfExists('photo_categories');
    }
};
