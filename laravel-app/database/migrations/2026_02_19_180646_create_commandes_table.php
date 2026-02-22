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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('boutique_id');
            $table->string('client_name');
            $table->string('panier_type');
            $table->decimal('prix', 8, 2);
            $table->enum('status', ['todo', 'in_progress', 'completed', 'overdue'])->default('todo');
            $table->boolean('is_high_priority')->default(false);
            $table->dateTime('due_at')->nullable();
            $table->timestamps();

            $table->foreign('boutique_id')->references('id')->on('boutiques')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
