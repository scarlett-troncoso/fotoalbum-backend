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
        Schema::table('photos', function (Blueprint $table) {
            // 1. crea colonna category_id, chiave esterna
            $table->unsignedBigInteger('category_id')->nullable()->after('id');
             // 2. Assegna la chiave sterna
            $table->foreign('category_id') //la chiave category_id
            ->references('id')
            ->on('categories')
            ->nullOnDelete(); // se la categoria fosse cancellata, impostare il campo su null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photos', function (Blueprint $table) {
            // 1. cancellare prima la chiave sterna
            $table->dropForeign('photos_category_id_foreign');

            // 2. cancellare la colonna
            $table->dropColumn('category_id');
        });
    }
};
