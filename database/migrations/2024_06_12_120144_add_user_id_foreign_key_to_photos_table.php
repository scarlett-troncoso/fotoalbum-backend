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
                        // 1. crea colonna user_id
                        $table->unsignedBigInteger('user_id')->nullable()->after('id');
            
                        // 2. assegna chiave esterna
                        $table->foreign('user_id')
                        ->references('id')
                        ->on('users')
                        ->cascadeOnDelete(); //se user_id é cancellato cancellare tutta la riga della tabella
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photos', function (Blueprint $table) {
            // 1. prima cancellare chiave esterna
            $table->dropForeign('photos_user_id_foreign');

            // 2. cancella la colonna
            $table->dropColumn('user_id');
        });
    }
};
