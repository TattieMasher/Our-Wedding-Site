<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('rsvp_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('household_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->json('payload'); // guests array
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('rsvp_submissions');
    }
};
