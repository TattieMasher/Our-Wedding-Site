<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('guests', function (Blueprint $table) {
            $table->string('diet')->nullable()->after('is_attending');
            $table->text('dietary_requirements')->nullable()->after('diet');
        });
    }

    public function down(): void {
        Schema::table('guests', function (Blueprint $table) {
            $table->dropColumn(['diet', 'dietary_requirements']);
        });
    }
};
