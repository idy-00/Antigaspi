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
        Schema::create('boutiques', function (Blueprint $col) {
            $col->id();
            $col->string('nom_commerce');
            $col->enum('type_commerce', ['boulangerie', 'restaurant', 'supermarche', 'hotel', 'autre']);
            $col->text('adresse_complete');
            $col->string('commune', 100);
            $col->decimal('latitude', 10, 8)->nullable();
            $col->decimal('longitude', 11, 8)->nullable();
            $col->string('nom_gerant', 150);
            $col->string('telephone', 15)->unique();
            $col->string('email')->unique();
            $col->string('password');
            $col->enum('status', ['en_attente', 'valide', 'suspendu'])->default('en_attente');
            $col->boolean('is_verified')->default(false);
            $col->string('confirmation_token', 100)->nullable();
            $col->string('reset_token', 100)->nullable();
            $col->dateTime('reset_expires')->nullable();
            $col->rememberToken();
            $col->timestamps();
            
            $col->index('commune');
            $col->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boutiques');
    }
};
