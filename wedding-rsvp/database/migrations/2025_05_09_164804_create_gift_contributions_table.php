<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gift_contributions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->text('message')->nullable();
            $table->json('items'); // [{ title, quantity, price }]
            $table->integer('amount'); // in pence or pounds – up to you
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gift_contributions');
    }
};
